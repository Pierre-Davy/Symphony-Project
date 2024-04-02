<?php

namespace App\DataFixtures;

use App\Entity\Cities;
use App\Entity\Countries;
use App\Entity\Groupes;
use Faker\Generator;
use Faker\Factory;
use App\Entity\Users;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Intl\Countries as IntlCountries;

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

            $groupe = new Groupes();
            $groupe->setName($this->faker->words(3, true));

            $manager->persist($groupe);

            $country = new Countries();
            $country->setName($this->faker->country());

            $manager->persist($country);

            $city = new Cities();
            $city->setName($this->faker->city());
            $city->setCountry($country);

            $manager->persist($city);

            $user = new Users();
            $user->setLastName($this->faker->lastName())
                ->setFirstName($this->faker->firstName($gender = 'male' | 'female'))
                ->setEmail($this->faker->email())
                ->setDateOfBirth($this->faker->dateTime())
                ->setJob($this->faker->jobTitle())
                ->setIntro($this->faker->words(10, true))
                ->setDescription($this->faker->words(50, true))
                ->addGroupe($groupe)
                ->setCity($city);


            $manager->persist($user);
        }

        $manager->flush();
    }
}
