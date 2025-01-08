<?php


namespace App\Tests\Integration;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntégrationTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // Nettoyage de la table 'users' avant chaque test pour éviter les conflits
        $this->entityManager->getConnection()->executeQuery('DELETE FROM users');
    }

    public function testUserEntityCRUD(): void
    {
        // Création d'un nouvel utilisateur avec un email unique
        $user = new Users();
        $user->setEmail('test-' . uniqid() . '@example.com')
            ->setPassword('password123')
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setAddress('123 Main St')
            ->setZipcode('12345')
            ->setCity('Metropolis');

        // Persister l'utilisateur
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Récupération de l'utilisateur
        $repository = $this->entityManager->getRepository(Users::class);
        $retrievedUser = $repository->findOneBy(['email' => $user->getEmail()]);

        $this->assertNotNull($retrievedUser);
        $this->assertSame('John', $retrievedUser->getFirstname());

        // Suppression de l'utilisateur
        $this->entityManager->remove($retrievedUser);
        $this->entityManager->flush();

        // Vérification de la suppression
        $deletedUser = $repository->findOneBy(['email' => $user->getEmail()]);
        $this->assertNull($deletedUser);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}

