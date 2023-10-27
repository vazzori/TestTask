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
<div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="success-alert" style="position: fixed; bottom: 20px; right: 20px; width: 500px">
    Данные успешно записаны в базу данных.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container" style="">
    <div class="d-flex align-items-center justify-content-center" style="height:50vh;">
        <form class="form" id="myForm">
            <div class="row">
                <div class="col">
                    <input class="form-control" type="text" id="name" value="" placeholder="Введите строку"/>
                </div>
                <div class="col">
                    <input class="btn btn-outline-light" type="submit" value="Отправить" id="btn_submit" />
                </div>
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
        <tbody id="resultTable">
        <?php
        $sth = $pdo->prepare("SELECT * FROM `results` ORDER BY `time`");
        $sth->execute();
        $list = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($list as $row): ?>
        <tr>
            <th scope="row"><?php echo $row['id'] ?></th>
            <td><?php
                echo ($row['result'])? 'Верное выражение' : 'Неверное выражение';
                ?></td>
            <td><?php echo htmlspecialchars($row['initialLine'], ENT_QUOTES, 'UTF-8'); ?></td>
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
        $('#myForm').submit(function(e) {
            e.preventDefault();
            var user_name = $('#name').val();
            $.ajax({
                url: "script.php",
                type: "post",
                data: {
                    "name": user_name,
                },
                success: function(data) {
                    $('#name').val('');
                    $('#resultTable').html(data);
                    $('#success-alert').removeClass('d-none');
                    setTimeout(function() {
                        $('#success-alert').addClass('d-none');
                    }, 3000);

                }
            });

        });
    });
</script>
</body>
</html>