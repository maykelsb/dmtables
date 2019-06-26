<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4DMs\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

use Tables4DMs\Entity\Sheet;

/**
 * SheetRepository
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
final class SheetRepository extends AbstractRepository implements RepositoryInterface
{

    public function __construct(EntityManagerInterface $emi)
    {
        parent::__construct($emi, Sheet::class);
    }

}
