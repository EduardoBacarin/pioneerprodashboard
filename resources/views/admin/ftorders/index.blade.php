@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')

    <h1>
        Fleet Things Orders 
    </h1>
    <form action="{{route('ftorders.save')}}" method="POST">
    <a href="{{route('ftorders.save')}}" class="btn btn-sm btn-success" name="click">Update Orders</a>
    </form>
  
        <?php
        foreach ($settings as $setting) {
            if ($setting->id === 6) {
                echo "Last Update at: " . $setting->content;
            }
            
        }
        ?>
@endsection

@section('content')
<div class="card">
    <div class="card-body" >
    <table>
    <tr>
    <td>
    <form action="{{route('ftorders.searchorderid')}}" method="POST" class= "form form-inline">
        @csrf
            <input type="text" name= "searchOrderId" value = "{{$searchOrderId}}" placeholder = "Order Id">
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
        </form>
    </td>
    <td>
        <form action="{{route('ftorders.searchstorename')}}" method="POST" class= "form form-inline">
        @csrf
            <select name="searchStoreName" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Store Name</option>
                <option type="search" value="Fleetthings">Fleetthings</option>
                <option type="search" value="FleetThings Mexico">FleetThings Mexico</option>
                <option type="search" value="TopFlyAmericas">TopFlyAmericas</option>
            </select>
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
        </form>
    </td>
    <td>
        <form action="{{route('ftorders.searchorderstatus')}}" method="POST" class= "form form-inline">
        @csrf
            <select name="searchOrderStatus" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Order Status</option>
                <option type="search" value="Complete">Complete</option>
                <option type="search" value="Pending">Pending</option>
                <option type="search" value="Cancelled">Cancelled</option>
            </select>
            
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>

        </form>
    </td>
    <td>
        <form action="{{route('ftorders.searchpaymentstatus')}}" method="POST" class= "form form-inline">
        @csrf
            <select name="searchPaymentStatus" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Payment Status</option>
                <option type="search" value="Authorized">Authorized</option>
                <option type="search" value="Pending">Pending</option>
                <option type="search" value="Paid">Paid</option>
                <option type="search" value="PartiallyRefunded">PartiallyRefunded</option>
                <option type="search" value="Refunded">Refunded</option>
                <option type="search" value="Voided">Voided</option>
            </select>

            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>

        </form>
    </td>
    <td>
        <form action="{{route('ftorders.searchshippingstatus')}}" method="POST" class= "form form-inline">
        @csrf
            <select name="searchShippingStatus" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Shipping Status</option>
                <option type="search" value="Shipping Not Required">Shipping Not Required</option>
                <option type="search" value="Not Yet Shipped">Not Yet Shipped</option>
                <option type="search" value="Partially Shipped">Partially Shipped</option>
                <option type="search" value="Shipped">Shipped</option>
                <option type="search" value="Delivered">Delivered</option>
            </select>

            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
    </td>        
        </form>
        </tr>
        </table>
         <br>
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Order Id</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Customer Email</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Store</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Amount</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Status</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Paid</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Shipping Status</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Currency Rate</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Amount in Currency</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Save Changes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)  
                    <tr>
                        <td style="border:none;  background-color: #f2f2f2;"><a href="https://shop.fleetthings.com/Admin/Order/Edit/{{$order->Id}}"  target="_blank">{{$order->Id}}</a></td>
                        <td style="border:none;  background-color: #f2f2f2;">{{$order->CustomerEmail}}</td>
                        <td style="border:none;  background-color: #f2f2f2;">{{$order->StoreName}}</td>
                        <td style="border:none;  background-color: #f2f2f2;">
                            <?php $priceForm = function($price){
                            return number_format($price, 2, ".", ",");
                            } 
                            ?>
                            US$ {{$priceForm($order->OrderTotal)}}
                        </td>
                        <!--ORDER STATUS BUTTON-->
                        <?php 
                        if ($order->OrderStatusId == "Pending"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-warning btn-sm disabled" role="button" aria-disabled="">'.$order->OrderStatusId.'</a></td>';
                        }
                        else if ($order->OrderStatusId == "Processing"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-primary btn-sm disabled" role="button" aria-disabled="true">'.$order->OrderStatusId.'</a></td>';
                        } 
                        else if ($order->OrderStatusId == "Complete"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-success btn-sm disabled" role="button" aria-disabled="true">'.$order->OrderStatusId.'</a></td>';
                        }
                        else if ($order->OrderStatusId == "Cancelled"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-danger  btn-sm disabled" role="button" aria-disabled="true">'.$order->OrderStatusId.'</a></td>';
                        }                       
                        ?>                        
                        <!--PAID STATUS BUTTON-->
                        <?php 
                        if ($order->PaymentStatusId == "Pending"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-warning btn-sm disabled" role="button" aria-disabled="true">'.$order->PaymentStatusId.'</a></td>';
                        }
                        else if ($order->PaymentStatusId == "Authorized"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-primary btn-sm disabled" role="button" aria-disabled="true">'.$order->PaymentStatusId.'</a></td>';
                        } 
                        else if ($order->PaymentStatusId == "Paid"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-success btn-sm disabled" role="button" aria-disabled="true">'.$order->PaymentStatusId.'</a></td>';
                        }
                        else if ($order->PaymentStatusId == "PartiallyRefunded"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-danger  btn-sm disabled" role="button" aria-disabled="true">'.$order->PaymentStatusId.'</a></td>';
                        }  
                        else if ($order->PaymentStatusId == "Refunded"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-danger  btn-sm disabled" role="button" aria-disabled="true">'.$order->PaymentStatusId.'</a></td>';
                        }  
                        else if ($order->PaymentStatusId == "Voided"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-dark  btn-sm disabled" role="button" aria-disabled="true">'.$order->PaymentStatusId.'</a></td>';
                        }                       
                        ?> 
                        <!--SHIPPING STATUS BUTTON-->
                        <?php 
                        if ($order->ShippingStatusId == "Partially Shipped"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-warning btn-sm disabled" role="button" aria-disabled="true">'.$order->ShippingStatusId.'</a></td>';
                        }
                        else if ($order->ShippingStatusId == "Shipped"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-primary btn-sm disabled" role="button" aria-disabled="true">'.$order->ShippingStatusId.'</a></td>';
                        } 
                        else if ($order->ShippingStatusId == "Delivered"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-success btn-sm disabled" role="button" aria-disabled="true">'.$order->ShippingStatusId.'</a></td>';
                        }
                        else if ($order->ShippingStatusId == "Not Yet Shipped"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-danger  btn-sm disabled" role="button" aria-disabled="true">'.$order->ShippingStatusId.'</a></td>';
                        }  
                        else if ($order->ShippingStatusId == "Shipping Not Required"){
                            echo '<td style="border:none;  background-color: #f2f2f2;"><a href="#" class="btn btn-secondary  btn-sm disabled" role="button" aria-disabled="true">'.$order->ShippingStatusId.'</a></td>';
                        }                     
                        ?>
                        <td style="border:none;  background-color: #f2f2f2;">{{$order->CustomerCurrencyCode}} {{$order->CurrencyRate}}</td>

                            <?php 
                                if($order->CustomerCurrencyCode === "MXN") {
                                echo "<td style='border:none;  background-color: #f2f2f2;'>MXN$ {$priceForm($order->OrderTotal * $order->CurrencyRate)}</td>";
                                }else{
                                    echo "<td style='border:none;  background-color: #f2f2f2;'>USD$ {$priceForm($order->OrderTotal)}</td>";
                                }
                            ?>
                        <td style="border:none;  background-color: #f2f2f2;">
                            <div class="Update">
                            <a href="{{route('ftorders.edit', $order->Id)}}" class="btn btn-md btn-info">Edit</a>
                            </div>
                            </td>

                        <tr>
                        <tr>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td  name = "Approved" style="border:none;">
                            <b>Approved</b><br>
                            </td>
                            <td name = "Request Shipment" style="border:none;">
                                <b>Request Shipment</b><br>
                            </td>
                            <td name = "Shipment Ready" style="border:none;">
                                <b>Shipment Ready</b><br>
                            </td>
                            <td name = "Request Invoice" style="border:none;">
                                <b>Request Invoice</b><br>
                            </td>
                            <td name = "InvoiceReady" style="border:none;">
                                <b>Invoice Ready</b><br>
                            </td>
                            <td name="QbReady" style="border:none;">
                                <b>Qb Ready</b><br>
                            </td>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                        </tr>
                        </tr>
                        <tr>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                            <td  name = "Approved" style="border:none;">
                                {{$order->Approved}}
                            </td>
                            <td name = "Request Shipment" style="border:none;">
                                {{$order->RequestShipment}}
                            </td>
                            <td name = "Shipment Ready" style="border:none;">
                                {{$order->ShipmentReady}}
                            </td>
                            <td name = "Request Invoice" style="border:none;">
                                {{$order->RequestInvoice}}
                            </td>
                            <td name = "InvoiceReady" style="border:none;">
                                {{$order->InvoiceReady}}
                            </td>
                            <td name="QbReady" style="border:none;">
                                {{$order->QbReady}}
                            </td>
                            <td style="border:none;"></td>
                            <td style="border:none;"></td>
                        </tr>
                    </tr> 
                @endforeach

            </tbody>
        </table>
        <div class="row">
            {{ $orders->links() }}
        </div>
    </div>
</div>


@endsection
