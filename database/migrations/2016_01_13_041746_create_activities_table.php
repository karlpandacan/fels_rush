<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('lesson_id')->unsigned()->index();
            $table->mediumText('content');
            $table->enum('activity_type', [
                'exam_taken',
                'followed_user',
                'unfollowed_user',
                'set_created',
                'set_updated',
                'set_deleted',
                'set_followed',
                'set_unfollowed'
            ]);
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
        Schema::drop('activities');
    }
}
