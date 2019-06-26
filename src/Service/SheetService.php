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

    public function __construct(
        SheetRepository $sheetRepository,
        UserService $userService,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($validator, $entityManager);

        $this->userService = $userService;
        $this->repository = $sheetRepository;
    }

    public function save(array $data, Sheet $sheet = null)
    {
        if (isset($data['id']) && is_null($sheet)) {
            $sheet = $this->findOneById($data['id']);
        }

        if (is_null($sheet)) {
            $sheet = (new Sheet())
                ->setSituation(Sheet::SHEET_ACTIVE)
                ->setUser(
                    $this->userService->findOneById($data['user'])
                );
        }

        $sheet->setName($data['name'])
            ->setDescription($data['description'])
            ->setUrl($data['url'])
            ->setAuthor($data['author']);

        $this->validate($sheet);
        $this->em->persist($sheet);
        $this->em->flush();

        return $sheet;
    }

    public function inactivate(Sheet $sheet)
    {
        $sheet->setSituation(Sheet::SHEET_DELETED);
        $this->validate($sheet);
        $this->em->persist($sheet);
        $this->em->flush();

        return $sheet;
    }
}
