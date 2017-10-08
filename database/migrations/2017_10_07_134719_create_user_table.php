<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    protected $tableName = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('user', 45)
                ->comment('Name  used by the user to login and app display');
            $table->string('password', 32)
                ->comment('User login password used when it is a local auth, otherwise, empty')
                ->nullable();
            $table->string('fullname', 100)
                ->comment('User full name');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE '{$this->tableName}' comment 'Stores app users'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}

