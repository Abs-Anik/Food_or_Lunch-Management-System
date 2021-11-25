@extends('backend.layouts.master')
@section('title')
    Logo & Copyright
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
                        <li><span>Settings</span></li>
                        <li><span>Logo & Copy Right</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    <img class="avatar user-thumb" src="{{ asset('public/backend/assets/images/author/avatar.png')}}" alt="avatar">
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown" style="text-transform: capitalize">{{ Auth::user()->username }} <i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Message</a>
                        <a class="dropdown-item" href="#">Settings</a>
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
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card pd-20 pd-sm-40">
                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        @if (!empty($data))
                        <h4 class="header-title mb-0 p-4">Update Logo,Copyright & Social Links</h4>
                        @else
                        <h4 class="header-title mb-0 p-4">Add Logo,Copyright & Social Links</h4>
                        @endif
                    </div>
                    <form action="{{$data !== null ? url('admin/update-logo-copyright', $data->id) : url('admin/update-logo-copyright')}}" method="post" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="form-body">
                        <div class="card-body">
                            <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="hotline" class="form-control-label">Hot Line Number: </label>
                                <input id="hotline" class="form-control @error('hotline') is-invalid @enderror" type="text" name="hotline" @if(!empty($data['hotline'])) value="{{$data['hotline']}}"
                                @else value="{{old('hotline')}}" @endif placeholder="Please give a Hotline Number" data-parsley-error-message="Please give a Hotline"  autocomplete="hotline" autofocus>
                                @error('hotline')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="toll_free_no" class="form-control-label">Toll Free Number: </label>
                                <input id="toll_free_no" class="form-control @error('toll_free_no') is-invalid @enderror" type="text" name="toll_free_no" @if(!empty($data['toll_free_no'])) value="{{$data['toll_free_no']}}"
                                @else value="{{old('toll_free_no')}}" @endif placeholder="Enter a Toll Free Number" data-parsley-error-message="Please give Toll Free Number"  autocomplete="toll_free_no" autofocus>
                                @error('toll_free_no')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="customer_service_no" class="form-control-label">Customer Service Number: </label>
                                <input id="customer_service_no" class="form-control @error('customer_service_no') is-invalid @enderror" type="text" name="customer_service_no" @if(!empty($data['customer_service_no'])) value="{{$data['customer_service_no']}}"
                                @else value="{{old('customer_service_no')}}" @endif placeholder="Enter a Customer Service Number" data-parsley-error-message="Please give Customer Service Number"  autocomplete="customer_service_no" autofocus>
                                @error('customer_service_no')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="copyright" class="form-control-label">Copy Right: </label>
                                <input id="copyright" class="form-control @error('copyright') is-invalid @enderror" type="text" name="copyright" @if(!empty($data['copyright'])) value="{{$data['copyright']}}"
                                @else value="{{old('copyright')}}" @endif placeholder="Enter Copy Right Text" data-parsley-error-message="Please give Copy Right Text"  autocomplete="copyright" autofocus>
                                @error('copyright')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="facebook_link" class="form-control-label">Facebook Link: </label>
                                <input id="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" type="text" name="facebook_link" @if(!empty($data['facebook_link'])) value="{{$data['facebook_link']}}"
                                @else value="{{old('facebook_link')}}" @endif placeholder="Enter Facebook Link" data-parsley-error-message="Please give Facebook Link"  autocomplete="facebook_link" autofocus>
                                @error('facebook_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="twitter_link" class="form-control-label">Twitter Link: </label>
                                <input id="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" type="text" name="twitter_link" @if(!empty($data['twitter_link'])) value="{{$data['twitter_link']}}"
                                @else value="{{old('twitter_link')}}" @endif placeholder="Enter Twitter Linl" data-parsley-error-message="Please give Twitter Link"  autocomplete="twitter_link" autofocus>
                                @error('twitter_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="instagram_link" class="form-control-label">Instagram Link: </label>
                                <input id="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" type="text" name="instagram_link" @if(!empty($data['instagram_link'])) value="{{$data['instagram_link']}}"
                                @else value="{{old('instagram_link')}}" @endif placeholder="Enter Instagram Link" data-parsley-error-message="Please give Instagram Link"  autocomplete="instagram_link" autofocus>
                                @error('instagram_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="youtube_link" class="form-control-label">YouTube Link: </label>
                                <input id="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" type="text" name="youtube_link" @if(!empty($data['youtube_link'])) value="{{$data['youtube_link']}}"
                                @else value="{{old('youtube_link')}}" @endif placeholder="Enter YouTube Link" data-parsley-error-message="Please give YouTube Link"  autocomplete="youtube_link" autofocus>
                                @error('youtube_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="linkdin_link" class="form-control-label">Linked In Link: </label>
                                <input id="linkdin_link" class="form-control @error('linkdin_link') is-invalid @enderror" type="text" name="linkdin_link" @if(!empty($data['linkdin_link'])) value="{{$data['linkdin_link']}}"
                                @else value="{{old('linkdin_link')}}" @endif placeholder="Enter Linked In Link" data-parsley-error-message="Please give Linked In Link"  autocomplete="linkdin_link" autofocus>
                                @error('linkdin_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            @if (!empty($data->logo))
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="logo" class="form-control-label">Logo: </label>
                                <input id="logo" class="form-control @error('logo') is-invalid @enderror dropify" type="file" name="logo"  data-parsley-error-message="Please select an Logo" data-default-file="{{asset('public/backend/assets/images/logos/'.$data->logo)}}"  autocomplete="logo" autofocus>
                                @error('logo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            @else
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="logo" class="form-control-label">Logo: </label>
                                <input id="logo" class="form-control @error('logo') is-invalid @enderror dropify" type="file" name="logo"  data-parsley-error-message="Please select an Logo" data-default-file=""  autocomplete="logo" autofocus>
                                @error('logo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            @endif
                            <!-- col-4 -->

                            </div><!-- row -->

                            <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5" style="cursor:pointer"><i class="fa fa-check"></i> {{$data !== null ? 'UPDATE' : 'SAVE'}}</button>
                            </div><!-- form-layout-footer -->
                        </div>
                        </div><!-- form-layout -->
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


