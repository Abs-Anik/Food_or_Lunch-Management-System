@extends('frontend.layouts.master')
@section('title')
   Take Lunch
@endsection

@section('user-main')
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
           <div class="x_title">
              <h2>Daily Meal Report</h2>
              <ul class="nav navbar-right panel_toolbox">
                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                 </li>
              </ul>
              <div class="clearfix"></div>
           </div>
           <div class="x_content">
              <div class="row">
                 <div class="col-sm-12">
                    <div class="card-box table-responsive">
                       <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                             <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Meal</th>
                                <th>Action</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($meals as $meal)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$meal->strDate}}</td>
                                    <td>{{$meal->meal_no}}</td>
                                    <td>
                                        <form method="POST" action="{{route('user.take.lunch.destroy', $meal->id)}}" style="display:inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-xs-custome btn-danger show_confirm" style="cursor:pointer" id="delete"><i class="fa fa-remove"></i> Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                       </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
</div>
@endsection
