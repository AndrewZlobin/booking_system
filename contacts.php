<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=hotel', 'user', 'user');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$sth = $dbh->prepare("SELECT * from requests");
$sth->execute();
$results = $sth->fetchAll(\PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Contacts!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/leave-contacts.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800&display=swap&subset=cyrillic" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <h2 class="text-warning col-auto">Оставьте заявку, чтобы мы могли сделать Вам лучшее предложение!</h2>
    </div>
    <form>
        <div class="row">
            <div class="col-4">
                <label for="personal_data" class="col-4 col-form-label">Ваше Ф.И.О.</label>
                <input type="text" class="form-control" id="personal_data" name="personal_data" placeholder="Например: Иванов И.И." required>
            </div>
            <div class="col-4">
                <label for="contacts" class="col-4 col-form-label">Номер телефона</label>
                <input type="text" id="contacts" name="contacts" class="form-control item" placeholder="+7(000) 000-00-00" required>
            </div>
            <div class="col-4">
                <label for="comment" class="col-4 col-form-label">Комментарий (необязательно)</label>
                <input type="text" class="form-control" id="comment" name="comment">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <button type="submit" class="btn btn-warning btn-lg btn-block">Оставить заявку</button>
            </div>
        </div>
    </form>
</div>

<div class="row justify-content-left">
    <h2 class="text-dark col-auto">Посмотрите, сколько заявок нам уже оставили!</h2>
</div>

<div class="row">
        <?php foreach ($results as $result): ?>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <?php echo $result['personal_data']; ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $result['contacts']; ?></h5>
                    <?php if ($result['comment'] == null): ?>
                        <p class="card-text">Комментарий не оставляли</p>
                    <?php else: ?>
                        <p class="card-text"><?php echo $result['comment']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!--<script src="js/typed.js" type="text/javascript"></script>-->
<script src="js/script.js" type="text/javascript"></script>
</body>
</html>