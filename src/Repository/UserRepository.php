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
use Doctrine\ORM\EntityRepository;

use Tables4DMs\Entity\User;

/**
 * UserRepository
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
final class UserRepository
{
    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->repository = $emi->getRepository(User::class);
    }

    public function __call($name, $args)
    {
        if (is_callable([$this->repository, $name])) {
            return call_user_func_array([$this->repository, $name], $args);
        }

        throw new Exception('Deu ruim');
    }

}
