<?php


/**
 *  Cookbook\Decision\DecisionManager  class
 *
 * PHP version 5.3
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 *
 */

namespace Cookbook\Decision;

/**
 * DecisionManager class
 *
 * Decision Manager handles decisions via registered strategies. Each strategy returns a weighting; higher is better.
 *
 * @package  Cookbook
 * @author   Jack Skinner <sydnerdrage@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://bitbucket.org/sydnerdrage/cookbook
 */

class DecisionManager
{

    protected $strategies = array();

    public function addStrategy($name, DecisionInterface $strategy)
    {
        $this->strategies[$name] = $strategy;
    }

    // todo: add a removeStrategy($name); method

    /**
     * @param array $selection
     * @return string
     */
    public function choose(array $selection)
    {

        $scores = array();
        foreach ($selection as $name => $choice) {
            $scores[$name] = $this->calculateScoreFor($choice);
        }

        arsort($scores); // Sort by the value... i.e. the score

        reset($scores); // move the cursor to the first element;

        return key($scores); // Get the key at the cursor. i.e. the first item's key
    }

    /**
     * @param Food[] $choice
     * @throws \LogicException
     */
    protected function calculateScoreFor(array $choice)
    {
        if(is_null($this->strategies) || empty($this->strategies)) {
            throw new \LogicException("At least one strategy must be registered for the DecisionManager.");
        }

        $score = $this->aggregateStrategyScore($choice);

        return $score;
    }

    protected function aggregateStrategyScore(array $choice)
    {
        $score = 0;
        /** @var DecisionInterface $strategy */
        foreach ($this->strategies as $strategyName => $strategy) {
            $score += $strategy->calculateWeighting($choice);
        }
        return $score;
    }
}
 