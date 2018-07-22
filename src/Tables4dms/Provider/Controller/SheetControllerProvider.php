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

            return $this->response(
                $this->message('sheet_created', MessageDTO::TYPE_SUCCESS),
                'Tables4dms\\Transformer\\MessageDTOTransformer',
                Response::HTTP_OK,
                ['Location' => "/index.php/en/sheets/{$sheetid}"]
            );
        })->bind('sheets.new');
    }

    protected function updateSheetAction()
    {
        $this->put('/{id}', function($id, Request $request){
            if (!($sheet = $this->getService()->find(['id' => $id]))) {
                return $this->response(
                    $this->message('sheet_not_found', MessageDTO::TYPE_WARNING),
                    'Tables4dms\\Transformer\\MessageDTOTransformer',
                    Response::HTTP_NOT_FOUND
                );
            }

            $this->getService()->update($sheet, $request->query->all());
            return $this->response(
                $this->message('sheet_updated', MessageDTO::TYPE_SUCCESS),
                'Tables4dms\\Transformer\\MessageDTOTransformer',
                Response::HTTP_OK
            );
        })->bind('sheets.update');
    }
}

