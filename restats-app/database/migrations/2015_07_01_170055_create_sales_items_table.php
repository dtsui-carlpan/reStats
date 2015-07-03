<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // item names
            $table->string('quantity_unit'); //份，半打, etc
            $table->string('price_unit'); // RMB
            $table->decimal('price', 7, 2); // 10000.00
            $table->decimal('quantity', 6, 1); // 10000.0
            $table->decimal('revenue', 9, 2); // 1000000.00

            // foreign key
            // department
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments'); // on departments table
            // month
            $table->integer('month_id')->unsigned();
            $table->foreign('month_id')
                ->references('id')
                ->on('months'); // on months table
            // year
            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')
                ->references('id')
                ->on('years'); // on years table

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
        Schema::drop('sales_items');
    }
}
