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
}