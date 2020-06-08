<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ftorder;

class FtordersController extends Controller
{

    public function index()
    {
        return Ftorder::all();
    }



    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
