<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Provider\Controller;

use Symfony\Component\HttpFoundation\Response;


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
            return 'users';
        })->bind('users.list');
    }

    protected function openTableAction()
    {
        $this->getCc()->get('/{id}', function(){

            $data = $this->app['orm.ems']['default']
                ->getRepository('Tables4dms\\Entity\\Users')
                ->find(['id' => 1]);

            return new Response($data);
        })->bind('users.open');
    }
}

