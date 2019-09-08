<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->tinyInteger('courtesy');
            $table->tinyInteger('punctuality');
            $table->tinyInteger('adequacy');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('proposal_id')
                    ->references('id')->on('proposals')
                    ->onDelete('cascade');
            $table->foreign('task_id')
                    ->references('id')->on('tasks')
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
        Schema::dropIfExists('reviews');
    }
}
