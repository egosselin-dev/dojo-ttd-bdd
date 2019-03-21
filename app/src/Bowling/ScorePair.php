<?php
/**
 * Created by PhpStorm.
 * User: egs
 * Date: 2019-02-13
 * Time: 11:21
 */

namespace Dojo\Bowling;

class ScorePair
{
    /** @var int $scoreA */
    protected $scoreA = 0;

    /** @var int $scoreB */
    protected $scoreB = 0;

    /**
     * @return int
     */
    public function getScoreA()
    {
        return $this->scoreA;
    }

    /**
     * @param int $scoreA
     * @return ScorePair
     */
    public function setScoreA($scoreA)
    {
        $this->scoreA = $scoreA;
        return $this;
    }

    /**
     * @return int
     */
    public function getScoreB()
    {
        return $this->scoreB;
    }

    /**
     * @param int $scoreB
     * @return ScorePair
     */
    public function setScoreB($scoreB)
    {
        $this->scoreB = $scoreB;
        return $this;
    }

    /**
     * Return true if score is a strike
     *
     * @return bool
     */
    public function isStrike() : bool
    {
        if (($this->scoreA == 10) || ($this->scoreB == 10)) {
            return true;
        }

        return false;
    }

    /**
     * Return true if score is a spare
     *
     * @return bool
     */
    public function isSpare() : bool
    {
        if ($this->scoreA + $this->scoreB == 10) {
            return true;
        }

        return false;
    }
}