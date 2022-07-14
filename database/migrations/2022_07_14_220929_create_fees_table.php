<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('student_id');
            $table->string('father_name');
            $table->string('payment_method');
            $table->string('receipt_number')->nullable();
            $table->date('fees_submition_date');
            $table->string('fee_deposit_interval');
            $table->string('addmission_fee')->nullable();
            $table->string('tution_fee')->nullable();
            $table->string('sports_fee')->nullable();
            $table->string('hostel_fee')->nullable();
            $table->string('food_fee')->nullable();
            $table->string('transpotation_fee')->nullable();
            $table->string('activity_fees')->nullable();
            $table->string('extra_class_fees')->nullable();
            $table->string('others')->nullable();
            $table->string('penality')->nullable();
            $table->string('pending_due')->nullable();
            $table->string('total_fee');
            $table->string('fee_month')->nullable();
            $table->string('note')->nullable();

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
        Schema::dropIfExists('fees');
    }
}
