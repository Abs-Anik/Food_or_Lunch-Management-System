<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MealList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dailyFoodLists = MealList::join('users', 'meal_lists.user_id', 'users.id')
        ->select('meal_lists.*', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.enrollment', 'users.designation', 'users.phone')
        ->whereDate('meal_lists.created_at', Carbon::today())
        ->get();
        return view('backend.foodList.dailyFood', compact('dailyFoodLists'));
    }

    public function orderFood()
    {
        $orderFoodLists = MealList::join('users', 'meal_lists.user_id', 'users.id')
        ->select('meal_lists.*', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.enrollment', 'users.designation', 'users.phone')
        ->whereMonth('meal_lists.created_at', Carbon::now()->month)
        ->orderBy('created_at', 'asc')
        ->get();
        return view('backend.foodList.orderFood', compact('orderFoodLists'));
    }
}
