<?php

namespace AppBundle\Tests\Fixtures\Entity;

use AppBundle\Entity\Community;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadCommunityData implements FixtureInterface
{
    static public $communities = array();

    public function load(ObjectManager $manager)
    {
        $community = new Community();
        $community->setName('name');

        $manager->persist($community);
        $manager->flush();

        self::$communities[] = $community;
    }

    public function testGet() {

        $fixtures = array('AppBundle\Tests\Fixtures\Entity\LoadCommunityData');

    }
}
