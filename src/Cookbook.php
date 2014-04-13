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
use Cookbook\Model\Fridge;

/**
 * Cookbook class
 *
 * Root module class
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class Cookbook
{
    protected $ingredients = null;
    protected $recipes = null;

    protected $fridge = null;

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
        return $this->ingredients;
    }


    /**
     * @param array $recipes
     */
    public function setRecipes(array $recipes) {
        $this->recipes = $recipes;
    }

    /**
     * @return Recipe[]
     * @throws \LogicException
     */
    public function getRecipes() {
        if(is_null($this->recipes)){
            throw new \LogicException("Recipes must be provied.");
        }
        return $this->recipes;
    }

    /**
     * @param null $fridge
     */
    public function setFridge($fridge)
    {
        $this->fridge = $fridge;
    }

    /**
     * @return Fridge
     */
    public function getFridge()
    {
        if(is_null($this->fridge)) {
            throw new \LogicException("Fridge must be configured");
        }
        return $this->fridge;
    }




    /**
     * @return Recipe
     *
     * Determine the most optimal recipe to cook.  Returns null if we can't cook anything.
     */
    public function chooseOptimalRecipe() {

        $possibleRecipes = array();

        foreach($this->getRecipes() as $recipe) {
            if($this->doesFridgeContainIngredients($recipe->getIngredients())) {
                // We could cook this one.
                $possibleRecipes[] = $recipe;
            }
        }

        $countPossibleRecipes = count($possibleRecipes);
        if($countPossibleRecipes > 1) {
            // more than one possible recipe

        } else if($countPossibleRecipes == 1) {
            return array_pop($possibleRecipes);
        }

        return null;
    }

    /**
     * @param array $ingredients
     * @return bool
     *
     * Tests to determine if the fridge contains enough of each ingedient in the array.
     */
    protected function doesFridgeContainIngredients(array $ingredients) {
        $fridge = $this->getFridge();
        foreach($ingredients as $requiredIngredient) {
            if(!$fridge->containsEnough($requiredIngredient)) {
                return false;
            }
        }
        return true;
    }

}
 