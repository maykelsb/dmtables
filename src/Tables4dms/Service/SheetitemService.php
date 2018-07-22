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

/**
 * Find, retrieve, transform and return Sheet item data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetitemService extends AbstractService
{
    /**
     * Create a new sheet item.
     *
     * @param mixed $data Sheet item data.
     * @return New sheet item ID.
     */
    public function create (array $data)
    {
        $data['sheet'] = $this->getReference(
            Sheet::class,
            $data['sheet']
        );

        return parent::create($data);
    }

    /**
     * Update sheet data.
     *
     * @param \Tables4dms\Entity\AbstractEntity
     * @param mixed Sheet data.
     */
//    public function update(AbstractEntity $sheet, array $data)
//    {
//        if (key_exists('user', $data)) {
//            $data['user'] = $this->getReference(
//                User::class,
//                $data['user']
//            );
//        }

//        parent::save($sheet, $data);
//    }

//    public function delete(AbstractEntity $sheet)
//    {
//        $this->update($sheet, ['situation' => 'D']);
//    }
}

