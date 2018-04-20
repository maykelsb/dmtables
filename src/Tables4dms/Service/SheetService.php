<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Service;

use Tables4dms\Entity\Sheet;
use Tables4dms\Entity\User;


/**
 * Find, retrieve, transform and return Sheet data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetService extends AbstractService
{
    public function create(array $data)
    {
        $sheet = new Sheet();
        $sheet->setName($data['name']);
        $sheet->setDescription($data['description']);
        $sheet->setUser(
            $this->getReference(
                User::class,
                $data['user']
            )
        );

        $this->validate($sheet);
        $this->persist($sheet);
        $this->flush();
    }
}

