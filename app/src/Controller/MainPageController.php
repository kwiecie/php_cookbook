<?php
/**
 * Main Page controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainPage.
 *
 * @Route("/")
 */
class MainPageController extends AbstractController
{
    /**
     * Index action.
     *
     */
    public function index(): Response
    {

        return $this->render(
            'main/index.html.twig'
        );
    }

}