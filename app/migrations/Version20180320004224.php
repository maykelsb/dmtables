<?php declare(strict_types = 1);

namespace Tables4dms\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Create sheets table
 */
class Version20180320004224 extends AbstractMigration
{
    protected $tableName = 'sheet';

    public function up(Schema $schema)
    {
        $table = $schema->createTable($this->tableName);
        $table->addColumn('id', 'integer')
            ->setAutoincrement(true);

        $table->addColumn('userid', 'integer')
            ->setComment('References user.id');

        $table->addColumn('name', 'string')
            ->setLength('50')
            ->setComment('Sheet name');

        $table->addColumn('description', 'text')
            ->setNotnull(false)
            ->setComment('Sheet description');

        $table->addColumn('url', 'string')
            ->setNotnull(false)
            ->setLength('255')
            ->setComment('Source url');

        $table->addColumn('author', 'string')
            ->setNotnull(false)
            ->setLength('255')
            ->setComment('Sheet creator');

        $table->addColumn('created_at', 'datetime')
            ->setDefault($this->connection->getDatabasePlatform()->getCurrentTimestampSQL());
           
        $table->addColumn('updated_at', 'datetime')
            ->setColumnDefinition('timestamp default current_timestamp on update current_timestamp');

        $table->setPrimaryKey(['id'])
            ->addForeignKeyConstraint('user', ['userid'], ['id'], [], 'sheet_fk_user');
    }

    public function down(Schema $schema)
    {
        $schema->dropTable($this->tableName);
    }
}

