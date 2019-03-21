<?php
/**
 * Created by PhpStorm.
 * User: egs
 * Date: 2019-02-13
 * Time: 11:21
 */

namespace Dojo\Bowling;

use Doctrine\Common\Collections\ArrayCollection;

class Player
{
    /** @var String $name */
    protected $name;

    /** @var ArrayCollection $scores */
    protected $scores;

    public function __construct()
    {
        $this->scores = new ArrayCollection();
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     * @return Player
     */
    public function setName($name) : Player
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getScorePairs() : ArrayCollection
    {
        return $this->scores;
    }

    public function addScorePair(ScorePair $scoreItem) : Player
    {
        $this->scores->add($scoreItem);
        return $this;
    }

    public function getScorePairAt(int $position) : ?ScorePair
    {
        return $this->scores->offsetGet($position);
    }

    /**
     * @param ArrayCollection $scores
     * @return Player
     */
    public function setScorePairs(ArrayCollection $scores) : Player
    {
        $this->scores = $scores;
        return $this;
    }

    /**
     * Compute score at current position
     *
     * @param int $position
     * @return int
     */
    public function getScoreAt(int $position) : int
    {
        $score = 0;

        if ($position >= $this->scores->count()) {
            return $score;
        }

        for ($i = 0; $i < $this->scores->count(); $i++) {
            if ($i <= $position) {
                $combinedScore = $this->getScorePairAt($i)->getScoreA() + $this->getScorePairAt($i)->getScoreB();
                $score += $combinedScore;
            }
        }

        return $score;
    }

    /**
     * Get total score
     *
     * @return int
     */
    public function getTotalScore() : int
    {
        $totalScore = 0;

        for ($i = 0; $i < $this->scores->count(); $i++) {
            $combinedScore = $this->getScorePairAt($i)->getScoreA() + $this->getScorePairAt($i)->getScoreB();
            $totalScore += $combinedScore;
        }

        return $totalScore;
    }
}