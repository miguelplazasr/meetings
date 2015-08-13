<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 10:07 AM
 */

namespace AppBundle\Handler;


use AppBundle\Form\CommunityType;
use AppBundle\Model\CommunityInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;

class CommunityHandler implements CommunityHandlerInterface
{
    private $em;
    private $entityClass;
    private $repository;
    private $form;

    public function __construct(EntityManager $em, $entityClass )
    {
        $this->em = $em;
        $this->entityClass = $entityClass;
        $this->repository = $this->em->getRepository($this->entityClass);
        //$this->form = $form;
    }

    /**
     * Get a Community
     *
     * @param mixed $id
     * @return CommunityInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Edit a Entity.
     *
     * @api
     *
     * @param CommunityInterface $community
     * @param array $parameters
     *
     * @return CommunityInterface
     */
    public function put(CommunityInterface $community, array $parameters)
    {
        // TODO: Implement put() method.
    }

    /**
     * Partially update a Community.
     *
     * @api
     *
     * @param CommunityInterface $community
     * @param array $parameters
     *
     * @return CommunityInterface
     */
    public function patch(CommunityInterface $community, array $parameters)
    {
        // TODO: Implement patch() method.
    }

    /**
     * Get a list of the Communities.
     *
     * @return array
     */
    public function all()
    {
        return $this->repository->findAll();
    }

    /**
     * Post Community, creates a new Community.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return CommunityInterface
     */
    public function post(array $parameters)
    {
        $community = $this->createCommunity();
        return $this->processForm($community, $parameters, 'PUT');
    }

    /**
     * Processes the form.
     *
     * @param CommunityInterface $community
     * @param array $parameters
     * @param String $method
     * @return CommunityInterface
     * @throws InvalidFormException
     */
    private function processForm(CommunityInterface $community, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new CommunityType(), $community, array('method' => $method));


        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $community = $form->getData();
            $this->em->persist($community);
            $this->em->flush($community);

            return $community;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createCommunity() {
        return new $this->entityClass();
    }
}