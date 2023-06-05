<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitAllotmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_allotments', function (Blueprint $table) {
            $table->id();
            $table->integer('code_id')->comment('codes');
            $table->integer('unit_id')->comment('units');
            $table->text('allocation_sector')->nullable();
            $table->double('amount')->default(0);
            $table->string('fiscal_year');
            $table->date('transaction_date');
            $table->string('memo')->nullable();
            $table->date('memo_date')->nullable();
            $table->double('demand_amount')->nullable();
            $table->string('demand_memo')->nullable();
            $table->date('demand_memo_date')->nullable();
            $table->integer('status')->default(0)->comment('0=unapproved, 1=approved');
            $table->text('description')->nullable();
            $table->integer('mail_count')->default(0)->nullable();
            $table->integer('sms_count')->default(0)->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->integer('approved_by')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('unit_allotments');
    }
}
