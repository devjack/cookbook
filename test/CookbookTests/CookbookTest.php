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
use Cookbook\Decision\DecisionManager;
use Cookbook\Decision\Strategy\ExpiryDateStrategy;
use Cookbook\Model\Fridge;

use CookbookMocks\MockData;
use CookbookMocks\Factory\MockFactory;


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

    public function testCookbookWithMultiplePossibleRecipes() {
        $recipes = array (
            MockFactory::createRecipe(
                array(
                    'name' => 'grilled cheese on toast',
                    'ingredients' => array(
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
                )
            ),
            MockFactory::createRecipe(
                array(
                    'name' => 'just bread',
                    'ingredients' => array(
                        array(
                            'item' => 'bread',
                            'amount' => 2,
                            'unit' => 'slices',
                        ),
                    ),
                )
            ),
        );

        $ingredients = array (
            MockFactory::createIngredient(
                array(
                    'item' => 'bread',
                    'amount' => 10,
                    'unit' => 'slices',
                    'expiry' => date('d/m/Y', strtotime('tomorrow'))
                )
            ),
            MockFactory::createIngredient(
                array(
                    'item' => 'cheese',
                    'amount' => 10,
                    'unit' => 'slices',
                    'expiry' => date('d/m/Y', strtotime('tomorrow'))
                )
            ),
        );

        /**
         * LOGIC: Since the expiry is the same day, the recipe with 'more' ingredients expiring is the better choice.
         */


        $cookbook = new Cookbook();
        $cookbook->setIngredients($ingredients);
        $cookbook->setRecipes($recipes);

        $fridge = new Fridge();
        $fridge->setIngredients($cookbook->getIngredients());
        $cookbook->setFridge($fridge);

        $decisionManager = new DecisionManager();
        $decisionManager->addStrategy('expiry-date', new ExpiryDateStrategy());
        $cookbook->setDecisionManager($decisionManager);

        $recipe = $cookbook->chooseOptimalRecipe();

        $this->assertNotNull($recipe, "Cookbook returned no valid recipes.");

        $this->assertEquals('grilled cheese on toast', $recipe->getName());
    }


    public function testCookbookWithNoFoodInFridge() {
        $recipes = array (
            MockFactory::createRecipe(
                array(
                    'name' => 'grilled cheese on toast',
                    'ingredients' => array(
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
                )
            ),
            MockFactory::createRecipe(
                array(
                    'name' => 'just bread',
                    'ingredients' => array(
                        array(
                            'item' => 'bread',
                            'amount' => 2,
                            'unit' => 'slices',
                        ),
                    ),
                )
            ),
        );

        $ingredients = array (
            // I must be a uni student... there's no food in the fridge!
        );

        $cookbook = new Cookbook();
        $cookbook->setIngredients($ingredients);
        $cookbook->setRecipes($recipes);

        $fridge = new Fridge();
        $fridge->setIngredients($cookbook->getIngredients());
        $cookbook->setFridge($fridge);

        $decisionManager = new DecisionManager();
        $decisionManager->addStrategy('expiry-date', new ExpiryDateStrategy());
        $cookbook->setDecisionManager($decisionManager);

        $recipe = $cookbook->chooseOptimalRecipe();

        $this->assertNull($recipe);
    }

}

 