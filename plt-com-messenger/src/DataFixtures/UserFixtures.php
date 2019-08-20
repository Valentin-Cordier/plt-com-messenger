<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');

        $user->setPassword('0000000');

        $user->setEmail('no-reply@overseas.media');

        $manager->persist($user);


        $manager->flush();
    }
}
