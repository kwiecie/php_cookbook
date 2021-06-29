<?php

namespace App\Repository;

use App\Entity\RecipeIngredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeIngredients|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeIngredients|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeIngredients[]    findAll()
 * @method RecipeIngredients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeIngredientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeIngredients::class);
    }

}
