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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Swagger\Annotations as SWG;

use Tables4DMs\Entity\Sheetitem;
#use Tables4DMs\Form\SheetType;

/**
 * Controller for sheets requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @Route("/api", name="api_")
 */
class SheetitemController extends AbstractController
{
}
