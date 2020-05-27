<?php

namespace App\DataFixtures;

use App\Entity\Marques;
use App\Entity\Produits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $marque1 = new Marques();
        $marque1->setNom('Apple');
        $manager->persist($marque1);
        $marque2 = new Marques();
        $marque2->setNom('Samsung');
        $manager->persist($marque2);
        $marque3 = new Marques();
        $marque3->setNom('Microsoft');
        $manager->persist($marque3);

        $MarqueArray = [$marque1,$marque2,$marque3];

        for ($i=0; $i<=100; $i++){
            shuffle($MarqueArray);
            $produit = new Produits();
            $produit->setTitre($faker->randomElement(['Lave vaisselle', 'Grille pain', 'TV 110 cm', 'Aspirateur', 'Ordinateur', 'Tablette', 'Smartphone', 'Cafetière', 'Lave Linge', 'Robot Ménager']))
                ->setCouleur($faker->numberBetween(1,10))
                ->setDescription($faker->sentence(20,true))
                ->setPoids($faker->randomFloat(2,2,500))
                ->setPriceTTC($faker->randomNumber(4))
                ->setActif($faker->randomElement([true,false]))
                ->setStockQte($faker->randomNumber(2))
                ->setMarque($MarqueArray[0])
            ;

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
