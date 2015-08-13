<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 11:10 AM
 */

namespace AppBundle\Controller\Api;


use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use AppBundle\Entity\Community;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommunityController extends FOSRestController
{
    /**
     * @Annotations\Route("/community")
     * @Method("GET")
     */
    public function getCommunityAction($id) {

        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('Community')->find($id);

        return $entity;
    }

    /*
     * @Get("/communities", name="get_communities", defaults={"_format" = "json"})
     * @\FOS\RestBundle\Controller\Annotations\View()
     *
    public function getCommunitiesAction() {

        $em = $this->container->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('AppBundle:Community')->findAll();

        $view = $this->view($data, 200)
            ->setTemplate('AppBundle:Rest:getCommunities.html.twig');

        //$serializedEntities = $this->container->get('serializer')->serialize($data, 'json');

        //return $serializedEntities;
        //return $this->get('fos_rest.view_handler')->handle($view);

        return $this->handleView($view);
        //return new Response($serializedEntities, 200, array('application/json'));
    } *

    /**
     * @Get("/communities", name="get_communities", defaults={"_format" = "json"})
     * @param Request $request
     * @return array
     */



    /**
     * List all pages.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     *
     * @Annotations\View(
     *  templateVar="communities"
     * )
     *
     * @param Request               $request      the request object
     * @Annotations\Get("/communities", name="get_communities")
     * @return array
     */
    public function getCommunitiesAction(Request $request )
    {

        return $this->container->get('app.handler.community_handler')->all();
    }
}