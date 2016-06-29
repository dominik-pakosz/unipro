<?php
/**
 * Created by PhpStorm.
 * User: dominikpakosz
 * Date: 29.06.16
 * Time: 15:55
 */

namespace unipro\PageBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    private $routes = [
                '/o-firmie',
                '/oferta',
                '/uslugi',
                '/kontakt',
                '/galeria',
                '/stanowisko-badawcze',
                '/dzialalnosc',
                '/technika-doboru'
                ];

    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(__DIR__.'/fixtures.yml', $manager, [
            'providers' => [$this]
        ]);
    }

    public function route()
    {

        $key = array_rand($this->routes);
        $route = $this->routes[$key];
        unset($this->routes[$key]);
        
        return $route;
    }
}