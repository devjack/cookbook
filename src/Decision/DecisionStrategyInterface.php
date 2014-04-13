<?php


/**
 *  Cookbook\Decision\DecisionStrategyInterface  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook\Decision;

 /**
 * DecisionStrategyInterface class
 *
 * 
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

interface DecisionStrategyInterface
{

    /**
     * @param Food[] $items
     * @return int
     *
     * Returns the integer weighting based on the decision.  Weighting is between 0 and 100. Higher is better
     */
    public function calculateWeighting(array $items);

}
 