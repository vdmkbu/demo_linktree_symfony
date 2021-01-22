<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Factory\LinkFactory;
use App\Factory\UserFactory;
use App\Factory\VisitFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        UserFactory::createMany(10);

        LinkFactory::createMany(50, function() {
           return ['owner' => UserFactory::random()];
        });

        VisitFactory::createMany(600, function() {
           return ['link' => LinkFactory::random()];
        });

        for ($i = 1; $i < 5; $i++) {
            $token = new ApiToken(UserFactory::random()->object());
            $manager->persist($token);
        }

        $manager->flush();
    }
}
