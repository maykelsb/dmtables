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
     *  path="/{_locale}/sheetitems",
     *  @SWG\Response(
     *      response=200,
     *      description="Sheet items list."
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

    /**
     * Create new sheet item.
     *
     * @SW\Post(
     *  path="/{_locale}/sheetitems",
     *  @SWG\Response(
     *      response=200,
     *      description="New sheet item."
     *  )
     * )
     */
     protected function newSheetitemAction()
     {

        $this->post('/', function(Request $request){
            $sheetitemid = $this->getService()->create(
                $request->request->all()
            );

            return $this->responseOk(
                'sheet_item_created',
                ['Location' => "/index.php/en/sheetitems/{$sheetitemid}"]
            );
        })->bind('sheetitems.new');
    }






}

