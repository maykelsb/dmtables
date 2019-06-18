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
use Tables4DMs\Respository\AbstractEntity;

use Tables4DMs\Entity\EntityInterface;

use Symfony\Component\Validator\Validator\ValidatorInterface;

use Doctrine\ORM\EntityManagerInterface;

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

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ) {
        $this->validator = $validator;
        $this->em = $entityManager;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOneById($id)
    {
        return $this->repository->findOneById($id);
    }

    protected function validate(EntityInterface $ae)
    {
        $errors = $this->validator->validate($ae);

        if ($errors->count()) {
            throw new \Exception('Deu ruim no update/criacao');
        }
    }
}
