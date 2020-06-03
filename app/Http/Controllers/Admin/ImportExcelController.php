<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp;
use GuzzleHttp\Client;

class ImportExcelController extends Controller
{
        function index()
        {
         $data = DB::table('inventory')->orderBy('id')->get();
         return view('import_excel', compact('data'));
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
}
