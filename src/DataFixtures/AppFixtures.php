<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Category;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create($fakerLocale = 'fr_FR');


/**
         * Les users
         * Traitement pour l'ajout des utilisateurs
         */

         $objectUser = [];

         for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($faker->password())
                ->setRoles(['ROLE_USER'])
              ;
            // On ajout l'objet utilisateur dans le tableau
            array_push($objectUser, $user);
            // On persiste l'objet utilisteurs
            $manager->persist($user);
        }



/**
         * Les users
         * Traitement pour l'ajout des utilisateurs
         */



        $categories = [
            'Travail',
            'Logement',
            'Bricolage',
            'Administratif',
            'Formation',
        ];

        $objectCategory = [];

        for ($i = 0; $i < count($categories); $i++) {
            $category = new Category();
            $category->setName($categories[$i])
                ->setUser($objectUser[rand(0, 99)]);
            // On ajoute l'objet catégorie dans le tableau
            array_push($objectCategory, $category);
            // On persiste l'objet catégorie
            $manager->persist($category);
        }

        
        /**
         * Les notes
         * Traitement pour l'ajout des notes
         */




         $objectNotes = [];

         for ($i = 0; $i < 100; $i++) {
            $note = new Note();
            $note->setTitle($faker->sentence(2))
                ->setContent($faker->sentence(10))
                ->setCategory($objectCategory[rand(0, 4)])
                ->setUser($objectUser[rand(0, 99)])
              ;
            // On ajout la note  dans le tableau
            array_push($objectNotes, $note);
            // On persiste l'objet note
            $manager->persist($note);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
