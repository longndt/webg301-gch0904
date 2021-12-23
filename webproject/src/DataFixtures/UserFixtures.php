<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    //khai báo HasherInterface để mã hóa mật khẩu
    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        //tạo tài khoản với role USER
        $user = new User();
        $user->setUsername("user");
        $user->setPassword($this->hasher->hashPassword($user,"123"));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        //tạo tài khoản với role ADMIN
        $user = new User();
        $user->setUsername("admin");
        $user->setPassword($this->hasher->hashPassword($user,"123"));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        //tạo tài khoản với role STAFF
        $user = new User();
        $user->setUsername("staff");
        $user->setPassword($this->hasher->hashPassword($user,"123"));
        $user->setRoles(['ROLE_STAFF']);
        $manager->persist($user);

        $manager->flush();
    }
}
