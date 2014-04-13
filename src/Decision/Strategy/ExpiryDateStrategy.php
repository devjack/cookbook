<?php


/**
 *  Cookbook\Decision\ExpiryDateStrategy  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook\Decision\Strategy;

use Cookbook\Entity\Ingredient;
use Cookbook\Decision\DecisionStrategyInterface;

 /**
 * ExpiryDateStrategy class
 *
 * 
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class ExpiryDateStrategy implements DecisionStrategyInterface
{

    /**
     * @param Ingredient[] $items
     */
    public function calculateWeighting(array $items) {
        $weighting = 0;
        /** @var Ingredient item */
        foreach($items as $item) {
            $expiryDiff = $item->getUseBy()->diff(new \DateTime);

            /**
             * IF 1 day to expiry, weighting increases by 1
             * IF 2 days to expiry, weighting increases by 1/2
             * IF 3 days to expiry, weighting increases by 1/3
             * etc...
             */
            $weighting += (1 / $expiryDiff->days);
        }

        return $weighting;
    }

}
 