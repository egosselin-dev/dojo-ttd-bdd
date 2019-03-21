<?php
    // URL with param
    //json => ?data={"players": [{"name": "Mr roboto", "scorePairs" : [[7, 3], [10,0], [8,1]]}]}
    //encoded => ?data=%7B%22players%22%3A%20%5B%7B%22name%22%3A%20%22Mr%20roboto%22%2C%20%22scorePairs%22%20%3A%20%5B%5B7%2C%203%5D%2C%20%5B10%2C0%5D%2C%20%5B8%2C1%5D%5D%7D%5D%7D

    require_once '../vendor/autoload.php';

    use Doctrine\Common\Collections\ArrayCollection;
    use Dojo\Bowling\PlayerFactory;
    use Dojo\Bowling\Player;

    $jsonData = $_GET['data'] ?? null;
    $error = false;

    if ($jsonData == null) {
        $error = true;
    }

    $players = new ArrayCollection();

    foreach (json_decode($jsonData, true)['players'] as $playerData) {
        $playerFactory = new PlayerFactory();
        $players->add($playerFactory->create($playerData));
    }
?>

<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS -->
        <link rel="stylesheet" href="local.css">

        <title>Bowling scores</title>
    </head>

    <body>
        <h1>Bowling scores</h1>

        <?php if (!$error): ?>
            <table class="score-table">
                <thead>
                    <tr>
                        <th>Player name</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($players as /** @var Player $player */ $player): ?>
                        <tr>
                            <th scope="row"><?php echo $player->getName(); ?></th>
                            <?php for ($i = 0; $i < 10; $i++): ?>
                                <td style="padding: 0px; margin: 0px;">
                                    <div style="display: flex; flex-wrap: wrap; width: 63px; height: 63px; text-align:center; line-height: 30px;">
                                        <div style="width: 30px; height: 30px;">
                                            <?php echo null !== $player->getScorePairAt($i) ? $player->getScorePairAt($i)->getScoreA() : '-'; ?>
                                        </div>
                                        <div style="width: 30px; height: 30px; border-left: 1px solid grey; border-bottom: 1px solid grey;">
                                            <?php echo null !== $player->getScorePairAt($i) ? $player->getScorePairAt($i)->getScoreB() : '-'; ?>
                                        </div>
                                        <div style="width: 60px; height: 30px;">
                                            <?php if (null !== $player->getScorePairAt($i) && $player->getScorePairAt($i)->isStrike()): ?>
                                                X
                                            <?php elseif (null !== $player->getScorePairAt($i) && $player->getScorePairAt($i)->isSpare()): ?>
                                                /
                                            <?php else: ?>
                                                <?php echo $player->getScoreAt($i); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            <?php endfor; ?>
                            <td style="text-align:center;">
                                <?php echo $player->getTotalScore(); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <p>Erreur de données ou pas de données</p>
            </div>
        <?php endif; ?>
        <br/>
        <br/>
        <h2>Json data</h2>

        <form method="get" action="bowling-score.php" onsubmit="normalizeJson()">
            <textarea cols="80" rows="20" id="data" name="data">
                <?php echo $_GET['data'] ?? ''; ?>
            </textarea>
            <br/>
            <br/>
            <input type="submit"/>
        </form>

        <script>
            function prettyPrintJson() {
                var ugly = document.getElementById('data').value;
                var obj = JSON.parse(ugly);
                var pretty = JSON.stringify(obj, undefined, 2);
                document.getElementById('data').value = pretty;
            }

            function normalizeJson() {
                var jsonData = document.getElementById('data').value;
                var obj = JSON.parse(jsonData);
                var normalizedJson = JSON.stringify(obj, undefined, 0);
                document.getElementById('data').value = normalizedJson;
            }

            window.onload = prettyPrintJson();
        </script>

        <br/>
        <br/>
        <h2>Sample calls</h2>
        <ul>
            <li>
                One player :
                <a href='bowling-score.php?data={"players":[{"name":"Mr roboto","scorePairs":[[7,3],[10,0]]}]}'>
                    bowling-score.php?data={"players":[{"name":"Mr roboto","scorePairs":[[7,3],[10,0]]}]}
                </a>
            </li>
            <li>
                Two player :
                <a href='bowling-score.php?data={"players":[{"name":"Mr roboto","scorePairs":[[7,3],[10,0]]},{"name":"Cheezburger","scorePairs":[[2,7],[8,1]]}]}'>
                    bowling-score.php?data={"players":[{"name":"Mr roboto","scorePairs":[[7,3],[10,0]]},{"name":"Cheezburger","scorePairs":[[2,7],[8,1]]}]}
                </a>
            </li>
        </ul>
    </body>
</html>