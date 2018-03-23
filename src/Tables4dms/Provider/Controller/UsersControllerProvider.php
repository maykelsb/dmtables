<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Provider\Controller;

use Tables4dms\Transformer\UserTransformer;

use Symfony\Component\HttpFoundation\Response;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

/**
 * Controller for users requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class UsersControllerProvider extends AbstractControllerProvider
{
    protected function usersAction()
    {
        $this->getCc()->get('/', function(){

            $data = $this->getEntityManager()
                ->getRepository('Tables4dms\\Entity\\Users')
                ->findAll();

            return $this->response(
                new Collection($data, new UserTransformer())
            );
        })->bind('users.list');
    }

    protected function openUserAction()
    {
        $this->getCc()->get('/{id}', function($id){
            $data = $this->getEntityManager()
                ->getRepository('Tables4dms\\Entity\\Users')
                ->find(['id' => $id]);

            return $this->response(
                new Item($data, new UserTransformer())
            );
        })->bind('users.open');
    }
}

