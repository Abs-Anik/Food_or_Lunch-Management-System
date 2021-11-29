<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MealList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $date = Carbon::now();
        $today = $date->toDateString();
        $user = User::all();
        $totalUser = $user->count();
        $todaysMeal = MealList::where('strDate', $today)->sum('meal_no');

        // $dates = MealList::select('strDate')
        //     ->whereMonth('created_at', Carbon::now()->month)
        //     ->get();
        // $mealLists = [];
        // foreach($dates as $date){
        //     $data = MealList::where('strDate', $date->strDate)->sum('meal_no');
        //     array_push($mealLists, $data);
        // }

        // return $mealLists;

        $currentMonthMealLists = MealList::select("strDate", DB::raw("SUM(meal_no) as total"))
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->groupBy("strDate")
                    ->get();

        return view('backend.admin.index', compact('totalUser', 'todaysMeal', 'currentMonthMealLists'));
    }
}
