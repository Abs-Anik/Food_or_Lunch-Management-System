<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\MealList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodOrderListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function dailyFood()
    {
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $dailyFoodLists = MealList::join('users', 'meal_lists.user_id', 'users.id')
        ->select('meal_lists.*', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.enrollment', 'users.designation_id', 'users.phone')
        ->whereDate('meal_lists.created_at', Carbon::today())
        ->get();
        return view('backend.foodList.dailyFood', compact('dailyFoodLists'));
    }

    public function orderFood()
    {
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $orderFoodLists = MealList::join('users', 'meal_lists.user_id', 'users.id')
        ->select('meal_lists.*', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.enrollment', 'users.designation_id', 'users.phone')
        ->whereMonth('meal_lists.created_at', Carbon::now()->month)
        ->orderBy('created_at', 'asc')
        ->get();
        return view('backend.foodList.orderFood', compact('orderFoodLists'));
    }

    public function filterFoodOrder(Request $request){
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $enrollment = $request->enrollment;
        $strDate = $request->startDate;
        $endDate = $request->endDate;

        if(!empty($enrollment) && empty($strDate) && empty($endDate)){
            $orderFoodLists = MealList::join('users', 'meal_lists.user_id', 'users.id')
            ->select('meal_lists.*', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.enrollment', 'users.designation_id', 'users.phone')
            ->where('users.enrollment', $enrollment)
            ->orderBy('created_at', 'desc')
            ->get();
            return view('backend.foodList.orderFood', compact('orderFoodLists'));
        }
        elseif(empty($enrollment) && !empty($strDate) && !empty($endDate)){
            $orderFoodLists = MealList::join('users', 'meal_lists.user_id', 'users.id')
            ->select('meal_lists.*', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.enrollment', 'users.designation_id', 'users.phone')
            ->where('meal_lists.strDate', '>=', $strDate)
            ->where('meal_lists.strDate', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();
            return view('backend.foodList.orderFood', compact('orderFoodLists'));
        }
        elseif(!empty($enrollment) && !empty($strDate) && !empty($endDate)){
            $orderFoodLists = MealList::join('users', 'meal_lists.user_id', 'users.id')
            ->select('meal_lists.*', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.enrollment', 'users.designation_id', 'users.phone')
            ->where('users.enrollment', $enrollment)
            ->where('meal_lists.strDate', '>=', $strDate)
            ->where('meal_lists.strDate', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();
            return view('backend.foodList.orderFood', compact('orderFoodLists'));
        }
        elseif(!empty($enrollment) && empty($strDate) && !empty($endDate)){
            $notification = array(
                'Message' => 'Pease Select Start Date',
                'alert-type' => 'error'
            );
            return redirect()->route('admin.order.food')->with($notification);
        }
        elseif(!empty($enrollment) && !empty($strDate) && empty($endDate)){
            $notification = array(
                'Message' => 'Pease Select End Date',
                'alert-type' => 'error'
                );
            return redirect()->route('admin.order.food')->with($notification);
        }
        elseif(empty($enrollment) && !empty($strDate) && empty($endDate)){
            $notification = array(
                'Message' => 'Pease Select End Date',
                'alert-type' => 'error'
                );
            return redirect()->route('admin.order.food')->with($notification);
        }
        elseif(empty($enrollment) && empty($strDate) && !empty($endDate)){
            $notification = array(
                'Message' => 'Please Select Start Date',
                'alert-type' => 'error'
                );
            return redirect()->route('admin.order.food')->with($notification);
        }
        elseif(empty($enrollment) && empty($strDate) && empty($endDate)){
            $notification = array(
                'Message' => 'Please Select Enroll Field or Date Range Field',
                'alert-type' => 'error'
                );
            return redirect()->route('admin.order.food')->with($notification);
        }else{
            $notification = array(
                'Message' => 'Something Went Wrong',
                'alert-type' => 'error'
                );
            return redirect()->route('admin.order.food')->with($notification);
        }
    }
}
