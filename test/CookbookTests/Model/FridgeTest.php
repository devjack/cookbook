<?php


/**
 *  CookbookTest\Model\FridgeTest  class
 *
 * PHP version 5.3
 *
 * @category tests
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace CookbookTest\Model;

use Cookbook\Model\Fridge;
use Cookbook\Entity\Food;
use CookbookMocks\MockData;

/**
 * FridgeTest class
 *
 * 
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/recipefinder
 */

class FridgeTest extends \PHPUnit_Framework_TestCase {

    public function testContainsQuantity() {

        $fridge = new Fridge();

        $food = new Food();
        $food->setAmount(1000);
        $food->setItem('bread');

        $fridge->setIngredients(MockData::getIngredients());

        // Should not contain 1000 slices of bread
        $this->assertFalse($fridge->containsEnough($food));

        // Should contain 1 slice of bread
        $food->setAmount(1);
        $this->assertTrue($fridge->containsEnough($food));

        // Should not contain any grapes
        $food->setItem('grapes');
        $this->assertFalse($fridge->containsEnough($food));

        // Mixed salad is expired, we shouldn't have any
        $food->setItem('mixed salad');
        $this->assertFalse($fridge->containsEnough($food));
    }

    public function testLogicExceptions() {

        $fridge = new Fridge();

        $food = new Food();
        $food->setAmount(1000);
        $food->setItem('bread');

        // We havent set any ingredients yet, it should throw a logic exception
        $this->setExpectedException('LogicException');
        $fridge->containsEnough($food);

    }

}

 