<?php
/**
 * Comment fixture.
 */
namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CommentFixtures
 * @package App\DataFixtures
 */
class CommentFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'comments', function ($i) {
            $comment = new Comment();
            $comment->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $comment->setContent($this->faker->text(200));
            $comment->setAuthor($this->faker->firstName);
            $comment->setEmail($this->faker->email);
            $comment->setRecipe($this->getRandomReference('recipes'));

            return $comment;
        });

        $manager->flush();
    }
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array Array of dependencies
     */
    public function getDependencies(): array
    {
        return [RecipeFixtures::class];
    }
}
