@extends('backend.layouts.master')
@section('title')
    Admin Dashboard
@endsection

@section('main-content')
<div class="main-content">
    <!-- header area start -->
    @include('backend.layouts.partials.header')
    <!-- header area end -->
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Admin Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard.index') }}">Lunch Management System</a></li>
                        <li><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    <img class="avatar user-thumb" src="{{ asset('public/backend/assets/images/author/avatar.png')}}" alt="avatar">
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown" style="text-transform: capitalize">{{ Auth::user()->username }} <i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Profile Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <!-- sales report area start -->
        <div class="sales-report-area mt-5 mb-5">
            <div class="row">
                <div class="col-md-6 box-two">
                    <div class="single-report box-shadow mb-xs-30">
                        <div class="s-report-inner box-one pr--20 pt--30 mb-3">
                            <h4>
                                Today's Meal Number:
                                @if (!empty($todaysMeal))
                                {{ $todaysMeal }}
                                @else
                                  0
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 box-two">
                    <div class="single-report box-shadow mb-xs-30">
                        <div class="s-report-inner box-one pr--20 pt--30 mb-3">
                            <h4>
                                Total User:
                                @if (!empty($totalUser))
                                {{ $totalUser }}
                                @else
                                  0
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5 table-responsive">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <h4 class="header-title mb-0">Daily Lunch Record</h4>
                </div>
                <div id="barchart_material" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Date', 'Meal Number'],

        @php
          foreach($currentMonthMealLists as $mealList) {
              echo "['".$mealList->strDate."', ".$mealList->total."],";
          }
        @endphp
    ]);

    var options = {
      bars: 'vertical'
    };
    var chart = new google.charts.Bar(document.getElementById('barchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
@endsection
