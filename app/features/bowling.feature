Feature:
  As a [role], I want to [desire], so that [benefit/desired outcome]


  Scenario: As a player, when i start a game with player Mr roboto i should see this name in player's table
    When I am on "/bowling-score.php?data=%7B%22players%22%3A%5B%7B%22name%22%3A%22Mr%20roboto%22%2C%22scorePairs%22%3A%5B%5D%7D%5D%7D"
    Then the response status code should be 200
    Then I should see "Mr roboto" in player's table

  Scenario: As a player, when i start a game with player Mr roboto and Cheezburger i should see both names in player's table (a row for each player)
    When I am on "/bowling-score.php?data=%7B%22players%22%3A%5B%7B%22name%22%3A%22Mr%20roboto%22%2C%22scorePairs%22%3A%5B%5D%7D%2C%7B%22name%22%3A%22Cheezburger%22%2C%22scorePairs%22%3A%5B%5D%7D%5D%7D"
    Then the response status code should be 200
    Then I should see "Mr roboto" in player's table
    Then I should see "Cheezburger" in player's table


    #
    # Specifications
    #

    # As a player, when i start a game with player Mr roboto, Cheezburger and Gordon i should all names in player's table (a row for each player)

    # As a player when i start a game with invalid / empty json, i should see an error message on the page

    # As a player when i start a game with few or no scores, i should see an hyphen instead of the score numbers on empty score slots

    # As a player when i start a game with few or no scores, i should see zeros instead of the score sub-totals on empty score slots

    # As a player when i call the score page with a score pair on 1st slot (eg. 3, 6), i should see the both score number in the top of the first score slot

    # As a player when i call the score page with a score pair on 1st slot (eg. 3, 7), i should see the sum of the score in the bottom of the first score slot

    # As a player when i make a spare (eg. 7 + 3), the subtotal of the score should be replaced with a "/" char

    # As a player when i make a strike (eg. 10 + 0), the subtotal of the score should be replaced with a "X" char

    # As a player Mr roboto, when i call the page with multiple score pairs, i should see the sum of all scores in the total column (see gerkin Examples function for multiple tests)