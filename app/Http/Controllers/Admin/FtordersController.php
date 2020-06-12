<?php

namespace App\Http\Controllers\Admin;

use App\Ftorder;
use App\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp;
use GuzzleHttp\Client;
use DateTime;

class FtordersController extends Controller
{
    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $qty = $request['qtd'] ?: 10;
        $page = $request['page'] ?: 1;

        Paginator::currentPageResolver (function() use ($page) {
            return $page;
        });

        $settings = DB::table('settings')->get();
        $orders = DB::table('ftorders')->orderBy('Id','desc')->paginate($qty);
        $orders = $orders->appends(Request::capture()->except('page')); 

        return view('admin.ftorders.index', compact('orders', 'settings'));  
    
    }


    public function save(Request $request) 
    {
        $client = new Client();

        $url = "http://sh4d0w:654607@multcommerce.com:8080/ListOrdersFromBegining.php?listorders=1000";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $ftorders = json_decode(curl_exec($ch));
        //$ftorders = json_decode(file_get_contents($url));
    
        $data = array();
        
        foreach($ftorders as $ftorder) {
            
                switch ($ftorder->OrderStatusId){
                    case 10: 
                        $ftorder->OrderStatusId = "Pending";
                    break;
                    case 20: 
                        $ftorder->OrderStatusId = "Processing";
                    break;
                    case 30:
                        $ftorder->OrderStatusId = "Complete";
                    break;
                    case 40:
                        $ftorder->OrderStatusId = "Cancelled";
                    break;
                    default: 
                    $ftorder->OrderStatusId = " ";
                    break;
                }
                switch ($ftorder->ShippingStatusId){
                    case 10: 
                        $ftorder->ShippingStatusId = "Shipping Not Required";
                    break;
                    case 20: 
                        $ftorder->ShippingStatusId = "Not Yet Shipped";
                    break;
                    case 25:
                        $ftorder->ShippingStatusId = "Partially Shipped";
                    break;
                    case 30:
                        $ftorder->ShippingStatusId = "Shipped";
                    break;
                    case 40:
                        $ftorder->ShippingStatusId = "Delivered";
                    break;
                    default: 
                    $ftorder->ShippingStatusId = " ";
                    break;
                }
                switch ($ftorder->PaymentStatusId){
                    case 10: 
                        $ftorder->PaymentStatusId = "Pending";
                    break;
                    case 20: 
                        $ftorder->PaymentStatusId = "Authorized";
                    break;
                    case 30:
                        $ftorder->PaymentStatusId = "Paid";
                    break;
                    case 35:
                        $ftorder->PaymentStatusId = "PartiallyRefunded";
                    break;
                    case 40:
                        $ftorder->PaymentStatusId = "Refunded";
                    break;
                    case 50:
                        $ftorder->PaymentStatusId = "Voided";
                    break;
                    default: 
                    $ftorder->PaymentStatusId = " ";
                    break;
                }
                
                $data[] = array(
                    'Id' => $ftorder->OrderId,
                    'FirstName' => $ftorder->BillingFirstName,
                    'LastName' => $ftorder->BillingLastName,
                    'CustomerEmail' => $ftorder->CustomerEmail,
                    'StoreName' => $ftorder->StoreName,
                    'OrderTotal' => $ftorder->OrderTotal,
                    'OrderStatusId' => $ftorder->OrderStatusId,
                    'ShippingStatusId' => $ftorder->ShippingStatusId,
                    'PaymentStatusId' => $ftorder->PaymentStatusId,
                    'CustomerCurrencyCode' => $ftorder->CustomerCurrencyCode,
                    'CurrencyRate' => $ftorder->CurrencyRate,
                );
                
                if(sizeof($data)>0) {
                    $ftorders = Ftorder::updateOrInsert(
                        [
                        'Id' => $ftorder->OrderId
                        ],
                        [
                        'FirstName' => $ftorder->BillingFirstName,
                        'LastName' => $ftorder->BillingLastName,
                        'CustomerEmail' => $ftorder->CustomerEmail,
                        'StoreName' => $ftorder->StoreName,
                        'OrderTotal' => $ftorder->OrderTotal,
                        'OrderStatusId' => $ftorder->OrderStatusId,
                        'ShippingStatusId' => $ftorder->ShippingStatusId,
                        'PaymentStatusId' => $ftorder->PaymentStatusId,
                        'CustomerCurrencyCode' => $ftorder->CustomerCurrencyCode,
                        'CurrencyRate' => $ftorder->CurrencyRate,
                        ]
                    );
                    $ftupdate = Setting::updateOrInsert(
                        [
                        'id' => 6
                        ],
                        [
                        'content' => new DateTime("now")
                        ]    
                    );
                    
                    $qty = $request['qtd'] ?: 10;
                    $page = $request['page'] ?: 1;
            
                    Paginator::currentPageResolver (function() use ($page) {
                        return $page;
                    });
                    
                    $settings = DB::table('settings')->get();
                    $orders = DB::table('ftorders')->orderBy('Id','desc')->paginate($qty);
                    $orders = $orders->appends(Request::capture()->except('page'));    
                } 
        }
        if(sizeof($data)>0) {
            return view('admin.ftorders.index', compact('orders', 'settings'),);
        } else {
            return redirect('painel/ftorders'); 
        }   
        
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

        
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $orderId = Ftorder::find($id);

        return view('admin.ftorders.edit', compact('orderId'));

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
        if($file = $request->file('PaymentReceipt')) {
            $name = $file->getCLientOriginalName();
            if($file->move('receipts', $name)) {
                $data = $request->only([
                    'PaymentReceipt'
                ]);
                $data ['PaymentReceipt'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }

        if ($data = $request->only(['Approved'])) {
            DB::table('ftorders')->where('id', $id)->update($data);
        }
        if ($data = $request->only(['RequestShipment'])) {
            DB::table('ftorders')->where('id', $id)->update($data);
        }

        if($file = $request->file('TrackingNumber')) {
            $name = $file->getCLientOriginalName();
            if($file->move('tracking', $name)) {
                $data = $request->only([
                    'TrackingNumber'
                ]);
                $data ['TrackingNumber'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }

        if($file = $request->file('ShippedImages')) {
            $name = $file->getCLientOriginalName();
            if($file->move('shippedimages', $name)) {
                $data = $request->only([
                    'ShippedImages'
                ]);
                $data ['ShippedImages'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }

        if($file = $request->file('Imeis')) {
            $name = $file->getCLientOriginalName();
            if($file->move('imeis', $name)) {
                $data = $request->only([
                    'Imeis'
                ]);
                $data ['Imeis'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }

        if ($data = $request->only(['ShipmentReady'])) {
            DB::table('ftorders')->where('id', $id)->update($data);
        }

        if ($data = $request->only(['ShipmentNotes'])) {
            DB::table('ftorders')->where('id', $id)->update($data);
        }

        if ($data = $request->only(['RequestInvoice'])) {
            DB::table('ftorders')->where('id', $id)->update($data);
        }

        if($file = $request->file('InvoiceFile')) {
            $name = $file->getCLientOriginalName();
            if($file->move('invoices', $name)) {
                $data = $request->only([
                    'InvoiceFile'
                ]);
                $data ['InvoiceFile'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        };
        if($file = $request->file('VentaFile')) {
            $name =$file->getClientOriginalName();
            if($file->move('ventas', $name)) {
                $data = $request->only([
                    'VentaFile'
                ]);
                $data['VentaFile'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }
        if($file = $request->file('ProfitFile')) {
            $name =$file->getClientOriginalName();
            if($file->move('profits', $name)) {
                $data = $request->only([
                    'ProfitFile'
                ]);
                $data['ProfitFile'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }
        if($file = $request->file('PoFile')) {
            $name =$file->getClientOriginalName();
            if($file->move('pofiles', $name)) {
                $data = $request->only([
                    'PoFile'
                ]);
                $data['PoFile'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }
        if($file = $request->file('QbInvoice')) {
            $name =$file->getClientOriginalName();
            if($file->move('qbinvoices', $name)) {
                $data = $request->only([
                    'QbInvoice'
                ]);
                $data['QbInvoice'] = $name;
                DB::table('ftorders')->where('id', $id)->update($data);
            };
        }

        return redirect()->back();  
        
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
