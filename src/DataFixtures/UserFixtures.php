<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordencoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function  __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordencoder=$passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
         $user = new User();
         $user->setPassword($this->passwordencoder->encodePassword (
             $user,
             'the_new_password'
         ));

         $manager->persist($user);
         $manager->flush();
    }
}
