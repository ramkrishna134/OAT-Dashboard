<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>OTA Dashboard</title>
</head>
<body>

<?php @include('api/quizapi.php') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <?php
            foreach($values as $value):
            ?>
            <div class="alert alert-primary" role="alert">
                <a href="/singlequiz.php?id=<?php echo $value->id;?>"><?php echo $value->name;?></a>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>



</body>
</html>