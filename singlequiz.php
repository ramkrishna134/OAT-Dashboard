<?php
error_reporting(0);
$quizId = $_GET["id"];
$url = 'http://13.67.92.237:9092/quiz/quizById?quizId='.$quizId; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$quiz = json_decode($data); // decode the JSON feed
$countschool= count($quiz->schoolList);
?>

<?php $schoolList = $quiz->schoolList;

$schools = [];
$countschool = count($quiz->schoolList);  // 2
for ($i = 0; $i < $countschool; $i++) {
    $school = $quiz->schoolList[$i];
    array_push($schools, ['y' => $school->totalScore, 'label' =>"Total Score-".$school->schoolName]);

}
$dataPoints = $schools;

?>
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
    <title><?php echo $quiz->quiz->name?> - OTA Dashboard</title>
</head>
<body>

<div class="page-content">
    <div class="side-bar">
        <h3 class="p-1 text-center d-none d-sm-block">OTA Dashboard</h3>
        <hr>

        <div class="side-menu">
            <a href="/" class="btn btn-outline-primary d-block text-white"><i class="fas fa-list-ul"></i> <span>List of Quiz</span></a>
        </div>
    </div>
    <div class="main-content">
        <div class="breadcrumb sticky-top">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-3">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $quiz->quiz->name?></li>
                </ol>
            </nav>
        </div>

        <?php
        $students = [];
        $countschool= count($quiz->schoolList);
        for($i=0; $i<$countschool; $i++){
            $school = $quiz->schoolList[$i];
            $studentList= count($school->studentList);
            for ($j=0; $j<$studentList; $j++){
                $student = $school->studentList[$j];
                array_push($students, $student);
            }
        }
        ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12">

                    <div class="quiz-content px-0 px-sm-5 py-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="text-white mt-2 font-weight-bold"><?php echo $quiz->quiz->name?></h2>
                                <p class="text-white"><?php echo $quiz->quiz->text;?></p>
                                <hr>
                            </div>
                            <div class="col-sm-3">
                                <div class="card-body counter mb-3 shadow rounded">
                                    <h4><i class="fas fa-university text-primary"></i> Total Number School</h4>
                                    <h2><span class="badge bg-primary"><?php echo $countschool?></span></h2>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card-body counter mb-3 shadow rounded">
                                    <h4><i class="fas fa-user-graduate text-primary"></i> Total Number Student</h4>
                                    <h2><span class="badge bg-primary"><?php echo count($students);?></span></h2>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card counter shadow mb-3 rounded">
                                    <div class="card-header">
                                        <h4 class="mb-0"><i class="fas fa-university text-primary"></i> Participating Schools</h4>
                                    </div>
                                    <div class="card-body height-300">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>School Name</th>
                                                    <th>Total Score</th>
                                                    <th>Obtained Score</th>
                                                    <th>No Of Student</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($schoolList as $school):?>
                                                    <tr>
                                                        <th><?php echo $school->schoolName;?></th>
                                                        <td><span class="text-success"><?php echo $school->totalScore;?></span></td>
                                                        <td><span class="text-danger"><?php echo $school->obtainedScore;?></span></td>
                                                        <td><?php echo count($school->studentList);?></td>
                                                    </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card counter shadow mb-3 rounded">
                                    <div class="card-header">
                                        <h4 class="mb-0"><i class="fas fa-university text-primary"></i> Schools Chart</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chartContainer" style="height: 270px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card counter shadow mb-3 rounded">
                                    <div class="card-header">
                                        <h4 class="mb-0"><i class="fas fa-user-graduate text-primary"></i> Participating Students</h4>
                                    </div>

                                    <div class="card-body height-400 mb-3">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Nick Name</th>
                                                    <th>Full Name</th>
                                                    <th>School Name</th>
                                                    <th>Class</th>
                                                    <th>Total Score</th>
                                                    <th>obtained Score</th>
                                                    <th>Quiz Details</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach($students as $student):?>
                                                    <tr>
                                                        <td><?php echo $student->nickname;?></td>
                                                        <td><?php echo $student->firstName. $student->lastName;?></td>
                                                        <td><?php echo $student->studentSchool;?></td>
                                                        <td><?php echo $student->studentClass;?></td>
                                                        <td><span class="text-success"><?php echo $student->totalScore;?></span></td>
                                                        <td><span class="text-danger"><?php echo $student->obtainedScore;?></span></td>
                                                        <td>
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#Modal_<?php echo $student->nickname?>" class="btn btn-primary btn-sm">View Details</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php foreach($students as $student):?>
<!-- Modal -->
<div class="modal fade" id="Modal_<?php echo $student->nickname?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content counter">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $student->firstName. $student->lastName;?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Quiz Category List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Total Score</th>
                            <th>Obtained Score</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $categories = $student->quizCategoryList;
                        foreach($categories as $category):
                            ?>
                            <tr>
                                <td><?php echo $category->categoryName; ?></td>
                                <td class="text-success"><?php echo $category->totalScore;?></td>
                                <td class="text-danger"><?php echo $category->obtainedScore;?></td>
                            </tr>
                        <?php endforeach;?>

                        </tbody>
                    </table>
                </div>

                <h4>Quiz Questions</h4>
                <?php
                $questions = [];
                $countsquiz= count($student->quizCategoryList);
                for($i=0; $i<$countsquiz; $i++){
                    $category = $student->quizCategoryList[$i];
                    $questionList= count($category->quizQuestionList);

                    for ($j=0; $j<$questionList; $j++){
                        $question = $category->quizQuestionList[$j];
                        array_push($questions, $question);
                    }
                };

//                var_dump($questions);
                ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Points</th>
                            <th>Obtained Score</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach($questions as $question):;?>
                            <tr>
                                <td><?php echo $question->title;?></td>
                                <td><?php echo $question->points;?></td>
                                <td class="text-success"><?php echo $question->obtainedScore;?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>



<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "School Score Chart"
            },
            axisY:{
                includeZero: true
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>
</body>
</html>
