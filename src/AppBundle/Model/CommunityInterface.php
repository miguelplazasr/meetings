<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/08/15
 * Time: 9:43 AM
 */

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;


interface CommunityInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     * @return CommunityInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();




}