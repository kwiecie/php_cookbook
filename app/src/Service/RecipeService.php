<?php

/**
 * Recipe service
 */

namespace App\Service;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class RecipeService
 * @package App\Service
 */
class RecipeService
{

    /**
     * Recipe repository
     *
     * @var RecipeRepository
     */
    private $recipeRepository;
/**
     * Paginator
     *
     * @var PaginatorInterface
     */
    private $paginator;
/**
     * Category service.
     *
     * @var CategoryService
     */
    private $categoryService;
/**
     * Comment service.
     *
     * @var CommentService
     */
    private $commentService;
/**
     * RecipeService constructor
     *
     * @param RecipeRepository $recipeRepository Recipe repository
     * @param PaginatorInterface $paginator Paginator
     * @param $categoryService
     */
    public function __construct(
        RecipeRepository $recipeRepository,
        PaginatorInterface $paginator,
        CategoryService $categoryService
    ) {
        $this->recipeRepository = $recipeRepository;
        $this->paginator = $paginator;
        $this->categoryService = $categoryService;
    }
    /**
     * Prepare filters for the recipes list.
     *
     * @param array $filters Raw filters from request
     *
     * @return array Result array of filters
     */
    private function prepareFilters(array $filters): array
    {
        $resultFilters = [];
        if (isset($filters['category_id']) && is_numeric($filters['category_id'])) {
            $category = $this->categoryService->findOneById($filters['category_id']);
            if (null !== $category) {
                $resultFilters['category'] = $category;
            }
        }

        return $resultFilters;
    }

    /**
     * Create paginated list.
     *
     * @param int $page Page number
     *
     * @param array $filters Filters array
     *
     * @return PaginationInterface Paginated list
     */

    public function createPaginatedList(int $page, array $filters = []): PaginationInterface
    {
        $filters = $this->prepareFilters($filters);
        return $this->paginator->paginate($this->recipeRepository->
        queryByFilter($filters), $page, RecipeRepository::PAGINATOR_ITEMS_PER_PAGE);
    }

    /**
     * Save recipe.
     *
     * @param Recipe $recipe Recipe entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Recipe $recipe): void
    {
        $this->recipeRepository->save($recipe);
    }

    /**
     * Delete recipe.
     *
     * @param Recipe $recipe Recipe entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Recipe $recipe): void
    {
        $this->recipeRepository->delete($recipe);
    }

    /**
     * Find recipe by Id.
     *
     * @param int $id Recipe Id
     *
     * @return Recipe|null Recipe entity
     */
    public function findOneById(int $id): ?Recipe
    {
        return $this->recipeRepository->findOneById($id);
    }
}
