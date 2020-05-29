@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')

    <h1>Update Order ID - {{$orderId->Id}}</h1>

@endsection

@section('content')

    <div class="card">
    
        <div class="card-body">
            <form method = "POST"  action="{{route('ftorders.update', $orderId->Id)}}" class ="form-horizontal">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="CustomerEmail">Customer E-mail</label>
                            <input type="text" class="form-control" placeholder="Email" name="CustomerEmail" value="{{$orderId->CustomerEmail}}"readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Approved">Approved</label>
                            <select class="form-control" name="Approved" value="{{$orderId->Approved}}">
                            <option {{($orderId->Approved == 'no' ? 'selected' : '')}}>No</option>
                            <option {{($orderId->Approved == 'yes' ? 'selected' : '')}}>Yes</option>
                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="StoreName">Store Name</label>
                            <input type="text" class="form-control" placeholder="text" name="StoreName" value="{{$orderId->StoreName}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="RequestShipment">Request Shipment</label>
                            <select class="form-control" name="RequestShipment" value="{{$orderId->RequestShipment}}">
                            <option {{($orderId->RequestShipment == 'no' ? 'selected' : '')}}>No</option>
                            <option {{($orderId->RequestShipment == 'yes' ? 'selected' : '')}}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="OrderTotal">OrderTotal</label>
                            <input type="text" class="form-control" placeholder="text" name="OrdetTotal" value="{{$orderId->OrderTotal}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ShipmentReady">Shipment Ready</label>
                            <select class="form-control" name="ShipmentReady" value="{{$orderId->ShipmentReady}}">
                            <option {{($orderId->ShipmentReady == 'no' ? 'selected' : '')}}>No</option>
                            <option {{($orderId->ShipmentReady == 'yes' ? 'selected' : '')}}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="OrderStatus">Order Status</label>
                            <input type="text" class="form-control" placeholder="text" name="OrderStatusId" value="{{$orderId->OrderStatusId}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="RequestInvoice">Request Invoice</label>
                            <select class="form-control" name="RequestInvoice" value="{{$orderId->RequestInvoice}}">
                            <option {{($orderId->RequestInvoice == 'no' ? 'selected' : '')}}>No</option>
                            <option {{($orderId->RequestInvoice == 'yes' ? 'selected' : '')}}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ShippingStatusId">Shipping Status</label>
                            <input type="text" class="form-control" placeholder="text" name="ShippingStatusId" value="{{$orderId->ShippingStatusId}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Invoice Ready">Invoice Ready</label>
                            <select class="form-control" name="InvoiceReady" value="{{$orderId->InvoiceReady}}">
                            <option {{($orderId->InvoiceReady == 'no' ? 'selected' : '')}}>No</option>
                            <option {{($orderId->InvoiceReady == 'yes' ? 'selected' : '')}}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PaymentStatusId">Payment Status</label>
                            <input type="text" class="form-control" placeholder="text" name="PaymentStatusId" value="{{$orderId->PaymentStatusId}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="QbReady">Quick Books Ready</label>
                            <select class="form-control" name="QbReady" value="{{$orderId->QbReady}}">
                            <option {{($orderId->QbReady == 'no' ? 'selected' : '')}}>No</option>
                            <option {{($orderId->QbReady == 'yes' ? 'selected' : '')}}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="CustomerCurrencyCode">Customer Currency</label>
                            <input type="text" class="form-control" placeholder="text" name="CustomerCurrencyCode" value="{{$orderId->CustomerCurrencyCode}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="CurrencyRate">Currency Rate</label>
                        <input type="text" class="form-control" placeholder="text" name="CurrencyRate" value="{{$orderId->CurrencyRate}}" readonly>
                    </div>
                </div>
            </div>
            
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
        
        </div>
        </div>

    </form>
 @endsection
        </div>
    </div>
