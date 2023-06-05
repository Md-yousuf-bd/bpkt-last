<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurrenderLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surrender_letters', function (Blueprint $table) {
            $table->id();
            $table->text('header_left_logo')->nullable();
            $table->text('header_middle_heading')->nullable();
            $table->text('header_right_logo')->nullable();
            $table->string('sub_header_memo_first_part')->nullable();
            $table->string('sub_header_memo_second_part')->nullable();
            $table->date('sub_header_memo_date')->nullable();
            $table->text('subject')->nullable();
            $table->text('reference')->nullable();
            $table->text('description')->nullable();
            $table->text('surrender_table')->nullable();
            $table->text('instructions')->nullable();
            $table->integer('is_signed')->default(0);
            $table->text('signature_image')->nullable();
            $table->date('signature_date')->nullable();
            $table->text('signature_info')->nullable();
            $table->text('signature_info_left')->nullable();
            $table->text('letter_to')->nullable();
            $table->string('sub_header_memo_first_part_2')->nullable();
            $table->string('sub_header_memo_second_part_2')->nullable();
            $table->date('sub_header_memo_date_2')->nullable();
            $table->text('letter_acknowledgement')->nullable();
            $table->integer('is_signed_2')->default(0);
            $table->text('signature_image_2')->nullable();
            $table->date('signature_date_2')->nullable();
            $table->text('signature_info_2')->nullable();
            $table->integer('total_surrenders')->default(0)->nullable();
            $table->text('code_ids')->nullable();
            $table->text('fiscal_years')->nullable();
            $table->double('total_amount')->default(0.0)->nullable();
            $table->integer('mail_count')->default(0)->nullable();
            $table->integer('sms_count')->default(0)->nullable();
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
        Schema::dropIfExists('surrender_letters');
    }
}
