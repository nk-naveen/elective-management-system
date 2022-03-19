<?php
session_start();
include('includes/config.php');


$output = '';
if(isset($_POST["export"]))
{
 $query = "select * from students s,courseenrolls ce,course c where c.id=ce.course2 and ce.studentRegno=s.StudentRegno ";
 $result = mysqli_query($bd, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
  <table class="table" bordered="1"> 

   <tr>  
                         <th>studentRegno</th>  
                         <th>UID</th>  
                         <th>Elective2</th>  
       
       <th>semester</th>
                    </tr> ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                          <td>'.$row["studentRegno"].'</td>  
                         <td>'.$row["pincode"].'</td>  
                         <td>'.$row["courseName"].'</td>  
        
       <td>'.$row["semester"].'</td>
                    </tr> ';
  }
  $output .= '</table>';
  header('Content-type: application/vnd.ms-excel;');
  header('Content-Disposition: attachment; filename=Elective2.xls');
  echo $output;
 }
}

?>
