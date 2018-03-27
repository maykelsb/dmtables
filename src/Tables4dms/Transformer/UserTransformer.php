<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Transformer;

use Tables4dms\Entity\User;
use League\Fractal;

/**
 * Transformer to expose user data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->getId(),
            'user' => $user->getUser(),
            'fullname' => $user->getFullname(),
            'links' => [
                'rel' => 'self',
                'link' => "/users/{$user->getId()}"
            ]
        ];
    }
}

