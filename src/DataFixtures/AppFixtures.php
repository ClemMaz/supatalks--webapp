<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Event;
use App\Entity\Speaker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        $speakerArray = [];
        for($i=0; $i<41; $i++) {
            $speaker = new Speaker();
            $speaker->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setJob($faker->jobTitle)
                ->setCompany($faker->company)
                ->setExperience($faker->numberBetween(1,20))
                ->setImage('https://randomuser.me/api/portraits/men'.$i.'.jpg')
                ;

                array_push($speakerArray, $speaker);
            $manager->persist($speaker);
        }

        $events= [
        'Frontend Masters',
        'Backend Masters',
        'Fullstack Masters',
        'Truth about PHP',
        'Symfony 7, new features',
        'React 18, what\'s new',
        'Vue.js 4, the future',
        'Angular 12, the best version',
        'Web Components, the future of the web',
        'UX/UI fro Frontend dev',
        'Angular vs React, which one to choose',
        'Vue.js vs Svelte, which one to choose',
        'Web Components vs React, which one to choose',
        'Web Components vs Vue.js, which one to choose',
        'Web Components vs Angular, which one to choose',
        'Web Components vs Svelte, which one to choose',
        'React vs Angular, which one to choose',
        'React vs Vue.js, which one to choose',
        'React vs Svelte, which one to choose',
        'Vue.js vs Angular, which one to choose',
        ];
        foreach ($events as $item) {
            $event = new Event();
            $event->setName($item)
                ->setTheme('Web development')
                ->setDate($faker->dateTimeBetween('-6 months', '+6 months'))
                ->setLocation($faker->city)
                ->setAttendee($faker->numberBetween(10, 100))
                ->setPrice($faker->numberBetween(0, 250))
                ->addSpeaker($speakerArray[$faker->numberBetween(0, 39)])
                ;
            $manager->persist($event);
        }    
        $manager->flush();
    }

}