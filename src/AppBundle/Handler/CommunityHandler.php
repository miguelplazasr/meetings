<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 10:07 AM
 */

namespace AppBundle\Handler;


use AppBundle\Model\CommunityInterface;
use Doctrine\ORM\EntityManager;

class CommunityHandler implements CommunityHandlerInterface
{
    private $em;
    private $entityClass;
    private $repository;

    public function __construct(EntityManager $em, $entityClass)
    {
        $this->em = $em;
        $this->entityClass = $entityClass;
        $this->repository = $this->em->getRepository($this->entityClass);
    }

    /**
     * Get a Community unique by Id
     *
     * @param mixed $id
     * @return CommunityInterface
     */
    public function getId($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get Communities
     *
     * @return CommunityInterface
     */
    public function getCommunities() {

        return $this->repository->findAll();

    }

    private function createCommunity()
    {
        return new $this->entityClass();
    }
}