<?php

namespace App\DataFixtures;


use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;


class AppFixtures extends Fixture
{
    public function __construct(PasswordHasherFactoryInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create();

        $tableauImage = ["sneaker1.jpg", "sneaker2.jpg", "sneaker3.jpg", "sneaker4.jpg", "sneaker5.jpg", "sneaker6.jpg", "sneaker7.jpg", "sneaker8.jpg", "sneaker9.jpg", "sneaker10.jpg"];

        //-------- création des utilisateurs -------
        $admin = new User();
        $admin->setPrenom("Marvin");
        $admin->setNom("CHERRIER");
        $admin->setEmail("cm@g.com");
        $admin->setPassword($this->hasher->hashPassword($admin, "azerty"));
        $admin->setRoles(["ROLE_ADMIN"]);

        $manager->persist($admin);

        $users = [];
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setPrenom($faker->firstName());
            $user->setNom($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($this->hasher->hashPassword($user, "azerty"));
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
            $users[] = $user;
        }
        //-------- création des catégories -------

        $categories = [];
        for ($i = 0; $i < 50; $i++) {
            $category = new User();
            $category->setUsername($faker->name);
            $category->setPrenom($faker->firstName());
            $category->setNom($faker->lastName());
            $category->setEmail($faker->email);
            $user->setPassword($this->hasher->hashPassword($user, "azerty"));
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
            $users[] = $user;
        }

        //-------- création des articles -------
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setDesignation('Paire "' . $faker->sentence(2) . '"');
            $article->setDescription($faker->text(100));
            $article->setPrix($faker->randomFloat(2, 100, 1000));
            $article->setNomImage($faker->randomElement($tableauImage));
            $article->setCategorie($faker->randomElement($listeCategories));

            $manager->persist($article);


            $manager->flush(); //Toujours en bas
        }
    }
}
