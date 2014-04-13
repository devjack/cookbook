<?php


/**
 *  Cookbook\Entity\Food  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook\Entity;

 /**
 * Food class
 *
 * 
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class Food
{
    const UNIT_OF = 'of';
    const UNIT_GRAMS = 'grams';
    const UNIT_ML = 'milliletres';
    const UNIT_SLICES = 'slices';


    protected $item = '';
    protected $amount = 0;
    protected $unit = null;

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param null $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return null
     */
    public function getUnit()
    {
        return $this->unit;
    }

}
 