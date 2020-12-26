<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>OTA Dashboard</title>
</head>
<body>

<?php @include('api/quizapi.php') ?>

<div class="page-content">
    <div class="side-bar">
        <h3 class="p-1 text-center d-none d-sm-block">OTA Dashboard</h3>
        <hr>

        <div class="side-menu">
            <a href="/" class="btn btn-primary d-block text-left"><i class="fas fa-list-ul"></i> <span>List of Quiz</span></a>
        </div>
    </div>
    <div class="main-content">
        <div class="breadcrumb sticky-top">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-3">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                </ol>
            </nav>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <h2 class="text-white mt-2 font-weight-bold">Dashboard</h2>
                    <hr>

                    <div class="quiz-content px-0 px-sm-5 py-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card-body counter mb-3 shadow rounded">
                                    <h4><i class="fas fa-list-ul text-primary"></i> Total Number Quiz</h4>
                                    <h2><span class="badge bg-primary"><?php echo $countquiz?></span></h2>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-7">

                                <h3 class="text-white">Quizes</h3>

                                <ul>
                                    <?php
                                    foreach($values as $value):
                                        ?>
                                        <li>
                                            <a href="/singlequiz.php?id=<?php echo $value->id;?>" class="rounded"><i class="fas fa-angle-right mr-2"></i> <?php echo $value->name;?></a>
                                        </li>
                                    <?php endforeach;?>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>