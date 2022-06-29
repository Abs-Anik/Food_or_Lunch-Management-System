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
          <p class="text-center"><sup class="text-danger">*</sup> Amounts will be updated after entering your daily meal</p>
            @if(!empty($totalPayable))
                <h4 class="text-center text-success">{{ $totalPayable }} Taka</h4>
                <p class="text-center text-success"><strong>You need to pay this amount.</strong></p>
            @else
                <h3 class="text-center">00</h3>
                <p class="text-center"><strong>You have not taken any meal</strong></p>
            @endif
            @if(!empty($totalAmount))
                <h4 class="text-center">{{ $totalAmount }} Taka</h4>
                <p class="text-center"><strong>Without Subsidiaries Amount.</strong></p>
            @else
                <h3 class="text-center">00</h3>
                <p class="text-center"><strong>You have not taken any meal</strong></p>
            @endif

            @if(!empty($subsidiaries))
                <h4 class="text-center text-info">{{ $subsidiaries }} Taka</h4>
                <p class="text-center text-info"><strong>Total Subsidiaries Amount.</strong></p>
            @elseif ($subsidiaries == 0)
              <h3 class="text-center">00</h3>
              <p class="text-center"><strong>You have not any Subsidiaries</strong></p>
            @else
                <h3 class="text-center">00</h3>
                <p class="text-center"><strong>You have not taken any meal</strong></p>
            @endif
        </div>

       
        
      </div>
    </div>

  </div>



@endsection
