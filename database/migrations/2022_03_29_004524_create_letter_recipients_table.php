<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetterRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_recipients', function (Blueprint $table) {
            $table->string('letter_model');
            $table->integer('letter_id');
            $table->string('field_type');
            $table->integer('unit_id');
            $table->string('recipient_type');
            $table->boolean('is_all')->nullable()->default(false);
            $table->string('recipient_group_no')->nullable();
            $table->string('message_group_no')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('letter_recipients');
    }
}
