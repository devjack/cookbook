<?php

/**
 *  Cookbook\Entity\Ingredient  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook\Entity;

/**
 * Recipe class
 *
 *
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class Ingredient extends Food
{

    protected $useBy = null;

    /**
     * @param \DateTime $useBy
     */
    public function setUseBy(\DateTime $useBy)
    {
        $this->useBy = $useBy;
    }

    /**
     * @return \DateTime
     */
    public function getUseBy()
    {
        return $this->useBy;
    }

}

 