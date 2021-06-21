<?php
/**
 * Category fixture.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CategoryFixtures.
 * @package App\DataFixtures
 */
class CategoryFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'categories', function ($i) {
            $category = new Category();
            $category->setTitle($this->faker->word);
            $category->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $category->setUpdatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $category->setAuthor($this->getRandomReference('admins'));

            return $category;
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
        return [UserFixtures::class];
    }
}