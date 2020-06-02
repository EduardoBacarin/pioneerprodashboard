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

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Customer Email</th>
                    <th>Store</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid</th>
                    <th>Shipping Status</th>
                    <th>Payment Currency</th>
                    <th>Currency Rate</th>
                    <th>Approved</th>
                    <th>Request Shipment</th>
                    <th>Shipment Ready</th>
                    <th>Request Invoice</th>
                    <th>Invoice Ready</th>
                    <th>Qb Ready</th>
                    <th>Save Changes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)  
                    <tr>
                        <td><a href="https://shop.fleetthings.com/Admin/Order/Edit/{{$order->Id}}"  target="_blank">{{$order->Id}}</a></td>
                        <td>{{$order->CustomerEmail}}</td>
                        <td>{{$order->StoreName}}</td>
                        <td>
                            <?php $priceForm = function($price){
                            return number_format($price, 2, ",", ".");
                            } 
                            ?>
                            US$ {{$priceForm($order->OrderTotal)}}
                        </td>
                        <td>{{$order->OrderStatusId}}</td>
                        <td>{{$order->ShippingStatusId}}</td>
                        <td>{{$order->PaymentStatusId}}</td>
                        <td>{{$order->CustomerCurrencyCode}}</td>
                        <td>{{$order->CurrencyRate}}</td>
                        <td name = "Approved">
                            {{$order->Approved}}
                            </td>
                            <td name = "Request Shipment">
                            {{$order->RequestShipment}}
                            </td>
                            <td name = "Shipment Ready">
                            {{$order->ShipmentReady}}
                            </td>
                            <td name = "Request Invoice">
                            {{$order->RequestInvoice}}
                            </td>
                            <td name = "InvoiceReady">
                            {{$order->InvoiceReady}}
                            </td>
                            <td name="QbReady">
                            {{$order->QbReady}}
                            </td>
                            <td>
                            <div class="Update">
                            <a href="{{route('ftorders.edit', $order->Id)}}" class="btn btn-sm btn-info">Edit</a>
                            </div>
                            </td>
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

