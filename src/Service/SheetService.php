<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2019 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4DMs\Service;

use Tables4DMs\Entity\Sheet;
use Tables4DMs\Entity\User;

use Tables4DMs\Repository\SheetRepository;

use Symfony\Component\Validator\Validator\ValidatorInterface;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Sheet service
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetService extends AbstractService
{
    /**
     * @var UserService;
     */
    protected $userService;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(
        SheetRepository $sheetRepository,
        UserService $userService,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ) {
        $this->repository = $sheetRepository;
        $this->userService = $userService;
        $this->validator = $validator;
        $this->em = $entityManager;
    }

    public function create(array $data)
    {
        $sheet = new Sheet();
        $sheet->setName($data['name'])
            ->setSituation(Sheet::SHEET_ACTIVE)
            ->setDescription($data['description'])
            ->setUrl($data['url'])
            ->setAuthor($data['author'])
            ->setUser(
                $this->userService->findOneById($data['user'])
            );

        $errors = $this->validator->validate($sheet);

        if ($errors->count()) {
            throw new \Exception('Deu ruim na criação');
        }

        $this->em->persist($sheet);
        $this->em->flush();

        return $sheet;
    }
}
