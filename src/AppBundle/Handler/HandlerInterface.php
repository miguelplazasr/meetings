<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 10:03 AM
 */

namespace AppBundle\Handler;


use AppBundle\Model\CommunityInterface;

interface HandlerInterface
{
    /**
     * Get a Entity given the identifier
     *
     * @api
     *
     * @param mixed $id*
     */
    public function get($id);

    /**
     * Get a list of the entities content.
     *
     * @return array
     */
    public function all();

    /**
     * Post Entity, creates a new Entity.
     *
     * @api
     *
     * @param array $parameters
     *
     */
    public function post(array $parameters);

}