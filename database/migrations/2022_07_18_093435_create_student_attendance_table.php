<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendance', function (Blueprint $table) {
            $table->id();
            $table->string('organisation_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('class_id')->nullable();
            $table->string('section_id')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('current_date')->nullable();
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
        Schema::dropIfExists('student_attendance');
    }
}
