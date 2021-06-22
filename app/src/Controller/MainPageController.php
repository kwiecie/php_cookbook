<?php
/**
 * Main Page controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainPage Controller.
 */
class MainPageController extends AbstractController
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="main_page_index",
     * )
     */
    public function index(): Response
    {
        return $this->render(
            'main/index.html.twig'
        );
    }
}