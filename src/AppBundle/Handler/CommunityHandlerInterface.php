<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 10:03 AM
 */

namespace AppBundle\Handler;


use AppBundle\Model\CommunityInterface;

interface CommunityHandlerInterface
{
    /**
     * Get a Community given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return CommunityInterface
     */
    public function getId($id);


}