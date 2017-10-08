<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetTable extends Migration
{
    protected $tableName = 'sheets';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('userid')
                ->unsigned()
                ->comment('References users.id');
            $table->string('name', 50)
                ->comment('Sheet name');
            $table->text('description')
                ->nullable()
                ->comment('Sheet description');
            $table->timestamps();

            $table->foreign('userid')
                ->references('id')
                ->on('users');
        });

        DB::statement("ALTER TABLE `{$this->tableName}` comment 'Stores data sheets'");
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

