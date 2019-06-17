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

use Tables4DMs\Entity\User;
use Tables4DMs\Service\UserService;
#use Tables4DMs\Form\SheetType;

/**
 * Controller for users requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @Route("/api", name="api_")
 */
class UserController extends FOSRestController
{
    /**
     * List users.
     *
     * @Rest\Get("/users")
     * @SWG\Get(
     *  path="/{_locate}/users",
     *  @SWG\Response(
     *      response=200,
     *      description="User list."
     *  )
     * )
     */
    public function getUsersAction(UserService $us)
    {
        $users = $us->findAll();
        return $this->handleView($this->view($users));
    }

    /**
     * Show user data.
     *
     * @Rest\Get("/user/{id}")
     * @SWG\Get(
     *  path="/{_locale}/user/{id}",
     *  @SWG\Response(
     *      response=200,
     *      description="User data."
     *  )
     * )
     */
    public function getUserAction(User $user)
    {
        return $this->handleView($this->view($user));
    }
}
