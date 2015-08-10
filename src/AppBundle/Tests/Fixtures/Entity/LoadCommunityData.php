<?php

namespace AppBundle\Tests\Fixtures\Entity;

use AppBundle\Entity\Community;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadCommunityData implements FixtureInterface
{
    static public $pages = array();

    public function load(ObjectManager $manager)
    {
        $page = new Page();
        $page->setTitle('title');
        $page->setBody('body');

        $manager->persist($page);
        $manager->flush();

        self::$pages[] = $page;
    }
}
