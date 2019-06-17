<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2019 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4DMs\Service;

use Tables4DMs\Entity\User;

use Tables4DMs\Repository\UserRepository;

/**
 * User service
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }



    public function getById($id)
    {
        return $this->userRepository->findById($id);
    }
}
