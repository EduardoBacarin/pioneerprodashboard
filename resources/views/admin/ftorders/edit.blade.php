@extends('adminlte::page')

@section('title', 'Order Edit')

@section('content_header')

    <h1 style="text-align:center;">Order Summary ID - {{$orderId->Id}}</h1>

@endsection

@section('content')

<!-- ORDER SUMMARY -->    
    <div class="card">
        <div class="card-body">
        <table class="table table-hover">
            <tbody>
                    <tr style="text-align:center;">
                        <td><b>Order id</b></td>
                        <td><a href="https://shop.fleetthings.com/Admin/Order/Edit/{{$orderId->Id}}">{{$orderId->Id}}</a></td>
                        <td><b>Date</b></td>
                        <td>23/05/1990</td>
                        <td><a href="">View All Customers Orders</a></td>
                    </tr> 
                    <tr style="text-align:center;">
                        <td><b>Store Name</b></td>
                        <td>{{$orderId->StoreName}}</td>
                        <td><b>E-mail</b></td>
                        <td>{{$orderId->CustomerEmail}}</td>
                        <td><a href="">View All Customers Products</a></td>
                    </tr> 
                    <tr style="text-align:center;">
                        <td><b>Customer Name</b></td>
                        <td>{{$orderId->FirstName}} {{$orderId->LastName}}</td>
                        <td><b>Customer Phone</b></td>
                        <td>996832318</td>
                        <td><a href="">View All Customers RMA</a></td>
                    </tr> 
            </tbody>
        </table>
               
        </div>
    </div>
    <h4 style="text-align:center;">Order Amount/Values</h4>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
            <tbody>
                    <?php $priceForm = function($price){
                        return number_format($price, 2, ",", ".");
                    } 
                    ?>
                    <tr style="text-align:center;">
                        <td><b>Order Amount USD</b></td>
                        <td>USD$ {{$priceForm($orderId->OrderTotal)}}</td>
                        <td><b>Currency</b></td>
                        <td>{{$orderId->CustomerCurrencyCode}}</td>
                        <td></td>
                    </tr> 
                    <tr style="text-align:center;">
                        <td><b>Order Amount MXN</b></td>
                        <?php 
                            if($orderId->CustomerCurrencyCode === "MXN") {
                            echo "<td>MXN$ {$priceForm($orderId->OrderTotal * $orderId->CurrencyRate)}</td>";
                            }else{
                                echo "<td></td>";
                            }
                        ?>
                        <td><b>Rate</b></td>
                        <td>{{$orderId->CurrencyRate}}</td>
                        <td><a href="">Update Currency</a></td>
                    </tr> 

            </tbody>
            </table>
            <br>
            <div style="text-align:right;">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('ftorders.index') }}" class="btn btn-default">Back</a>
            </div>
            
        </div>
    <div>
        </div>
    </div>

    @can('warehouse', App\User::class)    
<!-- ORDER STATUS -->
<form method = "POST"  action="{{route('ftorders.update', $orderId->Id)}}" enctype="multipart/form-data" class ="form-horizontal">
    <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}
    <h4 style="text-align:center;">Order Status</h4>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
            <tbody>
                    <tr style="text-align:center;">
                        <th><b>Order Status</b></th>
                        <th><b>Shipping Status</b></th>
                        <th><b>Payment Status</b></th>
                        <th><b>Approve Payment</b></th>
                        <th><b>Request to Ship</b></th>
                    </tr>
                    <tr style="text-align:center;">
                        <td>{{$orderId->OrderStatusId}}</td>
                        <td>{{$orderId->ShippingStatusId}}</td>
                        <td>{{$orderId->PaymentStatusId}}<br>
                        <input type="file" id="myFile" name="PaymentReceipt"><br>
                        <?php echo '<a href="../../../receipts/'.$orderId->PaymentReceipt.'" target="_blank">';?>{{$orderId->PaymentReceipt}}</a>
                        <td>
                        <div class="form-group">
                            <select class="form-control" name="Approved" value="{{$orderId->Approved}}">
                            <option {{($orderId->Approved == 'Not Approved' ? 'selected' : '')}}>Not Approved</option>
                            <option {{($orderId->Approved == 'Approved' ? 'selected' : '')}}>Approved</option>
                            </select>
                        </div>
                        </td>
                        <td>
                        <div class="form-group">
                            <select class="form-control" name="RequestShipment" value="{{$orderId->RequestShipment}}">
                            <option {{($orderId->RequestShipment == 'No' ? 'selected' : '')}}>No</option>
                            <option {{($orderId->RequestShipment == 'Yes' ? 'selected' : '')}}>Yes</option>
                            </select>
                        </div>
                        </td>
                        </td>
                    </tr> 
                    <tr style="text-align:center;">
                        <td><b>Shipment Info</b><br>
                           <p>(Update by Warehouse)</p>
                        </td>
                        <td><b>Tracking Number</b><br>
                        <input type="file" id="myFile" name="TrackingNumber"><br>
                        <?php echo '<a href="../../../tracking/'.$orderId->TrackingNumber.'" target="_blank">';?>{{$orderId->TrackingNumber}}</a>
                        </td>
                        <td><b>Shipped Images</b><br>
                        <input type="file" id="myFile" name="ShippedImages"><br>
                        <?php echo '<a href="../../../shippedimages/'.$orderId->ShippedImages.'" target="_blank">';?>{{$orderId->ShippedImages}}</a>
                        </td>
                        <td><b>IMEIs</b><br>
                        <input type="file" id="myFile" name="Imeis"><br>
                        <?php echo '<a href="../../../imeis/'.$orderId->Imeis.'" target="_blank">';?>{{$orderId->Imeis}}</a>
                        </td>
                        <td>
                            <b>Shipment Ready</b><br>
                            <div class="form-group">
                                <select class="form-control" name="ShipmentReady" value="{{$orderId->ShipmentReady}}">
                                    <option {{($orderId->ShipmentReady == 'No' ? 'selected' : '')}}>No</option>
                                    <option {{($orderId->ShipmentReady == 'Yes' ? 'selected' : '')}}>Yes</option>
                                </select>
                            </div>
                        </td>
                    </tr>
            </tbody>
            </table>
            
                <div class="input-group col-md-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Notes</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="ShipmentNotes">{{$orderId->ShipmentNotes}}</textarea>
                </div>
<br>
                 <div style="text-align:right;">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('ftorders.index') }}" class="btn btn-default">Back</a>
                </div>

        </div>
    <div>
        </div>
    </div>
</form>
@endcan
@can('accounting', App\User::class)    


<!-- ACCOUNT UPDATES -->
<form method = "POST"  action="{{route('ftorders.update', $orderId->Id)}}" enctype="multipart/form-data" class ="form-horizontal">
    <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}
    <input type="hidden" name="Id" value="{{$orderId->Id}}">
    <h4 style="text-align:center;">Account Updates</h4>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
            <tbody>
                    <tr style="text-align:center;">
                        <th><b>Gestionix</b></th></th>
                        <th><b>Invoice Request</b></th>
                        <th><b>Invoice Upload</b></th>
                        <th><b>Venta Upload</b></th>
                    </tr>
                    <tr style="text-align:center;">
                    <td></td>
                        <td><div class="form-group">
                            <select class="form-control" name="RequestInvoice" value="{{$orderId->RequestInvoice}}">
                            <option {{($orderId->RequestInvoice == 'Not Requested' ? 'selected' : '')}}>Not Requested</option>
                            <option {{($orderId->RequestInvoice == 'Requested' ? 'selected' : '')}}>Requested</option>
                            </select>
                        </div></td>
                        <td>
                            <input type="file" id="myFile" name="InvoiceFile"><br>
                            <?php echo '<a href="../../../invoices/'.$orderId->InvoiceFile.'" target="_blank">';?>{{$orderId->InvoiceFile}}</a>
                        </td>
                        <td> 
                            <input type="file" id="myFile" name="VentaFile"><br>
                            <?php echo '<a href="../../../ventas/'.$orderId->VentaFile.'" target="_blank">';?>{{$orderId->VentaFile}}</a>
                        </td>
                    </tr> 
                    <tr style="text-align:center;">
                        <th><b>QuickBooks<b></b></th>
                        <th><b>Profit Only<b></th>
                        <th><b>PO<b></th>
                        <th><b>Invoice<b></th>
                        <th></a></th>
                    </tr>
                    <tr style="text-align:center;">
                    <td></td>
                        <td>
                            <input type="file" id="myFile" name="ProfitFile"><br>
                            <?php echo '<a href="../../../profits/'.$orderId->ProfitFile.'" target="_blank">';?>{{$orderId->ProfitFile}}</a>
                        <td>
                            <input type="file" id="myFile" name="PoFile"><br>
                            <?php echo '<a href="../../../pofiles/'.$orderId->PoFile.'" target="_blank">';?>{{$orderId->PoFile}}</a>
                        </td>
                        <td>
                            <input type="file" id="myFile" name="QbInvoice"><br>
                            <?php echo '<a href="../../../qbinvoices/'.$orderId->QbInvoice.'" target="_blank">';?>{{$orderId->QbInvoice}}</a>                       
                        </td>
                    </tr> 
            </tbody>
            </table>

            <div style="text-align:right;">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('ftorders.index')}}" class="btn btn-default">Back</a>
            </div>

        </div>
</form>
@endcan
@endsection
</div>