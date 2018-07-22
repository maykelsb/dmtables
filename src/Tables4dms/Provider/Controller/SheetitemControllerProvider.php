<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Provider\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Tables4dms\DTO\MessageDTO;

/**
 * Controller for sheets items requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetitemControllerProvider extends AbstractControllerProvider
{
    /**
     * List sheet items.
     *
     * @SWG\Get(
     *  path="/{_locate}/sheetitems",
     *  @SWG\Response(
     *      response=200,
     *      description="Sheet item list."
     *  )
     * )
     */
    protected function sheetitemsAction()
    {
        $this->get('/', function(){
            return $this->response(
                $this->getService()->find()
            );
        })->bind('sheetitems.list');
    }
}

