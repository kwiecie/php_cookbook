<?php
/**
 * Record controller.
 */

namespace App\Controller;

use App\Repository\MainPageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecordController.php.
 *
 * @Route("/main")
 */
class MainPageController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \App\Repository\MainPageRepository $repository Record repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="main_index",
     * )
     */
    public function index(MainPageRepository $repository): Response
    {
        return $this->render(
            'main/index.html.twig',
            ['data' => $repository->findAll()]
        );
    }

    /**
     * Show action.
     *
     * @param \App\Repository\MainPageRepository $repository Record repository
     * @param int                              $id         Record id
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="main_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     */
    public function show(MainPageRepository $repository, int $id): Response
    {
        return $this->render(
            'main/show.html.twig',
            ['item' => $repository->findById($id)]
        );
    }
}