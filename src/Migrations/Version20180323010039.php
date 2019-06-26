<?php declare(strict_types = 1);

namespace Tables4dms\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Create auths table
 */
class Version20180323010039 extends AbstractMigration
{
    protected $tableName = 'auth';

    public function up(Schema $schema)
    {
        $table = $schema->createTable($this->tableName);
        $table->addColumn('id', 'integer')
            ->setAutoincrement(true);

        $table->addColumn('userid', 'integer')
            ->setComment('References user.id');

        $table->addColumn('network', 'string')
            ->setLength('1')
            ->setComment('Specifies the service used for login: (F)acebook, (T)witter, (G)oogle and (R)eddit');

        $table->addColumn('token', 'string')
            ->setLength('255')
            ->setComment('ID token used for authentication');

        $table->addColumn('created_at', 'datetime')
            ->setDefault($this->connection->getDatabasePlatform()->getCurrentTimestampSQL());

        $table->addColumn('updated_at', 'datetime')
            ->setColumnDefinition('timestamp default current_timestamp on update current_timestamp');

        $table->setPrimaryKey(['id'])
            ->addForeignKeyConstraint('user', ['userid'], ['id'], [], 'auth_fk_user');
    }

    public function down(Schema $schema)
    {
        $schema->dropTable($this->tableName);
    }
}
