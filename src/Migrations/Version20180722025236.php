<?php declare(strict_types = 1);

namespace Tables4DMs\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Update sheet table
 */
class Version20180722025236 extends AbstractMigration
{
    protected $tableName = "sheet";

    public function up(Schema $schema): void
    {
        $table = $schema->getTable($this->tableName);
        $table->addColumn('situation', 'string')
            ->setLength('1')
            ->setDefault('A')
            ->setComment('Sheet situation: (D)eleted, (S)uspended, (A)ctive');

        $table->addIndex(['situation'], 'sheet_idx_situation');
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable($this->tableName);
        $table->dropColumn('situation');
    }
}
