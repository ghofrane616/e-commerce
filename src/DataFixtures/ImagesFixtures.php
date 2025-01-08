<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // Création de 100 images
        for ($img = 1; $img <= 100; $img++) {
            $image = new Images();

            // Génération d'une image fictive (le chemin sera une chaîne de caractères)
            $image->setName($faker->imageUrl(640, 480, 'product', true));

            // Récupération d'un produit aléatoire (référence correcte)
            $product = $this->getReference('prod-' . rand(1, 10), Products::class);
            $image->setProducts($product);

            $manager->persist($image);
        }

        // Enregistrement des images dans la base de données
        $manager->flush();
    }

    // Spécifie que les fixtures des produits doivent être chargées avant
    public function getDependencies(): array
    {
        return [
            ProductsFixtures::class
        ];
    }
}
