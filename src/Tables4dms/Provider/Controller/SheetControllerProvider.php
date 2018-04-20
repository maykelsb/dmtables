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

use Tables4dms\DTO\MessageDTO;

/**
 * Controller for sheets requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class SheetControllerProvider extends AbstractControllerProvider
{
    protected function sheetsAction()
    {
        $this->get('/', function(){
            return $this->response(
                $this->getService()->find()
            );
        })->bind('sheets.list');
    }

    protected function newSheetAction()
    {
        $this->post('/', function(Request $request){
            $sheetid = $this->getService()->create(
                $request->request->all()
            );

            $messageDTO = new MessageDTO();
            $messageDTO->message = 'sheet_created';
            $messageDTO->type = MessageDTO::TYPE_SUCCESS;

            return $this->response(
                $messageDTO,
                'Tables4dms\\Transformer\\MessageTransformer',
                201,
                ['Location' => "/index.php/en/sheets/{$sheetid}"]
            );
        })->bind('sheets.new');
    }
}

