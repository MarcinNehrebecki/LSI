<?php

namespace App\DataFixtures;

use App\Entity\Exports;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ExportsFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $e['user'] = new User();
        $e['user']->setPassword($this->userPasswordHasher->hashPassword(
            $e['user'],'exportTest'))
            ->setEmail('exportTest@test.pl')
            ->setName('exportTest')
            ->setRoles(['ROLE_USER']);

        for ($i = 0;$i <= 22; $i++) {
            $e['export_'. $i] = (new Exports())
                ->setAuthor($e['user'])
                ->setName('exportTest - ' . $i)
                ->setLocalName( 'exportTest local ' . $i)
                ->setExportAt(new \DateTime());
        }

        $e['user_2'] = new User();
        $e['user_2']->setPassword($this->userPasswordHasher->hashPassword(
            $e['user_2'],'exportTest 2'))
            ->setEmail('exportTest2@test.pl')
            ->setName('exportTest2')
            ->setRoles(['ROLE_USER']);

        for ($i = 0;$i <= 22; $i++) {
            $e['export_user2_'. $i] = (new Exports())
                ->setAuthor($e['user_2'])
                ->setName('exportTest 2 - ' . $i)
                ->setLocalName( 'exportTest 2 local ' . $i)
                ->setExportAt(new \DateTime());
        }

        foreach ($e as $entity) {
            $manager->persist($entity);
        }
        $manager->flush();
    }
}
