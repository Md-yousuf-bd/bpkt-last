<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSurrenderLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_surrender_letters', function (Blueprint $table) {
            $table->id();
            $table->text('header_left_logo')->nullable();
            $table->text('header_middle_heading')->nullable();
            $table->text('header_right_logo')->nullable();
            $table->string('sub_header_memo_first_part')->nullable();
            $table->text('subject')->nullable();
            $table->text('reference')->nullable();
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->text('signature_image')->nullable();
            $table->text('signature_info')->nullable();
            $table->string('sub_header_memo_first_part_2')->nullable();
            $table->text('signature_image_2')->nullable();
            $table->text('signature_info_2')->nullable();
            $table->text('letter_to')->nullable();
            $table->string('letter_to_email')->nullable();
            $table->string('letter_to_phone')->nullable();
            $table->text('letter_acknowledgement')->nullable();
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
        Schema::dropIfExists('master_surrender_letters');
    }
}
