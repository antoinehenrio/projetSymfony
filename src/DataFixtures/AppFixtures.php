<?php

namespace App\DataFixtures;

use App\Entity\Produits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i<=100; $i++){
            $produit = new Produits();
            $produit->setTitre($faker->randomElement(['Lave vaisselle', 'Grille pain', 'TV 110 cm', 'Aspirateur', 'Ordinateur', 'Tablette', 'Smartphone', 'Cafetière', 'Lave Linge', 'Robot Ménager']))
                ->setCouleur($faker->numberBetween(1,10))
                ->setDescription($faker->sentence(20,true))
                ->setPoids($faker->randomFloat(2,2,500))
                ->setPriceTTC($faker->randomNumber(4))
                ->setActif($faker->randomElement([true,false]))
                ->setStockQte($faker->randomNumber(2));

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
