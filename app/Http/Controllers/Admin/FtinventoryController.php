<?php

namespace App\Http\Controllers\Admin;

use App\Ftinventory;
use App\Http\Controllers\Controller;
use App\Imports\ImportInventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Excel;

class FtinventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $data = Ftinventory::orderBy('id')->get();
         return view('admin.ftinventory.index', compact('data'));
        }
    
        function import(Request $request)
        {
            $request->validate(['import_file' => 'required']);

            Excel::import(new ImportInventory, request()->file('import_file'));
            return back()->with('success','Inventory Imported');
        }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
