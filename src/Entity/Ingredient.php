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
 * Recipt class
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
     * @param null $useBy
     */
    public function setUseBy($useBy)
    {
        $this->useBy = $useBy;
    }

    /**
     * @return null
     */
    public function getUseBy()
    {
        return $this->useBy;
    }

}

 