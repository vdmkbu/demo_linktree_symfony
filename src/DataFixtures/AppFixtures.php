<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        UserFactory::createMany(10);


        for ($i = 1; $i < 5; $i++) {
            $token = new ApiToken(UserFactory::random()->object());
            $manager->persist($token);
        }

        $manager->flush();
    }
}
