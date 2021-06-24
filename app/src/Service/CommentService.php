<?php
/**
 * Comment service.
 */

namespace App\Service;

use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class CommentService
 * @package App\Service
 */
class CommentService
{
    /**
     * Comment repository
     *
     * @var \App\Repository\CommentRepository
     */
    private $commentRepository;

    /**
     * Paginator
     *
     * @param \Knp\Component\Pager\PaginatorInterface $paginator
     */
    private $paginator;

    /**
     * CommentService constructor.
     *
     * @param CommentRepository                        $commentRepository
     * @param \Knp\Component\Pager\PaginatorInterface  $paginator          Paginator
     */
    public function __construct(CommentRepository $commentRepository, PaginatorInterface )
    {
        $this->commentRepository = $commentRepository;
        $this->paginator = $paginator;
    }
}