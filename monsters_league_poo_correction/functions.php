<?php
require __DIR__ . '/monster.php';


function getMonstersObjet()
{
    $monsters = getMonsters();
    $monstersAux = array();
    foreach ($monsters as $monster) {
        $monstersAux[] = new Monster($monster['name'],$monster['strength'],$monster['life'],$monster['type']);
    }
    return $monstersAux;
}


function getMonsters()
{
    $dsn = 'mysql:host=localhost;dbname=monsters';
    $username = 'root';
    $password = 'newPass';
    $dbh = new PDO($dsn, $username, $password);
    $query = "SELECT * FROM monster";
    $result = $dbh -> query($query);
    $monster = $result -> fetchAll();
    return $monster;
}

/**
 * Our complex fighting algorithm!
 *
 * @return array With keys winning_ship, losing_ship & used_jedi_powers
 */
function fight(array $firstMonster, array $secondMonster)
{
    $firstMonsterLife = $firstMonster['life'];
    $secondMonsterLife = $secondMonster['life'];

    while ($firstMonsterLife > 0 && $secondMonsterLife > 0) {
        $firstMonsterLife = $firstMonsterLife - $secondMonster['strength'];
        $secondMonsterLife = $secondMonsterLife - $firstMonster['strength'];
    }

    if ($firstMonsterLife <= 0 && $secondMonsterLife <= 0) {
        $winner = null;
        $looser = null;
    } elseif ($firstMonsterLife <= 0) {
        $winner = $secondMonster;
        $looser = $firstMonster;
    } else {
        $winner = $firstMonster;
        $looser = $secondMonster;
    }

    return array(
        'winner' => $winner,
        'looser' => $looser,
    );
}