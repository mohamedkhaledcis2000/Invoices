<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoices_number');
            $table->date('invoices_date');
            $table->dateTime('invoices_done_date');
            $table->string('product');
            $table->string('section');
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->decimal('commission',8,2);
            $table->string('discount');
            $table->string('tax_rate');
            $table->decimal('tax_value',8,2);
            $table->decimal('total',8,2);
            $table->string('status',58);
            $table->enum('status_value',['paid','under Paying','Not Paid']);
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
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
}
