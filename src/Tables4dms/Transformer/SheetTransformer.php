<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Transformer;

use Tables4dms\Entity\Sheet;
use League\Fractal;

/**
 * Transformer to expose sheet data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetTransformer extends Fractal\TransformerAbstract
{
    public function transform(Sheet $sheet)
    {
        return [
            'id' => $sheet->getId(),
            'name' => $sheet->getName(),
            'description' => $sheet->getDescription(),
            'url' => $sheet->getUrl(),
            'author' => $sheet->getAuthor(),
            'links' => [
                'rel' => 'self',
                'link' => "/sheets/{$sheet->getId()}"
            ]
        ];
    }
}

