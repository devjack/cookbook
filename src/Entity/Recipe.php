<?php


/**
 *  Cookbook\Entity\Recipt  class
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

class Recipe
{

    protected $name = "";
    protected $ingredients = null;

    /**
     * @param null $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return null
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



}
