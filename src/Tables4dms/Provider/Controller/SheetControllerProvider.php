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
            $data = $this->getDefaultRepository()
                ->findAll();
            return $this->response($data);
        })->bind('sheets.list');
    }

    protected function newSheetAction()
    {
        $this->post('/', function(Request $request){
            $sheet = new \Tables4dms\Entity\Sheet();
            $sheet->setName($request->request->get('name'));
            $sheet->setDescription($request->request->get('description'));

            // -- todo: change to get reference
            $sheet->setUser(
                $this->getRepository('Tables4dms\\Entity\\User')
                    ->find(['id' => $request->request->get('user')])
            );

            $this->validate($sheet);
            $this->getEntityManager()
                ->persist($sheet);

            $this->getEntityManager()
                ->flush();


        })->bind('sheets.new');
    }
}

