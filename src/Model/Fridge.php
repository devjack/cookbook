<?php


/**
 *  Cookbook\Model\Fridge  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook\Model;

use Cookbook\Entity\Food;
use Cookbook\Entity\Ingredient;

/**
 * Fridge class
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class Fridge
{
    /**
     * @var Ingredient[] $ingredients
     * item-name => Ingredient
     */
    protected $ingredients = null;

    /**
     * @param Ingredient[] $ingredients
     */
    public function setIngredients(array $ingredients) {
        /** @var Ingredient $ingredient*/
        foreach($ingredients as $ingredient) {
            $this->ingredients[$ingredient->getItem()] = $ingredient;
        }
    }

    public function getIngredients() {
        if(is_null($this->ingredients)) {
            throw new \LogicException("Ingredients must be provied.");
        }
        return $this->ingredients;
    }

    public function containsEnough(Food $item) {
        // shortcircut if we don't have the item in question at all.
        if(!array_key_exists($item->getItem(), $this->getIngredients())) {
            return false;
        }

        $ingredient = $this->ingredients[$item->getItem()];

        // Ensure we're not cooking mouldy food
        if($ingredient->getUseBy() < new \DateTime()) {
            return false; // It's expired!
        }

        // Return if we have enough.
        return $ingredient->getAmount() >= $item->getAmount();
    }

}
 