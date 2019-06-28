<?php declare(strict_types = 1);

namespace Tables4DMs\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320100518 extends AbstractMigration
{
    protected $tableName = 'sheetitem';

    public function up(Schema $schema): void
    {
        $table = $schema->createTable($this->tableName);
        $table->addColumn('id', 'integer')
            ->setAutoincrement(true);

        $table->addColumn('sheetid', 'integer')
            ->setComment('References sheet.id');

        $table->addColumn('dicenumber', 'integer')
            ->setComment('Represents a number which identifies that sheet item in a dice row');

        $table->addColumn('description', 'string')
            ->setLength(255)
            ->setComment('Sheet item description');

        $table->addColumn('subsheetid', 'integer')
            ->setNotnull(false)
            ->setComment('References a table which is used as subtable');

        $table->addColumn('created_at', 'datetime')
            ->setDefault($this->connection->getDatabasePlatform()->getCurrentTimestampSQL());

        $table->addColumn('updated_at', 'datetime')
            ->setColumnDefinition('timestamp default current_timestamp on update current_timestamp');

        $table->setPrimaryKey(['id'])
            ->addForeignKeyConstraint('sheet', ['sheetid'], ['id'], [], 'sheetitem_fk_sheet')
            ->addForeignKeyConstraint('sheet', ['subsheetid'], ['id'], [], 'sheetitem_fk_subsheet');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable($this->tableName);
    }
}
