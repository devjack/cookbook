<?php


/**
 *  CookbookTests\Decision\Strategy\ExpiryDateStrategyTest  class
 *
 * PHP version 5.3
 *
 * @category tests
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace CookbookTests\Decision\Strategy;

use Cookbook\Decision\DecisionManager;
use Cookbook\Decision\Strategy\ExpiryDateStrategy;
use Cookbook\Entity\Ingredient;

 /**
 * ExpiryDateStrategyTest class
 *
 * 
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class ExpiryDateStrategyTest extends \PHPUnit_Framework_TestCase {

    public function testDateWeighting() {
        $item1 = new Ingredient();
        $item1->setItem("apple");
        $item1->setUseBy(\DateTime::createFromFormat('d/m/Y', date('d/m/Y', strtotime('+3 days'))));

        $item2 = new Ingredient();
        $item2->setItem("banana");
        $item2->setUseBy(\DateTime::createFromFormat('d/m/Y', date('d/m/Y', strtotime('tomorrow'))));

        $items = array(
            $item1, // 3 days = 1/3
            $item2, // 1 day = 1/1
        );

        $expiryStrategy = new ExpiryDateStrategy();
        $score = $expiryStrategy->calculateWeighting($items);

        $this->assertEquals(1 + 1/3, $score);

    }

}

 