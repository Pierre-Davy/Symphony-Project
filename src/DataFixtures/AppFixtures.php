<?php

namespace App\DataFixtures;

use Faker\Generator;
use Faker\Factory;
use App\Entity\Users;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    /**
     *
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 50; $i++) {



            $user = new Users();
            $user->setLastName($this->faker->lastName())
                ->setFirstName($this->faker->firstName($gender = 'male' | 'female'))
                ->setEmail($this->faker->email())
                ->setDateOfBirth($this->faker->dateTime())
                ->setJob($this->faker->jobTitle())
                ->setIntro($this->faker->words(10, true))
                ->setDescription($this->faker->words(50, true));


            $manager->persist($user);
        }

        $manager->flush();
    }
}
