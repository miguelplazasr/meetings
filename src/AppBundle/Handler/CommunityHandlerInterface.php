<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 13/08/15
 * Time: 4:30 PM
 */

namespace AppBundle\Handler;


use AppBundle\Model\CommunityInterface;

interface CommunityHandlerInterface extends HandlerInterface
{

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
    public function put(CommunityInterface $community, array $parameters);

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
    public function patch(CommunityInterface $community, array $parameters);


}