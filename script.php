<?php
require('connect.php');

if(isset($_GET['is-valid']) && isset($_GET['value'])){
    isValid($_GET['value']);
    header('Location: /index.php');
}else{
    $name = $_POST['name'];
    isValid($name);
}

function isValid(string $s): bool {
    $sClear = ClearString($s);
    $sLength = strlen($sClear);

    if($sClear == ''){
        WriteBD('false', $s);
        return false;
    }

    $bracketSet = ['(' => ')', '[' => ']', '{' => '}', '<' => '>'];
    $bracketStack = [];

    for ($i = 0; $i < $sLength; $i++) {
        if (array_key_exists($sClear[$i], $bracketSet)) {
            $bracketStack[] = $bracketSet[$sClear[$i]];
        } elseif (array_pop($bracketStack) !== $sClear[$i]) {
            WriteBD('false', $s);
            return false;
        }
    }
    WriteBD('true', $s);
    return count($bracketStack) === 0;
}

function ClearString($s): string{
    $clearArr = [];
    $stringArr  = str_split(str_replace(' ', '', $s));
    foreach ($stringArr as $char){
        if($char == '(' || $char == '[' || $char == '{' || $char == '<' || $char == ')' || $char == ']' || $char == '}' || $char == '>')
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
