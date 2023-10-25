<?php global $pdo;
require('connect.php');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Привет, мир!</title>
</head>
<body style="background: #280045; color: whitesmoke;">

<div class="container" style="">
    <div class="d-flex align-items-center justify-content-center" style="height:50vh;">
        <form class="form">
            <div class="row">
                <div class="col">
                    <input class="form-control" type="text" id="name" value="" placeholder="Введите строку"/>
                </div>
                <div class="col">
                    <input class="btn btn-outline-light" type="button" value="Отправить" id="btn_submit" />
                </div>
        </form>
    </div>
</div>
<div class="container ">
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Результат</th>
            <th scope="col">Введеная строка</th>
            <th scope="col">Дата</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sth = $pdo->prepare("SELECT * FROM `results` ORDER BY `time`");
        $sth->execute();
        $list = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($list as $row): ?>
        <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['result']; ?></td>
            <td><?php echo $row['initialLine']; ?></td>
            <td><?php echo $row['time']; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#btn_submit').click(function(){

            var user_name    = $('#name').val();

            $.ajax({
                url: "script.php",
                type: "post",
                data: {
                    "name":    user_name,
                }
            });
            $('#name').val('');
        });
    });
</script>
</body>
</html>