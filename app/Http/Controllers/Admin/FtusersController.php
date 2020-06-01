<?php

namespace App\Http\Controllers\Admin;

use App\Ftuser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp;
use GuzzleHttp\Client;

class FtusersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $client = new Client();
           
            $url = "http://sh4d0w:654607@multcommerce.com:8080/ListBillingAddressFromBegining.php?listorders=226";
            $ftusers = json_decode(file_get_contents($url));

            $data = array();
            //dd($ftusers);
            foreach($ftusers as $ftuser) {
                
                if (DB::table('ftusers')->where('id', $ftuser->Customer_Id)->doesntExist())
                    $data = array(
                        'id' => $ftuser->Customer_Id,
                        'firstname' => $ftuser->FirstName,
                        'lastname' => $ftuser->LastName,
                        'email' => $ftuser->CustomerEmail,
                        'addressemail' => $ftuser->AddressEmail,
                        'address1' => $ftuser->Address1
                    );
            
        
            //print(sizeof($data));
            //var_dump($data);
            //die();
            if(sizeof($data)>0 && $data['firstname'] != null) {
                DB::table('ftusers')->InsertOrIgnore($data);

        }
        $qty = $request['qtd'] ?: 10;
        $page = $request['page'] ?: 1;

        Paginator::currentPageResolver (function() use ($page) {
            return $page;
        });

        $users = DB::table('ftusers')->orderBy('id','desc')->paginate($qty);
        $users = $users->appends(Request::capture()->except('page'));
    }
    return view('admin.ftusers.index', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
