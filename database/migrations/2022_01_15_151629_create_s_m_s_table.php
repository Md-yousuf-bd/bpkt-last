<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('sms_bulk');
            $table->string('sender_id');
            $table->string('to_number');
            $table->text('content')->nullable();
            $table->double('sms_count')->nullable();
            $table->double('per_sms_charge')->nullable();
            $table->double('total_charge')->nullable();
            $table->string('related_model_type')->nullable();
            $table->integer('related_model_id')->nullable();
            $table->string('status');
            $table->text('status_code');
            $table->text('status_message');
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
        Schema::dropIfExists('s_m_s');
    }
}
