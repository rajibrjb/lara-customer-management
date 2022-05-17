<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('title');
            $table->string('TFN');
            $table->string('ABN');
            $table->string('BSB');

            $table->bigInteger('account_no');
            $table->string('spouse_name');
            $table->date('spouse_date_of_birth');
            $table->integer('no_of_dependants');
            $table->bigInteger('spouse_income');

            $table->string('state');
            $table->string('phone');
            $table->string('email');

            $table->boolean('have_log_book');
            $table->string('model');
            $table->string('rego');
            $table->bigInteger('kms');

            $table->boolean('work_related_travel_expense');
            $table->bigInteger('work_related_travel_expense_amount');


            $table->bigInteger('uniform');
            $table->bigInteger('shoes');
            $table->bigInteger('laundry');


            $table->boolean('work_related_self_education_expense');
            $table->boolean('work_related_self_education_expense_amount');


            $table->integer('mobile_phone_business');
            $table->bigInteger('mobile_phone_amount');

            $table->integer('internet_business');
            $table->bigInteger('internet_amount');

            $table->integer('computer_expense_business');
            $table->bigInteger('computer_expense_amount');

            $table->integer('seminar_printing_books_business');
            $table->bigInteger('seminar_printing_books_amount');

            $table->integer('tools_business');
            $table->bigInteger('tools_amount');

            $table->integer('license_business');
            $table->bigInteger('license_amount');

            $table->integer('union_fees_business');
            $table->bigInteger('union_fees_amount');

            $table->integer('overtime_business');
            $table->bigInteger('overtime_amount');
            
            $table->string('others');
            $table->integer('others_business');
            $table->bigInteger('others_amount');





            







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
        Schema::dropIfExists('customers');
    }
};
