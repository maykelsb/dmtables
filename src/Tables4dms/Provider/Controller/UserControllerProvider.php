<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Provider\Controller;

use Swagger\Annotations as SWG;

/**
 * Controller for users requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class UserControllerProvider extends AbstractControllerProvider
{
    /**
     * List users.
     *
     * @SWG\Get(
     *  path="/{_locale}/users",
     *  @SWG\Response(
     *      response=200,
     *      description="User list."
     *  )
     * )
     */
    protected function usersAction()
    {
        $this->get('/', function(){
            return $this->response(
                $this->getService()->find()
            );
        })->bind('users.list');
    }

    /**
     * Show user data.
     *
     * @SWG\Get(
     *  path="/{_locale}/users/{id}",
     *  @SWG\Response(
     *      response=200,
     *      description="User data."
     *  )
     * )
     */
    protected function showUserAction()
    {
        $this->get('/{id}', function($id){
            return $this->response(
                $this->getService()->find(['id' => $id])
            );
        })->bind('user.show');
    }

    /**
     * List user sheets.
     *
     * @SWG\Get(
     *  path="/{_locale}/users/{id}/sheets",
     *  @SWG\Response(
     *      response=200,
     *      description="List user sheets."
     *  )
     * )
     */
    protected function userSheetsAction()
    {
        $this->get('/{userid}/sheets', function($userid){
            return $this->response(
                $this->getService('sheet')->find(['user' => $userid]),
                'Tables4dms\\Transformer\\SheetTransformer'
            );
        })->bind('user.sheets.list');
    }
}

