<?php 
// SEARCH 
include "connection.php";
$search = $_POST['search'];

$records_per_page = 5;
$page = '';
$output = '';

if(isset($_POST["page"])){
  $page = $_POST["page"];
}
else{
  $page = 1;
}
$start_from = ($page - 1)*$records_per_page;


$query = "SELECT * FROM course INNER JOIN professor ON course.professor_id = professor.professor_id 
INNER JOIN department ON course.department_id = department.department_id
 WHERE REPLACE(course_name,' ','') LIKE '%$search%' OR REPLACE(course_description,' ','') LIKE '%$search%' 
 OR REPLACE(professor_name,' ','') LIKE '%$search%' 
 OR REPLACE(department_name,' ','') LIKE '%$search%' 
 ORDER BY course_id ASC LIMIT $start_from,$records_per_page";

$search_query = mysqli_query($conn,$query);

if(!$search_query){
    die('QUERY FAILED' . mysqli_error($conn));
} 

while($row = mysqli_fetch_array($search_query)){
    $course_name = $row['course_name'];
    $course_description = $row['course_description'];
    $professor_name = $row['professor_name'];
    $department_name = $row['department_name'];
    $output .= "
    <li>Course name: {$course_name }</li>
    <li>Course description: {$course_description}</li>
    <li>Professor name: {$professor_name}</li>
    <li>Department name: {$department_name}</li>
     <hr>
    ";
}
$page_query ="SELECT * FROM course INNER JOIN professor ON course.professor_id = professor.professor_id 
INNER JOIN department ON course.department_id = department.department_id
 WHERE REPLACE(course_name,' ','') LIKE '%$search%' OR REPLACE(course_description,' ','') LIKE '%$search%' 
 OR REPLACE(professor_name,' ','') LIKE '%$search%' 
 OR REPLACE(department_name,' ','') LIKE '%$search%' 
 ORDER BY course_id ASC";

$page_result = mysqli_query($conn,$page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$records_per_page);
for($i=1; $i<=$total_pages; $i++){
  $output .= "<span class='pagination_linkk' style ='cursor:pointer; 
  padding:6px; background: ivory; border:2px solid royalblue;' id='".$i."'>".$i."</span>";
}
echo $output;

?>
