<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Service;

/**
 * Find, retrieve, transform and return User data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class UserService extends ServiceAbstract
{

    /**
     * Return a list of users considering a filter.
     *
     * @param mixed[] $filter Fields to use in a where clausule.
     * @return array|\Tables4dms\Entity\User
     */
    public function getUsers($filter = [])
    {
        $repository = $this->getRepository();

        if (empty($filter)) {
            return $repository->findAll();
        }

        return $repository->find($filter)??[];
    }
}

