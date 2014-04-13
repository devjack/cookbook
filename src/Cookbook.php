<?php


/**
 *  Cookbook\Cookbook  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook;

use Cookbook\Entity\Recipe;
use Cookbook\Entity\Ingredient;

 /**
 * Cookbook class
 *
 * Root module class
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/recipefinder
 */

class Cookbook
{
    protected $ingredients = null;
    protected $recipes = null;

    /**
     * @param array $ingredients
     */
    public function setIngredients(array $ingredients) {
        $this->ingredients = $ingredients;
    }

    /**
     * @return array
     * @throws \LogicException
     */
    public function getIngredients() {
        if(is_null($this->ingredients)){
            throw new \LogicException("Ingredients must be provied.");
        }
        return $ingredients;
    }


    /**
     * @param array $recipes
     */
    public function setRecipes(array $recipes) {
        $this->recipes = $recipes;
    }

    /**
     * @return array
     * @throws \LogicException
     */
    public function getRecipes() {
        if(is_null($this->recipes)){
            throw new \LogicException("Recipes must be provied.");
        }
        return $this->recipes;
    }


    /**
     * @return Recipe
     */
    public function chooseOptimalRecipe() {

        return array_pop($this->recipes);
    }

}
 