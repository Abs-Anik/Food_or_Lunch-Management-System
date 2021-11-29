@extends('frontend.layouts.master')
@section('title')
Edit Password
@endsection

@section('user-main')
<div class="row p-2">
    <section class="col-md-6 offset-md-3 mt-5">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
             <h4 class="header-title">Edit Password</h4>
             <form action="{{ route('user.password.update') }}" method="POST">
                 @csrf
                 <div class="form-group">
                     <label for="currentPassword">Current Password</label>
                     <input type="password" id="currentPassword" name="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" placeholder="Enter Current Password">
                     @error('currentPassword')
                         <div class="alert alert-danger mt-2">{{ $message }}</div>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label for="password">New Password</label>
                     <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                     @error('password')
                         <div class="alert alert-danger mt-2">{{ $message }}</div>
                     @enderror
                 </div>
                 <div class="form-group">
                     <label for="passwordConfirm">Confirm Password</label>
                     <input type="password" id="passwordConfirm" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                 </div>

                 <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><i class="fa fa-check"></i> Update Password</button>
             </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
    <!-- /.card -->
    <!-- /.card -->
 </section>
</div>
@endsection
