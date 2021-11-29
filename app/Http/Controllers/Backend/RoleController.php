<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Contracts\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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

    public function index(Role $role)
    {
        if (is_null($this->user) || !$this->user->can('role.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $roles = DB::table('roles')->select('id', 'name')->get();

        return view('backend.role_permission.index', compact('roles'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $permissions_group = User::getAdminPermissionGroups();
        $all_permissions = DB::table('permissions')->select('id', 'name')->get();
        return view('backend.role_permission.create', compact('permissions_group', 'all_permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $roleModel)
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'name'  => 'required|max:100|unique:roles'
        ]);

        try {

            DB::beginTransaction();
            $permissions = $request->input('permissions');
            DB::table('roles')->insert([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            $role = $roleModel::findByName($request->name, 'web');

            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            $notification = array(
                'Message' => 'Role Created successfully!',
                'alert-type' => 'success'
            );
            DB::commit();
            return redirect()->route('admin.rolePermission.index')->with($notification);
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
    public function show($id, Role $roleModel)
    {
        if (is_null($this->user) || !$this->user->can('role.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $role = $roleModel::findById($id, 'web');
        $permissions_group = User::getAdminPermissionGroups();
        $all_permissions = DB::table('permissions')->select('id', 'name')->get();
        return view('backend.role_permission.show', compact('permissions_group', 'role', 'all_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Role $role)
    {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $role = $role::findById($id, 'web');
        $permissions_group = User::getAdminPermissionGroups();
        $all_permissions = DB::table('permissions')->select('id', 'name')->get();
        return view('backend.role_permission.edit', compact('permissions_group', 'role', 'all_permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Role $roleModel)
    {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $role = $roleModel::findById($id, 'web');
        if (is_null($role)) {
            $notification = array(
                'Message' => 'The Page is not found!',
                'alert-type' => 'error'
            );
            return redirect()->route('admin.rolePermission.index')->with($notification);
        }

        $request->validate([
            'name'  => 'required|max:100|unique:roles,name,' . $id
        ]);

        try {
            DB::beginTransaction();
            $role->name = $request->name;
            $role->save();

            // Update the permissions
            $permissions = $request->permissions;
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            DB::commit();
            $notification = array(
                'Message' => 'Role Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.rolePermission.index')->with($notification);
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
    public function destroy($id, Role $roleModel)
    {
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $role = $roleModel::findById($id, 'web');
        if (is_null($role)) {
            $notification = array(
                'Message' => 'The Page is not found!',
                'alert-type' => 'error'
            );
            return redirect()->route('admin.rolePermission.index')->with($notification);
        }
        $role->delete();

        $notification = array(
            'Message' => 'Role Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.rolePermission.index')->with($notification);
    }
}
