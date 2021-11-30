<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $designations = Designation::all();
        return view('backend.designation.index', compact('designations'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        return view('backend.designation.create');
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'designation' => 'required',
            'food_price' => 'required|numeric|gt:0',
        ]);
        try {
            DB::beginTransaction();
            $designation = new Designation();
            $designation->designation = $request->designation;
            $designation->food_price = $request->food_price;
            $designation->save();
            DB::commit();
            $notification = array(
            'Message' => 'New Designation Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('admin.designation.index')->with($notification);

        } catch (\Exception $e) {
                session()->flash('db_error', $e->getMessage());
                DB::rollBack();
                return back();
        }
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'designation' => 'required',
            'food_price' => 'required|numeric|gt:0',
        ]);
        $designation = Designation::where('id', $id)->first();
        try {
            DB::beginTransaction();
            $designation->designation = $request->designation;
            $designation->food_price = $request->food_price;
            $designation->update();
            DB::commit();
            $notification = array(
            'Message' => 'Designation Updated Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('admin.designation.index')->with($notification);

        } catch (\Exception $e) {
                session()->flash('db_error', $e->getMessage());
                DB::rollBack();
                return back();
        }
    }

    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $designation = Designation::where('id', $id)->first();

        $designation->delete();

        $notification = array(
            'Message' => 'Designation Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.designation.index')->with($notification);
    }
}
