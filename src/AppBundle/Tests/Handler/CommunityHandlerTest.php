<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 11:38 AM
 */

namespace AppBundle\Tests\Handler;


use AppBundle\Handler\CommunityHandler;
use FOS\RestBundle\Tests\Functional\WebTestCase;

class CommunityHandlerTest extends WebTestCase
{

    const PAGE_CLASS = 'AppBundle\Tests\Handler\DummyPage';

    /** @var CommunityHandler */
    protected $communityHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }

        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::PAGE_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::PAGE_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::PAGE_CLASS));


    }

    public function testGet()
    {
        $id = 1;
        $page = $this->getCommunity();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($community));

        $this->communityHandler = $this->createCommunityHandler($this->om, static::PAGE_CLASS,  $this->formFactory);

        $this->communityHandler->get($id);
    }

}