<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->text('description')->after('title');
            $table->integer('price')->after('description')->default(0);
            $table->dateTime('date_end')->after('price');
            $table->unsignedBigInteger('user_id')->after('date_end');

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(array('description', 'price', 'date_end', 'user_id'));
            $table->dropForeign('tasks_user_id_foreign');
        });
    }
}
