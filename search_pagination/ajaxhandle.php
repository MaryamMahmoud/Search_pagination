<?php 
// TABLE OF COURSES
include "connection.php";
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
ORDER BY course_id ASC LIMIT $start_from,$records_per_page";

$result = mysqli_query($conn,$query);
$output .= "
<table class = 'table table-bordered'>
<tr>
<th width='40'%>Course<br>name</th>
                <th width='40%'>Course description</th>
                <th width='40%'>Professor name </th>
                <th width='40%'>Department name </th>
            </tr>
";
while($row = mysqli_fetch_array($result)){
  $output .= '
  <tr>
    <td>'.$row["course_name"].'</td>
    <td>'.$row["course_description"].'</td>
    <td>'.$row["professor_name"].'</td>
    <td>'.$row["department_name"].'</td>
  </tr>
  ';
}
$output .= '</table><br /><div align="center">';
$page_query ="SELECT * FROM course INNER JOIN professor ON course.professor_id = professor.professor_id 
INNER JOIN department ON course.department_id = department.department_id 
ORDER BY course_id ASC";

$page_result = mysqli_query($conn,$page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$records_per_page);
for($i=1; $i<=$total_pages; $i++){
  $output .= "<span class='pagination_link' style ='cursor:pointer; 
  padding:12px; background: ivory; border:2px solid royalblue;' id='".$i."'>".$i."</span>";
}
echo $output;

?>  