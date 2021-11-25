@extends('frontend.layouts.master')
@section('title')
    User Dashboard
@endsection

@section('user-main')
<div class="row">
    <div class="col-md-6 col-sm-6 ">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Have you today's meal?</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          @if(!empty($todaysMeal))

            <h1 class="text-center">Yes</h1>
            <p class="text-center"><strong>Number of Meal: 0{{ $todaysMeal->meal_no }}</strong></p>
          @else
            <h1 class="text-center">No</h1>
            <p class="text-center"><strong>Number of Meal: 0</strong></p>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 ">
      <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
          <h2>Total Payable for this month</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @if(!empty($totalPayable))
                <h1 class="text-center">{{ $totalPayable }} Taka</h1>
                <p class="text-center"><strong>You need to pay this and it wiil be updated after entry your daily meal</strong></p>
            @else
                <h1 class="text-center">00</h1>
                <p class="text-center"><strong>You have not taken any meal</strong></p>
            @endif
        </div>
      </div>
    </div>

  </div>



@endsection
