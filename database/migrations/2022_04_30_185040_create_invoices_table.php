<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('invoice_id');
            $table->string('invoice_no')->nullable();
            $table->dateTime('invoice_date',0);
            $table->float('subtotal',15,2);
            $table->float('total_amount',15,2);
            $table->string('invoice_proof_file')->nullable();
            $table->string('bank_tranfer_file')->nullable();
            $table->string('status');
            $table->foreignId('tax_id');
            $table->foreignId('user_id');
            $table->foreignId('client_id');
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
        Schema::dropIfExists('invoices');
    }
};
