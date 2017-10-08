<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetitemTable extends Migration
{
    protected $tableName = 'sheetitems';

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
            $table->integer('sheetid')
                ->unsigned()
                ->comment('References sheets.id');
            $table->integer('identifier')
                ->comment('Represents a number which identifies that sheet item in a dice row');
            $table->string('description', 255)
                ->comment('Sheet item description');
            $table->integer('subsheetid')
                ->unsigned()
                ->nullable()
                ->comment('References a table which is used as subtable');
            $table->timestamps();

            $table->foreign('sheetid')
                ->references('id')
                ->on('sheets');

            $table->foreign('subsheetid')
                ->references('id')
                ->on('sheets');
        });

        DB::statement("ALTER TABLE `{$this->tableName}` comment 'Stores data sheet item or subtable'");
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
