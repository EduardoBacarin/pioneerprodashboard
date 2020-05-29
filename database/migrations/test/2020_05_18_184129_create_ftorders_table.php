<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFtordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftorders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('OrderId');
            $table->string('CustomerEmail');
            $table->string('StoreName');
            $table->float('OrderTotal');
            $table->integer('OrderStatusId');
            $table->integer('ShippingStatusId');
            $table->integer('PaymentStatusId');
            $table->string('CustomerCurrencyCode');
            $table->float('CurrencyRate');
            $table->enum('Approved', ['yes', 'no'])->nullable();
            $table->enum('RequestShipment', ['yes', 'no'])->nullable();
            $table->enum('ShipmentReady', ['yes', 'no'])->nullable();
            $table->enum('RequestInvoice', ['yes', 'no'])->nullable();
            $table->enum('InvoiceReady', ['yes', 'no'])->nullable();
            $table->enum('QbReady', ['yes', 'no'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ftorders');
    }
}
