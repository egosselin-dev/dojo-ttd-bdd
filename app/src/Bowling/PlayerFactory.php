<?php
/**
 * Created by PhpStorm.
 * User: egs
 * Date: 2019-02-13
 * Time: 11:21
 */

namespace Dojo\Bowling;

class PlayerFactory
{
    /**
     * @param array $data
     * @return
     */
    public function create(array $data)
    {
        // hydrade player data
        $player = new Player();
        $player->setName($data['name']);

        // hydrate player scores
        foreach ($data['scorePairs'] as $scoreItem)
        {
            $score = new ScorePair();
            $score->setScoreA($scoreItem[0]);
            $score->setScoreB($scoreItem[1]);

            $player->addScorePair($score);
        }

        return $player;
    }
}