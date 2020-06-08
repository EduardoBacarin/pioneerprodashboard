@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')


    <h1>
        Fleet Things Orders 
    <a href="{{route('ftorders.save')}}" class="btn btn-sm btn-success">Update Orders</a>
    </h1>

    <form  style="float:right; margin-top: -30px;" class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

@endsection

@section('content')
<div class="card">
    <div class="card-body">

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

