<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnswerController extends Controller
{
    /**
     * @Route("/api/answers")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        return new JsonResponse([]);
    }
}
