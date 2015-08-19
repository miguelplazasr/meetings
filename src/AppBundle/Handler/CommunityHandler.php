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
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use AppBundle\Exception\InvalidFormException;

class CommunityHandler implements CommunityHandlerInterface
{
    private $em;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(EntityManager $em, $entityClass, FormFactory $formFactory )
    {
        $this->em = $em;
        $this->entityClass = $entityClass;
        $this->repository = $this->em->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
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
        return $this->processForm($community, $parameters, 'PUT');
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
        return $this->processForm($community, $parameters, 'PATCH');
    }

    /**
     * Get a list of the Communities.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0, $orderby = null)
    {
        return $this->repository->findBy(array(), $orderby, $limit, $offset);
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
     * @param string $method
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

    /**
     * Remove a Community
     * @param CommunityInterface $community
     * @param string $method
     * @return bool
     */
    public function processDelete(CommunityInterface $community, $method = "DELETE")
    {
        $this->em->remove($community);
        $this->em->flush();
        return true;
    }

    /**
     * Delete a community
     *
     * @param CommunityInterface $community
     * @return bool
     *
     */
    public function delete(CommunityInterface $community)
    {

        return $this->processDelete($community, 'DELETE');


    }
}