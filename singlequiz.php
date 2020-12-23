<?php
error_reporting(0);
$quizId = $_GET["id"];
$url = 'http://13.67.92.237:9092/quiz/quizById?quizId='.$quizId; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$quiz = json_decode($data); // decode the JSON feed
$countschool= count($quiz->schoolList);
//echo "Total Schools:".$countschool;
//echo "<br>";
//for($i=0; $i<=$countschool; $i++)
//{
//    $countstudent= count($values->schoolList[$i]->studentList);
//    echo $values->schoolList[$i]->schoolName;
//    echo "<br>";
//    //  echo $countss;
//    for ($j=0; $j<=$countstudent; $j++)
//    {
//        $countquizcat= count($values->schoolList[$i]->studentList[$j]->quizCategoryList);
//        //echo $countquizcat;
//        echo  $values->schoolList[$i]->studentList[$j]->firstName;
//        echo "<br>";
//        for($k=0; $k<=$countquizcat; $k++)
//        {
//            $countques= count($values->schoolList[$i]->studentList[$j]->quizCategoryList[$k]->quizQuestionList);
//            echo  $values->schoolList[$i]->studentList[$j]->quizCategoryList[$k]->categoryName;
//            echo "<br>";
//            for($l=0; $l<=$countques; $l++)
//            {
//                echo  $values->schoolList[$i]->studentList[$j]->quizCategoryList[$k]->quizQuestionList[$l]->title;
//                echo "<br>";
//            }
//        }
//
//    }
//}
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
    <title><?php echo $quiz->quiz->name?> - OTA Dashboard</title>
</head>
<body>
<?php //var_dump($quiz)?>

<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="quiz-content bg-dark p-5 rounded">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h3><i class="fas fa-university text-success"></i> Total Number School</h3>
                                    <h2><span class="badge bg-primary"><?php echo $countschool?></span></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="mb-0">List Of Schools</h4>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <?php $schoolList = $quiz->schoolList;?>
                                        <?php
                                        foreach ($schoolList as $school):
                                            ?>
                                            <li><?php echo $school->schoolName; ?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-university text-success"></i> School Data</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
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
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fas fa-user-graduate text-primary"></i> Student Data</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                        $students = [];
                                        $countschool= count($quiz->schoolList);
                                        for($i=0; $i<=$countschool; $i++){
                                            $school = $quiz->schoolList[$i];
                                            $studentList= count($school->studentList);
                                            for ($j=0; $j<=$studentList; $j++){
                                                $student = $school->studentList[$j];
                                                array_push($students, $student);
                                            }
                                        }
                                        ?>

                                        <table class="table table-striped">
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
                                            <?php foreach($students as $student):
                                            ?>
                                            <tr>
                                                <td><?php echo $student->nickname;?></td>
                                                <td><?php echo $student->firstName. $student->lastName;?></td>
                                                <td><?php echo $student->studentSchool;?></td>
                                                <td><?php echo $student->studentClass;?></td>
                                                <td><span class="text-success"><?php echo $student->totalScore;?></span></td>
                                                <td><span class="text-danger"><?php echo $student->obtainedScore;?></span></td>
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



</body>
</html>
