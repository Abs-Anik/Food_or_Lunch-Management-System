<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MealList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        $date = Carbon::now();
        $todayDate =  $date->toDateString();
        $user_id = Auth::user()->id;
        $todaysMeal = MealList::where('user_id', $user_id)->where('strDate', $todayDate)->first();


        // $payments = MealList::select('meal_lists.price')
        // ->where('user_id', $user_id)
        // ->whereMonth('created_at', Carbon::now()->month)
        // ->get();

        // $totalPayable = 0;

        // foreach($payments as $payment)
        // {
        //     $totalPayable = $totalPayable + (int)$payment->price;
        // }

        $results = DB::table('meal_lists')
        ->select('meal_lists.user_id')
        ->where('meal_lists.user_id',$user_id)
        ->distinct()
        ->whereMonth('created_at', Carbon::now()->month)
        ->get();
        $itemValue = [];
        foreach($results as $result){
            $itemResult = MealList::join('users', 'meal_lists.user_id', 'users.id')
            ->join('designations', 'users.designation_id', 'designations.id')
            ->select("meal_lists.user_id", "users.first_name", "users.last_name", "users.enrollment", "designations.designation", "designations.food_price", DB::raw("SUM(meal_no) as totalMeal"), DB::raw("SUM(price) as totalPrice"))
            ->whereMonth('meal_lists.created_at', Carbon::now()->month)
            ->where('meal_lists.user_id', $result->user_id)
            ->groupBy("meal_lists.user_id")
            ->get();
            array_push($itemValue, $itemResult);
        }
        $totalPayable = 0;
        $totalAmount = 0;
        $subsidiaries = 0;
        foreach($itemValue as $item){
            foreach($item as $it){
                $totalPayable = $totalPayable + ($it->totalMeal*$it->food_price);
                $totalAmount = $totalAmount + ($it->totalMeal*90);
                // $totalPayable = $totalPayable + ceil(($it->food_price/110)*($it->totalMeal*90));
            }
        }

        $subsidiaries = $totalAmount - $totalPayable;
        return view('frontend.user.index', compact('todaysMeal', 'totalPayable', 'totalAmount', 'subsidiaries'));
    }
}
