<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Transformer;

use Tables4dms\Entity\Sheetitem;
use League\Fractal;

/**
 * Transformer to expose sheetitem data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetitemTransformer extends Fractal\TransformerAbstract
{
    public function transform(Sheetitem $sheetitem)
    {
        return [
            'id' => $sheetitem->getId(),
            'description' => $sheetitem->getDescription(),
            'links' => [
                [
                    'rel' => 'self',
                    'link' => "/sheetitems/{$sheetitem->getId()}"
                ],
                [
                    'rel' => 'sheet',
                    'link' => "/sheets/{$sheetitem->getSheet()->getId()}"
                ],
                [
                    'rel' => 'subsheet',
                    'link' => ($subsheet = $sheetitem->getSubsheet())
                                ?"/sheets/{$subsheet->getId()}"
                                :"null"
                ]
            ]
        ];
    }
}

