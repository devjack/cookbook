<?php


/**
 *  Cookbook\Decision\StrategyInterface  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook\Decision;

 /**
 * StrategyInterface class
 *
 * 
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

interface DecisionInterface
{

    /**
     * @param Food[] $items
     * @return int
     *
     * Returns the integer weighting based on the decision.  Weighting is between 0 and 100. Higher is better
     */
    public function calculateWeighting(array $items);

}
 