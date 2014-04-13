<?php


/**
 *  CookbookTest\Decision\DecisionManagerTest  class
 *
 * PHP version 5.3
 *
 * @category tests
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace CookbookTest\Decision;

use Cookbook\Decision\DecisionManager;
use Cookbook\Decision\Strategy\ExpiryDateStrategy;

use Cookbook\Entity\Ingredient;

/**
 * DecisionManagerTest class
 *
 * 
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class DecisionManagerTest extends \PHPUnit_Framework_TestCase {

    public function testDecisionManagerEndToEnd() {

        $item1 = new Ingredient();
        $item1->setItem("apple");
        $item1->setUseBy(\DateTime::createFromFormat('d/m/Y', date('d/m/Y', strtotime('+3 days')))); // 1/3 weighting

        $item2 = new Ingredient();
        $item2->setItem("banana");
        $item2->setUseBy(\DateTime::createFromFormat('d/m/Y', date('d/m/Y', strtotime('tomorrow')))); // 1/1 weighting


        $choices = array (
            'Apple based recipe' => array ($item1), // expects a 1/3 weighting
            'Banana based recipe' => array($item2), // expects a 1/1 weighting - should be preferred
        );

        $dm = new DecisionManager();

        // Register the expiry date strategy with the decision manager.
        $dm->addStrategy('expiry-date', new ExpiryDateStrategy());

        // Get the key of the preferred choice.
        $result = $dm->choose($choices);

        $this->assertEquals('Banana based recipe', $result);
    }

    public function testMissingStrategiesException(){
        $dm = new DecisionManager();
        $this->setExpectedException('LogicException');

        $dm->choose(array('some recipe' => array()));
    }

}

 