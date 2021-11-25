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
        $menuList = MenuList::where('id', $id);

        $menuList->delete();

        $notification = array(
            'Message' => 'Menu Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.menuList.index')->with($notification);
    }
}
