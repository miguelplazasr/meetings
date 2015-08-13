<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 1:41 PM
 */

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class CommunityController
{
    /**
     * @Route("/communities", name="communities", options={"expose" = true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        return array();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCommunitiesAction(Request $request )
    {

        return $this->container->get('app.handler.community_handler')->all();
    }

}