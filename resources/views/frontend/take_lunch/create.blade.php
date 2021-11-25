@extends('frontend.layouts.master')
@section('title')
   Take Lunch
@endsection

@section('user-main')
<div class="row">
    <div class="col-md-6 col-sm-12 mt-5">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-align-center">Meal Requisition</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('user.take.lunch.store') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    @csrf
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="name" name="name" value="{{ $name }}" required="required" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="enrollment">Enrollment <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="enrollment" name="enrollment" required="required" class="form-control" value="{{ $enrollment }}" disabled>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="designation" class="col-form-label col-md-3 col-sm-3 label-align">Designation <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="designation" class="form-control" type="text" name="designation" value="{{ $designation }}" disabled>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="strDate" class="col-form-label col-md-3 col-sm-3 label-align">Today's Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="strDate" class="form-control" type="text" name="strDate" value="{{ $todayDate }}" disabled>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="dayName" class="col-form-label col-md-3 col-sm-3 label-align">Today: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="dayName" class="form-control" type="text" name="dayName" value="{{ $dayName }}" disabled>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="meal_no" class="col-form-label col-md-3 col-sm-3 label-align">Number of meal: <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="meal_no" class="form-control @error('meal_no') is-invalid @enderror" type="text" name="meal_no">
                            <input id="strDate" class="form-control" type="hidden" name="strDate" value="{{ $todayDate }}">
                            <input id="dayName" class="form-control" type="hidden" name="dayName" value="{{ $dayName }}">
                            @error('meal_no')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 mt-5">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-align-center">Menu List <small>for this week</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Day</th>
                        <th>Menu</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($daily_lunches as $lunch)
                      <tr>
                        <th scope="row">{{ $lunch->itemDay }}</th>
                        <td>{{ $lunch->itemName }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
