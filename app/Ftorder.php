<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftorder extends Model
{
    protected $fillable = [
        "Id", "CustomerEmail", "StoreName", "OrderTotal", "OrderStatusId", "ShippingStatusId", "PaymentStatusId", "CustomerCurrencyCode", "CurrencyRate", "PaymentReceipt",
         "Approved", "RequestShipment","TrackingNumber", "ShippedImages", "Imeis", "ShipmentReady", "RequestInvoice", "InvoiceReady", "QbReady", "ShipmentNotes", "InvoiceFile", 'VentaFile', 'ProfitFile',
         'PoFile', 'Qbinvoice', 'created_at', 'updated_at' 
    ];
    protected $table = "ftorders";

}
