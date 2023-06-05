<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_bangla');
            $table->string('parent_unit_id')->comment('lookups');
            $table->string('institution_code')->nullable();
            $table->string('office_id')->nullable();
            $table->string('ddo_id')->nullable();
            $table->string('unit_head_name');
            $table->string('unit_head_letter_name');
            $table->string('unit_head_email')->nullable();
            $table->string('unit_head_mobile')->nullable();
            $table->integer('unit_head_designation_id')->comment('lookups');
            $table->string('for_attention_name')->nullable();
            $table->string('for_attention_letter_name')->nullable();
            $table->string('for_attention_email')->nullable();
            $table->string('for_attention_mobile')->nullable();
            $table->integer('for_attention_designation_id')->nullable()->comment('lookups');
            $table->integer('priority')->default(0);
            $table->integer('status')->default(1)->comment('0=inactive, 1=active');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('units');
    }
}
