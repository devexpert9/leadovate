<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',30);
            $table->string('last_name',30);
            $table->string('username',30);
            $table->string('email',255);
            $table->string('phone',15);
            $table->string('password',100);
            $table->string('image',255);
            $table->string('package_id',15);
            $table->string('country',15);
            $table->string('state',10);
            $table->string('city',30);
            $table->string('zip_code',15);
            $table->text('address');
            $table->integer('school_year')->unsigned();
            $table->enum('status',['1', '0'])->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
