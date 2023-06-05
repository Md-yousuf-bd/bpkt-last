<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('mail_server');
            $table->string('from_mail');
            $table->string('to_mail');
            $table->text('subject');
            $table->text('content')->nullable();
            $table->text('attachment')->nullable();
            $table->text('cc')->nullable();
            $table->string('status');
            $table->string('related_model_type')->nullable();
            $table->integer('related_model_id')->nullable();
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
        Schema::dropIfExists('emails');
    }
}
