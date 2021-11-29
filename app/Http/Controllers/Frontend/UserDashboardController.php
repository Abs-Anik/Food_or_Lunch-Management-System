<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MealList;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        $date = Carbon::now();
        $todayDate =  $date->toDateString();
        $user_id = Auth::user()->id;
        $todaysMeal = MealList::where('user_id', $user_id)->where('strDate', $todayDate)->first();


        $payments = MealList::select('meal_lists.price')
        ->where('user_id', $user_id)
        ->whereMonth('created_at', Carbon::now()->month)
        ->get();

        $totalPayable = 0;

        foreach($payments as $payment)
        {
            $totalPayable = $totalPayable + (int)$payment->price;
        }

        return view('frontend.user.index', compact('todaysMeal', 'totalPayable'));
    }
}
