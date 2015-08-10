<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 11:10 AM
 */

namespace AppBundle\Controller\Api;


use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use AppBundle\Entity\Community;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommunityController extends FOSRestController
{
    /**
     * @Route("/community")
     * @Method("GET")
     */
    public function getCommunityAction($id) {

        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('Community')->find($id);

        return $entity;
    }

    /**
     * @Route("/communities", name="get_communities", options={"expose" = true})
     * @Method("GET")
     * @Template()
     */
    public function getCommunitiesAction() {

        $em = $this->container->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('AppBundle:Community')->findAll();

        $view = $this->view($data, 200)
            ->setTemplate('AppBundle:Rest:getCommunities.html.twig')
        ->setTemplateVar('communities');

        //$serializedEntities = $this->container->get('serializer')->serialize($entities, 'json');

        //return $serializedEntities;
        //return $this->get('fos_rest.view_handler')->handle($view);

        return $this->handleView($view);
    }
}