<?php
require('connect.php');

$bracketSet = ['(' => ')', '[' => ']', '{' => '}', '<' => '>'];
$name = $_POST['name'];
isValid($name, $bracketSet);

function isValid(string $s, $brackets)
{
    $sClear = ClearString($s, $brackets);
    $sLength = strlen($sClear);

    if ($sLength % 2 !== 0 || $sClear == '') {
        WriteBD(0, $s);
        return false;
    };

    $bracketStack = [];

    for ($i = 0; $i < $sLength; $i++) {
        if (array_key_exists($sClear[$i], $brackets)) {
            $bracketStack[] = $brackets[$sClear[$i]];
        } elseif (array_pop($bracketStack) !== $sClear[$i]) {
            WriteBD(0, $s);
            return false;
        }
    }
    if (count($bracketStack) === 0) {
        WriteBD(1, $s);
    } else {
        WriteBD(0, $s);
        return false;
    }

}

function ClearString($s, $brackets): string
{
    $clearArr = [];
    $stringArr  = str_split(str_replace(' ', '', $s));
    foreach ($stringArr as $char){
        if(array_key_exists($char, $brackets) || in_array($char, $brackets))
        {
            $clearArr[] = $char;
        }
        else{
            continue;
        }
    }
    return implode('', $clearArr);;
}

function WriteBD($result, $initialLine){
    global $pdo;
    $sth = $pdo->prepare("INSERT INTO `results` SET `result` = :result, `time` = :time, `initialLine` = :initialLine ");
    $sth->execute(array('result' => $result, 'time' => date("Y-m-d H:i:s"), 'initialLine' => $initialLine));
    echo addData();
}

function addData() {
    global $pdo;
    $sth = $pdo->prepare("SELECT * FROM `results` ORDER BY `time`");
    $sth->execute();
    $list = $sth->fetchAll(PDO::FETCH_ASSOC);

    $html = '';
    foreach ($list as $row) {
        $html .= '<tr>';
        $html .= '<th scope="row">' . $row['id'] . '</th>';
        $html .= '<td>' . ($row['result'] ? 'Верное выражение' : 'Неверное выражение') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['initialLine'], ENT_QUOTES, 'UTF-8') . '</td>';
        $html .= '<td>' . $row['time'] . '</td>';
        $html .= '</tr>';
    }

    return $html;
}

