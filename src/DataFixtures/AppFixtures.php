<?php

namespace App\DataFixtures;


use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;



class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();
        $tableauImage = ["img_ss2.jpg", "img_ss3.jpg", "img_ss4.jpg", "img_ss5.jpg", "img_ss6.jpg", "img_ss7.jpg", "img_ss8.jpg", "img_ss.jpg", "img_ss.jpg"];

        //-------- création des utilisateurs -------


        $users = [];
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setPrenom($faker->firstName());
            $user->setNom($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password());
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
            $users[] = $user;
        }

        //-------- création des catégories -------

        $categories = [];
        for ($i = 0; $i < 15; $i++) {
            $category = new Category();
            $category->setDesignation(join(' ', $faker->words(2)));
            $category->setDescription(join(' ', $faker->words(2)));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;
        }

        //-------- création des articles -------

        for ($i = 0; $i < 25; $i++) {
            $article = new Article();
            $article->setDesignation('Paire "' . (join(' ', $faker->words(2))) . '"');
            $article->setContent(join(' ', $faker->words(50)));
            $article->setImage($faker->randomElement($tableauImage));
            $article->setCreatedAt(new \DateTime());
            $article->addCategory($categories[rand(0, 14)]);
            $article->setAuthor($users[rand(0, 49)]);
            $manager->persist($article);
        }
        $manager->flush();
    }
}
