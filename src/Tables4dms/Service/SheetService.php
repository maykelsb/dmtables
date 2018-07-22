<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Service;

use Tables4dms\Entity\AbstractEntity;
use Tables4dms\Entity\Sheet;
use Tables4dms\Entity\User;

/**
 * Find, retrieve, transform and return Sheet data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetService extends AbstractService
{
    /**
     * Create a new sheet.
     *
     * @param mixed $data Sheet data.
     * @return New sheet ID.
     */
    public function create (array $data)
    {
        $data['user'] = $this->getReference(
            User::class,
            $data['user']
        );

        return parent::create($data);
    }

    /**
     * Update sheet data.
     *
     * @param \Tables4dms\Entity\AbstractEntity
     * @param mixed Sheet data.
     */
    public function update(AbstractEntity $sheet, array $data)
    {
        $data['user'] = $this->getReference(
            User::class,
            $data['user']
        );

        parent::save($sheet, $data);
    }
}

