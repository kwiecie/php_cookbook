<?php
/**
 * Comment fixture.
 */
namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CommentFixtures
 * @package App\DataFixtures
 */
class CommentFixtures extends AbstractBaseFixtures
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

            return $comment;
        });

        $manager->flush();
    }
}
