<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 1:41 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommunityController
{
    /**
     * @Route("/communities", name="angular_demoweb_1", options={"expose" = true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        return array();
    }

}