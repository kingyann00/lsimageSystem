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
        DB::unprepared('
            CREATE TRIGGER invoiceCode_store BEFORE INSERT ON INVOICES FOR EACH ROW
                BEGIN
                    INSERT INTO sequence_invoices VALUE(NULL);

                
                    SET NEW.invoice_no = CONCAT(CONCAT(CONCAT(YEAR(NEW.invoice_date)-2000,DATE_FORMAT(NEW.invoice_date,"%m")),"-"),LPAD(LAST_INSERT_ID(),4,"0"));
                END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
            DROP TRIGGER "invoiceCode_store"
        ');
    }
};
