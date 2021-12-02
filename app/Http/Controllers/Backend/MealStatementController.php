<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MealList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MealStatementController extends Controller
{
    public function mealStatement(){
        $results = DB::table('meal_lists')
        ->select('user_id')
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

        // return $itemValue;
        return view('backend.statement.index', compact('itemValue'));
    }
}
