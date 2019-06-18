<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2019 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4DMs\Service;

use Tables4DMs\Respository\RepositoryInterface;

/**
 * Abstract service
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class AbstractService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOneById($id)
    {
        return $this->repository->findOneById($id);
    }
}
