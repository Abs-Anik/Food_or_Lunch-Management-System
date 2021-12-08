<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ManageTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    public function create(){
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $time = ManageTime::first();

        return view('backend.time.createOrupdate', compact('time'));

    }

    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'lastTime' => 'required|digits:2'
        ]);

        try {
            DB::beginTransaction();
            $time = new ManageTime();
            $time->lastTime = $request->lastTime;
            $time->save();
            DB::commit();
            $notification = array(
            'Message' => 'Time Created Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('admin.time.management.create')->with($notification);

        } catch (\Exception $e) {
                session()->flash('db_error', $e->getMessage());
                DB::rollBack();
                return back();
        }

    }

    public function update(Request $request, $id){
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'lastTime' => 'required|digits:2'
        ]);
        $time = ManageTime::where('id', $id)->first();
        try {
            DB::beginTransaction();
            $time->lastTime = $request->lastTime;
            $time->update();
            DB::commit();
            $notification = array(
            'Message' => 'Time Updated Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('admin.time.management.create')->with($notification);

        } catch (\Exception $e) {
                session()->flash('db_error', $e->getMessage());
                DB::rollBack();
                return back();
        }

    }
}
