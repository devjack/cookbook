<?php


/**
 *  CookbookTest\CookbookTest  class
 *
 * PHP version 5.3
 *
 * @category tests
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace CookbookTest;

use Cookbook\Cookbook;
use Cookbook\Model\Fridge;

use CookbookMocks\MockData;


/**
 * CookbookTest class
 *
 *
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class CookbookTest extends \PHPUnit_Framework_TestCase {


    /**
     * Ingredients as provied by the specification
     */
    public function testSpecSample1() {
        $ingredients = MockData::getIngredients();

        /**
         * Recipes as provied by the specification
         */
        $recipes = MockData::getRecipes();

        $cookbook = new Cookbook();
        $cookbook->setIngredients($ingredients);
        $cookbook->setRecipes($recipes);

        $fridge = new Fridge();
        $fridge->setIngredients($cookbook->getIngredients());
        $cookbook->setFridge($fridge);

        $recipe = $cookbook->chooseOptimalRecipe();

        $this->assertNotNull($recipe, "Cookbook returned no valid recipes.");

        if(!is_null($recipe)) {
            $this->assertEquals('grilled cheese on toast', $recipe->getName());
        }
    }
}

 