<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 1:41 PM
 */

namespace AppBundle\Controller\Web;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommunityController
{
    /**
     * @Route("/communities", name="angular_demo_1", options={"expose" = true})
     * @Template()
     */
    public function indexAction() {
        return array();
    }

}