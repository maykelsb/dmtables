<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    protected $tableName = 'auths';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid')
                ->comment('References users.id');
            $table->char('network', 1)
                ->comment('Specifies the service used for login: (F)acebook, (T)witter and (G)oogle');
            $table->string('token', 255)
                ->comment('ID token used for authentication');
            $table->timestamps();
        
            $table->foreign('userid')
                ->references('id')
                ->on('users');
        });

        DB:statement("ALTER TABLE '{$this->tableName}' comment 'Stores useris auth tokens'");
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

