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
        Schema::create('customer_general_infos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->references('id')->on('customers')

                ->onUpdate('cascade')
                ->onDelete('cascade')->nullable();

            $table->string('TFN')->nullable();
            $table->string('ABN')->nullable();
            $table->string('BSB')->nullable();

            $table->bigInteger('account_no')->nullable();
            $table->string('spouse_name')->nullable();
            $table->date('spouse_date_of_birth')->nullable();
            $table->integer('no_of_dependants')->nullable();
            $table->bigInteger('spouse_income')->nullable();

            $table->boolean('have_log_book')->nullable();
            $table->string('model')->nullable();
            $table->string('rego')->nullable();
            $table->bigInteger('kms')->nullable();

            $table->boolean('work_related_travel_expense')->nullable();
            $table->bigInteger('work_related_travel_expense_amount')->nullable();


            $table->bigInteger('uniform')->nullable();
            $table->bigInteger('shoes')->nullable();
            $table->bigInteger('laundry')->nullable();


            $table->boolean('work_related_self_education_expense')->nullable();
            $table->boolean('work_related_self_education_expense_amount')->nullable();


            $table->integer('mobile_phone_business')->nullable();
            $table->bigInteger('mobile_phone_amount')->nullable();

            $table->integer('internet_business')->nullable();
            $table->bigInteger('internet_amount')->nullable();

            $table->integer('computer_expense_business')->nullable();
            $table->bigInteger('computer_expense_amount')->nullable();

            $table->integer('seminar_printing_books_business')->nullable();
            $table->bigInteger('seminar_printing_books_amount')->nullable();

            $table->integer('tools_business')->nullable();
            $table->bigInteger('tools_amount')->nullable();

            $table->integer('license_business')->nullable();
            $table->bigInteger('license_amount')->nullable();

            $table->integer('union_fees_business')->nullable();
            $table->bigInteger('union_fees_amount')->nullable();

            $table->integer('overtime_business')->nullable();
            $table->bigInteger('overtime_amount')->nullable();

            $table->string('others')->nullable();
            $table->integer('others_business')->nullable();
            $table->bigInteger('others_amount')->nullable();

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
        Schema::dropIfExists('customer_general_infos');
    }
};
