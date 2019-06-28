<?php declare(strict_types = 1);

namespace Tables4DMs\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Create user table.
 */
class Version20180311033522 extends AbstractMigration
{
    protected $tableName = 'user';

    public function up(Schema $schema): void
    {
        $table = $schema->createTable($this->tableName);
        $table->addColumn('id', 'integer')
            ->setAutoincrement(true);

        $table->addColumn('user', 'string')
            ->setLength(45)
            ->setComment('Name used by the user to login and app display');

        $table->addColumn('password', 'string')
            ->setLength(32)
            ->setComment('User login password used when it is a local auth, otherwise, empty')
            ->setNotnull(false);

        $table->addColumn('fullname', 'string')
            ->setLength(100)
            ->setComment('User full name');

         $table->addColumn('created_at', 'datetime')
            ->setDefault($this->connection->getDatabasePlatform()->getCurrentTimestampSQL());

        $table->addColumn('updated_at', 'datetime')
            ->setColumnDefinition('timestamp default current_timestamp on update current_timestamp');

        $table->setPrimaryKey(['id'])
            ->addUniqueIndex(['user']);
    }

    public function postUp(Schema $schema): void
    {
        $dml = <<<DML
INSERT INTO {$this->tableName}(user, password, fullname)
  VALUES('dungeonmaster', md5('dm'), 'Dungeon Master');
DML;
        $this->connection->exec($dml);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable($this->tableName);
    }
}
