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
use CookbookMocks\Factory\MockFactory;
use Cookbook\Model\Fridge;

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
        $ingredients = array (
            MockFactory::createIngredient(array(
                'item' => 'bread',
                'amount' => 10,
                'unit' => 'slices',
                'expiry' => '25/12/2014'
            )),
            MockFactory::createIngredient(array(
                'item' => 'cheese',
                'amount' => 10,
                'unit' => 'slices',
                'expiry' => '25/12/2014'
            )),
            MockFactory::createIngredient(array(
                'item' => 'butter',
                'amount' => 250,
                'unit' => 'grams',
                'expiry' => '25/12/2014'
            )),
            MockFactory::createIngredient(array(
                'item' => 'peanut butter',
                'amount' => 250,
                'unit' => 'grams',
                'expiry' => '25/12/2014'
            )),
            MockFactory::createIngredient(array(
                'item' => 'mixed salad',
                'amount' => 500,
                'unit' => 'grams',
                'expiry' => '26/12/2013'
            )),
        );


        /**
         * Recipes as provied by the specification
         */
        $recipes = array (
            MockFactory::createRecipe(array(
                'name' => 'grilled chease on toast',
                'ingredients' => array (
                    array(
                        'item' => 'bread',
                        'amount' => 2,
                        'unit' => 'slices',
                    ),
                    array(
                        'item' => 'cheese',
                        'amount' => 2,
                        'unit' => 'slices',
                    ),
                ),
            )),
            MockFactory::createRecipe(array(
                    'name' => 'salad sandwich',
                    'ingredients' => array (
                        array(
                        'item' => 'bread',
                        'amount' => 2,
                        'unit' => 'slices',
                    ),
                    array(
                        'item' => 'mixed salad',
                        'amount' => 200,
                        'unit' => 'grams',
                    ),
                ),
            )),
        );

        $cookbook = new Cookbook();
        $cookbook->setIngredients($ingredients);
        $cookbook->setRecipes($recipes);

        $fridge = new Fridge();
        $fridge->setIngredients($cookbook->getIngredients());
        $cookbook->setFridge($fridge);

        $recipe = $cookbook->chooseOptimalRecipe();

        $this->assertNotNull($recipe, "Cookbook returned no valid recipes.");

        if(!is_null($recipe)) {
            $this->assertEquals('salad sandwich', $recipe->getName());
        }
    }
}

 