<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuListController extends Controller
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
        if (is_null($this->user) || !$this->user->can('setting.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $menuLists = MenuList::all();
        return view('backend.menu_list.index', compact('menuLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('setting.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        return view('backend.menu_list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('setting.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'itemName' => 'required',
            'itemPrice' => 'required|integer',
            'itemDay' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            $menuList = new MenuList();
            $menuList->itemName = $request->itemName;
            $menuList->itemPrice = $request->itemPrice;
            $menuList->itemDay = $request->itemDay;

            $menuList->save();

            DB::commit();
            $notification = array(
            'Message' => 'New Menu Created Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('admin.menuList.index')->with($notification);

        } catch (\Exception $e) {
                session()->flash('db_error', $e->getMessage());
                DB::rollBack();
                return back();
        }
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
        if (is_null($this->user) || !$this->user->can('setting.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'itemName' => 'required',
            'itemPrice' => 'required|integer',
            'itemDay' => 'required|string',
        ]);

        $menuList = MenuList::where('id', $id)->first();

        try {

            DB::beginTransaction();
            $menuList->itemName = $request->itemName;
            $menuList->itemPrice = $request->itemPrice;
            $menuList->itemDay = $request->itemDay;


            $menuList->save();

            DB::commit();
            $notification = array(
            'Message' => 'Menu Updated Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('admin.menuList.index')->with($notification);

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
        if (is_null($this->user) || !$this->user->can('setting.delete')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $menuList = MenuList::where('id', $id)->first();

        $menuList->delete();

        $notification = array(
            'Message' => 'Menu Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.menuList.index')->with($notification);
    }
}
