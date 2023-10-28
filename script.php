<?php
require('connect.php');

$bracketSet = ['(' => ')', '[' => ']', '{' => '}', '<' => '>'];

if (isset($_POST['getHTML'])) {
    $htmlTable = GenHTML(GetData());
    echo $htmlTable;
}

$name = $_POST['name'];
if(isValid($name, $bracketSet)){
    WriteBD(1, $name);
} else {
    WriteBD(0, $name);
}
echo $htmlTable = GenHTML(GetData());

function isValid(string $s, array $brackets) : bool
{
    $sClear = ClearString($s, $brackets);
    $sLength = strlen($sClear);

    if ($sLength % 2 !== 0 || $sClear == '') {
        return false;
    };

    $bracketStack = [];

    for ($i = 0; $i < $sLength; $i++) {
        if (array_key_exists($sClear[$i], $brackets)) {
            $bracketStack[] = $brackets[$sClear[$i]];
        } elseif (array_pop($bracketStack) !== $sClear[$i]) {
            return false;
        }
    }
    return count($bracketStack) === 0;
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
}

function GetData() {
    global $pdo;
    $sth = $pdo->prepare("SELECT * FROM `results` ORDER BY `time` DESC ");
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function GenHTML($data) {
    $html = '';
    foreach ($data as $str => $row) {
        $backgroundStyle = $row['result'] ? 'green' : 'red';
        $html .= '<tr' . ($str === 0 ? ' style="background-color:'. $backgroundStyle .'"' : '') . '>';
        $html .= '<th scope="row">' . $row['id'] . '</th>';
        $html .= '<td>' . ($row['result'] ? 'Верное выражение' : 'Неверное выражение') . '</td>';
        $html .= '<td>' . htmlspecialchars($row['initialLine'], ENT_QUOTES, 'UTF-8') . '</td>';
        $html .= '<td>' . $row['time'] . '</td>';
        $html .= '</tr>';
    }
    return $html;
}


