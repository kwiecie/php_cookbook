<?php

/**
 * Recipe repository.
 */

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * Class RecipeRepository.
 *
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    /**
     * Items per page.
     *
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See https://symfony.com/doc/current/best_practices.html#configuration
     *
     * @constant int
     */
    const PAGINATOR_ITEMS_PER_PAGE = 10;
/**
     * RecipeRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * Save record.
     *
     * @param \App\Entity\Recipe $recipe Recipe entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Recipe $recipe): void
    {
        $this->_em->persist($recipe);
        $this->_em->flush();
    }

    /**
     * Delete record.
     *
     * @param \App\Entity\Recipe $recipe Recipe entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Recipe $recipe): void
    {
        $this->_em->remove($recipe);
        $this->_em->flush();
    }

    /**
     * Query all records.
     *
     * @param array $filters Filters array
     *
     * @return \Doctrine\ORM\QueryBuilder Query Builder
     */
    public function queryAll(array $filters = []): QueryBuilder
    {
        $queryBuilder = $this->getOrCreateQueryBuilder()
            ->select('partial recipe.{id, createdAt, title}', 'partial category.{id, title}')
            ->join('recipe.category', 'category')
            ->orderBy('recipe.createdAt', 'DESC');
        $queryBuilder = $this->applyFiltersToList($queryBuilder, $filters);
        return $queryBuilder;
//return $this->getOrCreateQueryBuilder()->orderBy('recipe.createdAt', 'DESC');
    }

    /**
     * Apply filters to paginated list.
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder
     * @param array                      $filters      Filters array
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    private function applyFiltersToList(QueryBuilder $queryBuilder, array $filters = []): QueryBuilder
    {
        if (isset($filters['category']) && $filters['category'] instanceof Category) {
            $queryBuilder->andWhere('category = :category')
                ->setParameter('category', $filters['category']);
        }

        return $queryBuilder;
    }

    /**
     * Get or create new query builder.
     *
     * @param \Doctrine\ORM\QueryBuilder|null $queryBuilder Query builder
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?? $this->createQueryBuilder('recipe');
    }

    /**
     * Query recipes by author.
     *
     * @param \App\Entity\User $user User entity
     * @param array            $filters Filters array
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryByAuthor(User $user, array $filters = []): QueryBuilder
    {
        $queryBuilder = $this->queryAll($filters);
        $queryBuilder->andWhere('recipe.author = :author')
            ->setParameter('author', $user);
        return $queryBuilder;
    }

    /**
     * Query recipes only by filters.
     *
     * @param array $filters
     *
     * @return QueryBuilder
     */
    public function queryByFilter(array $filters = []): QueryBuilder
    {
        $queryBuilder = $this->queryAll($filters);
        return $queryBuilder;
    }
}
