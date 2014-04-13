<?php


/**
 *  CookbookMocks\Factory\MockFactory  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace CookbookMocks\Factory;

use Cookbook\Entity\Food;
use Cookbook\Entity\Ingredient;
use Cookbook\Entity\Recipe;
use Cookbook\Factory\AbstractFactory;
use Cookbook\Factory\RecipeFactory;

/**
 * MockFactory class
 *
 * A utility class for unit testing.   Basic factory for transforming input array data to entities.
 *
 * NOTE: This factory does NOT validate input data and assumes valid arguments.
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class MockFactory
{

    protected static $unitConversion = array (
        'of' => Food::UNIT_OF,
        'grams' => Food::UNIT_GRAMS,
        'ml' => Food::UNIT_ML,
        'slices' => Food::UNIT_ML,
    );

    public static function createIngredient(array $fields) {

        $ingredient = new Ingredient();
        $ingredient->setUseBy(\DateTime::createFromFormat('d/m/Y', $fields['expiry']));
        $ingredient->setAmount($fields['amount']);
        $ingredient->setItem($fields['item']);
        $ingredient->setUnit(self::$unitConversion[$fields['unit']]);

        return $ingredient;
    }

    public static function createRecipe(array $fields) {

        $recipe = new Recipe();

        $recipe->setName($fields['name']);

        // Populate each ingredient
        $ingredients = array();
        foreach($fields['ingredients'] as $ingredientFields) {
            $item = new Food();
            $item->setAmount($ingredientFields['amount']);
            $item->setItem($ingredientFields['item']);
            $item->setUnit(self::$unitConversion[$ingredientFields['unit']]);
            $ingredients[] = $item;
        }
        $recipe->setIngredients($ingredients);

        return $recipe;
    }

}
