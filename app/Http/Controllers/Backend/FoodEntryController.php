<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\MealList;
use App\Models\MenuList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    public function foodEntry()
    {
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $users = User::all();
        return view('backend.foodEntry.index', compact('users'));
    }

    public function foodEntryStore(Request $request){
        if (is_null($this->user) || !$this->user->can('setting.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $date = Carbon::now();
        $todayDate =  $date->toDateString();
        $dayName = date('l', strtotime($date));
        $id = $request->id;
        $designation_id = $request->designation_id;
        $meal_no = (int)$request->meal_no;
        // $priceData = MenuList::select('menu_lists.itemPrice')->where('menu_lists.itemDay', $dayName)->first();
        // $priceOne = (int)$priceData->itemPrice;
        $priceData = Designation::select('designations.food_price')->where('designations.id', $designation_id)->first();
        $priceOne = (int)$priceData->food_price;
        $price = $priceOne * $meal_no;
        $isExists  = MealList::where('meal_lists.user_id', $id)->where('meal_lists.strDate', $todayDate)->first();
        if(!empty($isExists)){
            $notification = array(
                'Message' => 'Today you are already been given your meal!!',
                'alert-type' => 'warning'
            );
            return redirect()->route('admin.foodEntry')->with($notification);
        }else{
            try {
                DB::beginTransaction();
                $meal = new MealList();
                $meal->user_id = $id;
                $meal->meal_no = $meal_no;
                $meal->price = $price;
                $meal->strDate = $todayDate;

                $meal->save();

                DB::commit();
                $notification = array(
                    'Message' => 'Meal Added Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.foodEntry')->with($notification);

            } catch (\Exception $e) {
                    session()->flash('db_error', $e->getMessage());
                    DB::rollBack();
                    return back();
            }
        }
    }
}
