<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $admins = User::where('is_admin',1)->get();
        return view('backend.admin_registration.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $roles = DB::table('roles')->get();
        $designations = Designation::all();
        return view('backend.admin_registration.create', compact('roles', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
            $request->validate([
                'first_name' => 'required|max:25',
                'last_name' => 'nullable|max:25',
                'username' => 'required|max:25|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'enrollment' => 'required|string|unique:users',
                'designation_id' => 'required',
                'password' => 'nullable|string|max:8|confirmed',
            ]);

            try {
                DB::beginTransaction();
                $admin = new User();
                $admin->first_name = $request->first_name;
                $admin->last_name = $request->last_name;
                $admin->username = $request->username;
                $admin->email = $request->email;
                $admin->enrollment = $request->enrollment;
                $admin->designation_id = $request->designation_id;
                $admin->is_admin = 1;
                $admin->password = Hash::make($request->password);

                $admin->save();

                // Assign Roles
                if ($request->roles != null) {
                    foreach ($request->roles as $role) {
                        $admin->assignRole($role);
                    }
                }

                DB::commit();
                $notification = array(
                'Message' => 'New Admin Created Successfully!',
                'alert-type' => 'success'
                );
                return redirect()->route('admin.registration.index')->with($notification);

            } catch (\Exception $e) {
                    session()->flash('db_error', $e->getMessage());
                    DB::rollBack();
                    return back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $admin = User::find($id);
        $roles = DB::table('roles')->get();
        $designations = Designation::all();
        return view('backend.admin_registration.edit', compact('roles', 'admin', 'designations'));
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'first_name' => 'required|max:25',
            'last_name' => 'nullable|max:25',
            'username' => 'required|max:25|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'enrollment' => 'required|string|unique:users,enrollment,'.$id,
            'designation_id' => 'required',
            'password' => 'nullable|string|max:8|confirmed',
        ]);

        $admin = User::find($id);
        if (is_null($admin)) {
            $notification = array(
                'Message' => 'This page is not found!',
                'alert-type' => 'success'
                );
            return redirect()->route('admin.registration.index')->with($notification);
        }
        try {
            DB::beginTransaction();
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->enrollment = $request->enrollment;
            $admin->designation_id = $request->designation_id;
            $admin->is_admin = 1;
            $admin->password = Hash::make($request->password);
            $admin->update();

            // Detach roles and Assign Roles
            $admin->roles()->detach();
            // Assign Roles
            if (!is_null($request->roles)) {
                foreach ($request->roles as $role) {
                    $admin->assignRole($role);
                }
            }

            DB::commit();

            $notification = array(
                'Message' => 'Admin Updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.registration.index')->with($notification);


        } catch (\Exception $e) {
            session()->flash('db_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
