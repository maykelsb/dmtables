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
 * Controller for sheets requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetControllerProvider extends AbstractControllerProvider
{
    /**
     * List sheets.
     *
     * @SWG\Get(
     *  path="/{_locate}/sheets",
     *  @SWG\Response(
     *      response=200,
     *      description="Sheet list."
     *  )
     * )
     */
    protected function sheetsAction()
    {
        $this->get('/', function(){
            return $this->response(
                $this->getService()->find()
            );
        })->bind('sheets.list');
    }

    /**
     * Show sheet data.
     *
     * @SWG\Get(
     *  path="/{_locale}/sheets/{id}",
     *  @SWG\Response(
     *      response=200,
     *      description="Sheet data."
     *  )
     * )
     */
    protected function showSheetAction()
    {
        $this->get('/{id}', function($id){
            return $this->response(
                $this->getService()->find(['id' => $id])
            );
        })->bind('sheet.show');
    }

    protected function newSheetAction()
    {
        $this->post('/', function(Request $request){
            $sheetid = $this->getService()->create(
                $request->request->all()
            );

            return $this->responseOk(
                'sheet_created',
                ['Location' => "/index.php/en/sheets/{$sheetid}"]
            );
        })->bind('sheets.new');
    }

    protected function updateSheetAction()
    {
        $this->put('/{id}', function($id, Request $request){
            if (empty($sheet = $this->loadEntity($id))) {
                return $this->responseNotFound('sheet_not_found');
            }

            $this->getService()->update($sheet, $request->query->all());
            return $this->responseOk('sheet_updated');
        })->bind('sheet.update');
    }

    protected function deleteSheetAction()
    {
        $this->delete('/{id}', function($id){
            if (empty($sheet = $this->loadEntity($id))) {
                return $this->responseNotFound('sheet_not_found');
            }

            $this->getService()->delete($sheet);
            return $this->responseOk('sheet_deleted');
        })->bind('sheet.delete');
    }
}

