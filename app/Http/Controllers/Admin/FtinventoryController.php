<?php

namespace App\Http\Controllers\Admin;

use App\Ftinventory;
use App\Http\Controllers\Controller;
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

         $data = DB::table('inventory')->orderBy('id')->get();
         return view('admin.ftinventory.index', compact('data'));
        }
    
        function import(Request $request)
        {
         $this->validate($request, [
          'select_file'  => 'required|mimes:xls,xlsx'
         ]);
    
         $path = $request->file('select_file')->getRealPath();
    
         $data = Excel::load($path)->get();
    
         if($data->count() > 0)
         {
          foreach($data->toArray() as $key => $value)
          {
           foreach($value as $row)
           {
            $insert_data[] = array(
             'Clave'  => $row['ProductSKU'],
             'Nombre'   => $row['ProductName'],
             'Inventario'   => $row['Quantity']
            );
           }
          }
    
          if(!empty($insert_data))
          {
           DB::table('inventory')->insert($insert_data);
          }
         }
         return back()->with('success', 'Excel Data Imported successfully.');
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
