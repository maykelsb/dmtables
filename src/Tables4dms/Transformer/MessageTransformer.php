<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Transformer;

use League\Fractal;

use Tables4dms\DTO\MessageDTO;

/**
 * Transformer to expose messages.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class MessageTransformer extends Fractal\TransformerAbstract
{
    public function transform(MessageDTO $messageDTO)
    {
        return [
            'message' => $messageDTO->message,
            'type' => $messageDTO->type
        ];
    }
}

