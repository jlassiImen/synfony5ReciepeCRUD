<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $recette = new Recette();
            $recette->setTitre($faker->word);
            $recette->setSoustitre($faker->word);
            $recette->setIngredients($faker->sentences);
            $manager->persist($recette);
        }


        $manager->flush();
    }
}
