<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2019 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4DMs\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Swagger\Annotations as SWG;

use Tables4DMs\Entity\Sheet;
use Tables4DMs\Service\SheetService;

/**
 * Controller for sheets requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @Route("/api", name="api_")
 */
class SheetController extends FOSRestController
{
    /**
     * List sheets.
     *
     * @Rest\Get("/sheets")
     * @SWG\Get(
     *  path="/{_locate}/sheets",
     *  @SWG\Response(
     *      response=200,
     *      description="Sheet list."
     *  )
     * )
     */
    public function getSheetsAction(SheetService $ss)
    {
        $sheets = $ss->findBy(["situation" => Sheet::SHEET_ACTIVE]);
        return $this->handleView($this->view($sheets));
    }

    /**
     * Show sheet data.
     *
     * @Rest\Get("/sheet/{id}")
     * @SWG\Get(
     *  path="/{_locale}/sheets/{id}",
     *  @SWG\Response(
     *      response=200,
     *      description="Sheet data."
     *  )
     * )
     */
    public function getSheetAction(Sheet $sheet)
    {
        return $this->handleView($this->view($sheet));
    }

    /**
     * Create a new (empty) sheet.
     *
     * @Rest\Post("/sheet")
     */
    public function postSheetAction(Request $request, SheetService $sheetService)
    {
        $sheet = $sheetService->save($request->request->all());
        return $this->handleView($this->view($sheet));
    }

    /**
     * Update sheet data.
     *
     * @Rest\Patch("/sheet/{id}")
     */
    public function patchSheetAction(Sheet $sheet, Request $request, SheetService $sheetService)
    {
        $sheetData = $request->query->all();
        unset($sheetData['user']);
        unset($sheetData['situation']);

        $sheet = $sheetService->save($sheetData, $sheet);
        return $this->handleView($this->view($sheet));
    }

    /**
     * Delete an existing sheet.
     *
     * @Rest\Delete("/sheet/{id}")
     * @SWG\Delete(
     *  path="/sheet/{id}",
     *  @SWG\Response(
     *      response=200,
     *      description="Sheet logically deleted."
     *  ),
     *  @SWG\Response(
     *      response=404,
     *      description="Sheet not found."
     *  )
     * )
     */
    public function deleteSheetAction(Sheet $sheet, SheetService $sheetService)
    {
        $sheet = $sheetService->inactivate($sheet);
        return $this->handleView($this->view(null));
    }
}
