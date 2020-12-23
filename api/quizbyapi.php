<?php
error_reporting(0);
$url = 'http://13.67.92.237:9092/quiz/quizById?quizId=25'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$values = json_decode($data); // decode the JSON feed
$countschool= count($values->schoolList);
echo "Total Schools:".$countschool;
echo "<br>";
for($i=0; $i<=$countschool; $i++)
{
    $countstudent= count($values->schoolList[$i]->studentList);
    echo $values->schoolList[$i]->schoolName;
    echo "<br>";
  //  echo $countss;
    for ($j=0; $j<=$countstudent; $j++)
    {
        $countquizcat= count($values->schoolList[$i]->studentList[$j]->quizCategoryList);
        //echo $countquizcat;
        echo  $values->schoolList[$i]->studentList[$j]->firstName;
        echo "<br>";
        for($k=0; $k<=$countquizcat; $k++)
        {
            $countques= count($values->schoolList[$i]->studentList[$j]->quizCategoryList[$k]->quizQuestionList);
            echo  $values->schoolList[$i]->studentList[$j]->quizCategoryList[$k]->categoryName;
            echo "<br>";
            for($l=0; $l<=$countques; $l++)
            {
                echo  $values->schoolList[$i]->studentList[$j]->quizCategoryList[$k]->quizQuestionList[$l]->title;
                echo "<br>";
            }
        }

    } 
}


?>