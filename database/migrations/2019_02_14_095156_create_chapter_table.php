<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('syllabus_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('name',30);
            $table->string('type',15);
            $table->text('description');
            $table->enum('status',['1', '0','2'])->default('0');
            /*$table->foreign('syllabus_id')
            ->references('id')->on('syllabus')
            ->onDelete('cascade');*/
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter');
    }
}
