<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MealList;
use App\Models\MenuList;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TakeLunchController extends Controller
{
    public function create()
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        $daily_lunches = MenuList::all();
        $firstName = Auth::user()->first_name;
        $lastName = Auth::user()->last_name;
        $name = $firstName. ' '.$lastName;
        $enrollment = Auth::user()->enrollment;
        $designation = Auth::user()->designation;
        $date = Carbon::now();
        $todayDate =  $date->toDateString();
        $dayName = date('l', strtotime($date));
        return view('frontend.take_lunch.create', compact('daily_lunches', 'name', 'enrollment', 'designation', 'todayDate','dayName'));
    }

    public function index()
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        $user_id = Auth::user()->id;
        $meals = MealList::select('*')
            ->where('meal_lists.user_id', $user_id)
            ->whereMonth('meal_lists.created_at', Carbon::now()->month)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.take_lunch.index', compact('meals'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        $meal_no = (int)$request->meal_no;
        $strDate = $request->strDate;
        $dayName = $request->dayName;
        $user_id = Auth::user()->id;

        $priceData = MenuList::select('menu_lists.itemPrice')->where('menu_lists.itemDay', $dayName)->first();
        if(!empty($priceData))
        {
            $priceOne = (int)$priceData->itemPrice;
            $price = $priceOne * $meal_no;

        }else{
            DB::commit();
            $notification = array(
                'Message' => 'Opps! Today is Friday You can not add food',
                'alert-type' => 'warning'
            );
            return redirect()->route('user.take.lunch.create')->with($notification);
        }

        $date = Carbon::now();
        $todayDate =  $date->toDateString();

        $entryTime = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        $entryHour =  $entryTime->format('H');
        $lastEntryTime = 10;

        $isExists  = MealList::where('meal_lists.user_id', $user_id)->where('meal_lists.strDate', $strDate)->first();

        if(!empty($isExists))
        {
            $notification = array(
                'Message' => 'Today you are already been given your meal!!',
                'alert-type' => 'warning'
            );
            return redirect()->route('user.take.lunch.create')->with($notification);
        }else{
            if($strDate == $todayDate)
            {
                if($entryHour < $lastEntryTime)
                {
                    $request->validate([
                        'meal_no' => 'required|integer',
                    ]);

                    try {
                        DB::beginTransaction();
                        $meal = new MealList();
                        $meal->user_id = $user_id;
                        $meal->meal_no = $meal_no;
                        $meal->price = $price;
                        $meal->strDate = $request->strDate;

                        $meal->save();

                        DB::commit();
                        $notification = array(
                            'Message' => 'Meal Added Successfully!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('user.daily.lunch.index')->with($notification);

                    } catch (\Exception $e) {
                            session()->flash('db_error', $e->getMessage());
                            DB::rollBack();
                            return back();
                    }
                }else{
                    $notification = array(
                        'Message' => 'Sorry! Time is over contact with admin',
                        'alert-type' => 'warning'
                    );
                    return redirect()->route('user.take.lunch.create')->with($notification);
                }
            }else{
                $notification = array(
                    'Message' => 'Something went wrong!!',
                    'alert-type' => 'error'
                );
                return redirect()->route('user.take.lunch.create')->with($notification);
            }
        }
    }

    public function destroy($id)
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        $date = Carbon::now();
        $todayDate =  $date->toDateString();

        $mealEntryDateDB = MealList::select('meal_lists.strDate')->where('id', $id)->first();
        $mealEntryDate = $mealEntryDateDB->strDate;

        $cancelTime = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        $cancelHour =  $cancelTime->format('H');
        $lastCancelTime = 14;

        if($todayDate == $mealEntryDate)
        {
            if($cancelHour < $lastCancelTime)
            {
                $meal = MealList::where('id', $id)->first();

                $meal->delete();

                $notification = array(
                    'Message' => 'Meal Cancel Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.daily.lunch.index')->with($notification);
            }else{
                $notification = array(
                    'Message' => 'Sorry! Time is over',
                    'alert-type' => 'warning'
                );
                return redirect()->route('user.daily.lunch.index')->with($notification);
            }
        }else{
            $notification = array(
                'Message' => 'Only present date meal can be deleted!!',
                'alert-type' => 'error'
            );
            return redirect()->route('user.daily.lunch.index')->with($notification);
        }
    }
}
