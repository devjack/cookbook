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
use Cookbook\Decision\DecisionManager;

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
    /**
     * @var Ingredient[]
     */
    protected $ingredients = null;

    /**
     * @var Recipe[]
     */
    protected $recipes = null;

    /**
     * @var Fridge
     */
    protected $fridge = null;

    /**
     * @var DecisionManager
     */
    protected $decisionManager = null;

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
     * @param DecisionManager $decisionManager
     */
    public function setDecisionManager(DecisionManager $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * @return DecisionManager
     */
    public function getDecisionManager()
    {
        if(is_null($this->decisionManager)) {
            throw new \LogicException("Decision Manager must be configured");
        }
        return $this->decisionManager;
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

            // Convert the recipe into an array of recipe-name => Ingredient[]
            $recipeChoices = $this->convertRecipiesToIngredientArrays($possibleRecipes);

            return $this->chooseRecipeWithStrategies($possibleRecipes);

        } else if($countPossibleRecipes == 1) {
            return array_pop($possibleRecipes);
        }

        return null;
    }

    protected function convertRecipiesToIngredientArrays(array $recipes) {

        $ingredientArray = array();

        $fridge = $this->getFridge();

        /** @var Recipe $recipe */

        foreach($recipes as $recipe) {
            $items = array();
            foreach($recipe->getIngredients() as $ingredient) {
                $items[] = $fridge->getIngredientByName($ingredient->getItem());
            }
            $ingredientArray[$recipe->getName()] = $items;
        }

        return $ingredientArray;
    }

    /**
     * @param Recipe[] $recipes
     * @return Recipe;
     */
    protected function chooseRecipeWithStrategies(array $recipes) {

        $dm = $this->getDecisionManager();

        /**
         * Contains an array of recipe-name => Food[] to choose from
         */
        $selection = array ();

        $fridge = $this->getFridge();

        // Populate $selection
        foreach($recipes as $recipe) {
            // Get the food out of the fridge for each item.
            $food = array();
            foreach($recipe->getIngredients() as $ingredient) {
                $food[] = $fridge->getIngredientByName($ingredient->getItem());
            }
            $selection[$recipe->getName()] = $food;
        }


        $bestRecipeName = $dm->choose($selection);

        foreach($recipes as $recipe) {
            if($recipe->getName() === $bestRecipeName) {
                return $recipe;
            }
        }

        // If we reach here, the decision manager returned a recipe that wasn't provided to it!
        throw new \LogicException("Recipe chosen was invalid.");
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
 