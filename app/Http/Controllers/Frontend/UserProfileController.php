<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfileController  extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function show()
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        $userID = Auth::user()->id;
        $user = User::where('id',$userID)->first();
        $designations = Designation::all();
        return view('frontend.profile.profile', compact('user', 'designations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }

        $userID = Auth::user()->id;
        $user = User::where('id',$userID)->first();
        $designations = Designation::all();
        return view('frontend.profile.edit', compact('user', 'designations'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'first_name' => 'required|max:25',
            'last_name' => 'nullable|max:25',
            'username' => 'required|max:25|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'enrollment' => 'required|string|unique:users,enrollment,'.$id,
            'designation_id' => 'required',
            'phone' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::where('id', $id)->first();
        try {
        DB::beginTransaction();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->enrollment = $request->enrollment;
        $user->designation_id = $request->designation_id;
        $user->phone = $request->phone;
        if($request->image)
        {
            UploadHelper::deleteFile('public/backend/assets/images/profile/user_profile/'.$user->image);
            $user->image = UploadHelper::upload('image', $request->image, $request->username . '-' . time() . '-image', 'public/backend/assets/images/profile/user_profile/', $user->image);
        }
        $user->update();
        DB::commit();
        $notification = array(
        'Message' => 'User Profile Updated Successfully!',
        'alert-type' => 'success'
        );
        return redirect()->route('user.profile.view')->with($notification);

        } catch (\Exception $e) {
            session()->flash('db_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function userPasswordChangeView()
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        return view('frontend.profile.editPassword');
    }

    public function userPasswordChangeUpdate(Request $request)
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->currentPassword])){
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->update();
            $notification = array(
                'Message' => 'Password Changed Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('user.profile.view')->with($notification);
        }else{
            $notification = array(
                'Message' => 'Sorry! your current password does not matched',
                'alert-type' => 'error'
            );
            return redirect()->route('user.password.change')->with($notification);
        }
    }
}
