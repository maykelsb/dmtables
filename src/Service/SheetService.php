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

/**
 * Sheet service
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetService extends AbstractService
{
    public function __construct(SheetRepository $sheetRepository)
    {
        $this->repository = $sheetRepository;
    }

    public function create(array $data)
    {
        $entity = new Sheet();
        $entity->setName($data['name'])
            ->setSituation(Sheet::SHEET_ACTIVE)
            ->setDescription($data['description'])
            ->setUrl($data['url'])
            ->setAuthor($data['author'])
            ->setUser(
                (new UserService())->getById($data['user'])
            );
        die(var_dump($entity));
    }
}
