<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4DMs\Repository;

use Doctrine\ORM\EntityManagerInterface;

use Tables4DMs\Entity\User;

/**
 * UserRepository
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
final class UserRepository extends AbstractRepository
{

    public function __construct(EntityManagerInterface $emi)
    {
        parent::__construct($emi, User::class);
    }
}
