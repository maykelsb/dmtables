<?php declare(strict_types = 1);

namespace Tables4dms\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Update sheet item table
 */
class Version20180722205210 extends AbstractMigration
{
    protected $tableName = "sheetitem";

    public function up(Schema $schema)
    {
        $table = $schema->getTable($this->tableName);
        $table->addUniqueIndex(['sheetid', 'dicenumber'], 'sheetitem_uidx_dicenumber');
        $table->addUniqueIndex(['sheetid', 'description'], 'sheetitem_uidx_description');
    }

    public function down(Schema $schema)
    {
        $table = $schema->getTable($this->tableName);
        $table->dropIndex('sheetitem_uidx_dicenumber');
        $table->dropIndex('sheetitem_uidx_description');
    }
}

