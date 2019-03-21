<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Then I should see :player in player's table
     */
    public function iShouldSeeInPlayersTable($player)
    {
        $pageContent = $this->getSession()->getPage()->getContent();
        $pattern = sprintf('/\<tr\>[\n\s]+\<th scope="row"\>%s\<\/th\>/', $player);

        if (0 === preg_match($pattern, $pageContent)) {
            throw new InvalidArgumentException('Player name not found');
        }
    }
}
