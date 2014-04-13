<?php


/**
 *  CookbookMocks\MockData  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace CookbookMocks;

use CookbookMocks\Factory\MockFactory;

/**
 * MockData class
 *
 * Mock data as provided by the specification
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class MockData
{
    public static function getIngredients()
    {
        return array(
            MockFactory::createIngredient(
                array(
                    'item' => 'bread',
                    'amount' => 10,
                    'unit' => 'slices',
                    'expiry' => '25/12/2014'
                )
            ),
            MockFactory::createIngredient(
                array(
                    'item' => 'cheese',
                    'amount' => 10,
                    'unit' => 'slices',
                    'expiry' => '25/12/2014'
                )
            ),
            MockFactory::createIngredient(
                array(
                    'item' => 'butter',
                    'amount' => 250,
                    'unit' => 'grams',
                    'expiry' => '25/12/2014'
                )
            ),
            MockFactory::createIngredient(
                array(
                    'item' => 'peanut butter',
                    'amount' => 250,
                    'unit' => 'grams',
                    'expiry' => '25/12/2014'
                )
            ),
            MockFactory::createIngredient(
                array(
                    'item' => 'mixed salad',
                    'amount' => 500,
                    'unit' => 'grams',
                    'expiry' => '26/12/2013'
                )
            ),
        );
    }

    public static function getRecipes()
    {
        /**
         * Recipes as provied by the specification
         */
        return array(
            MockFactory::createRecipe(
                array(
                    'name' => 'grilled chease on toast',
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
                    'name' => 'salad sandwich',
                    'ingredients' => array(
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
                )
            ),
        );
    }

}
 