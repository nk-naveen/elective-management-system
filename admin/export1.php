

<?php
session_start();
include('includes/config.php');
$query = "select * from students s,courseenrolls ce,course c where c.id=ce.course1 and ce.studentRegno=s.StudentRegno ";
 $result = mysqli_query($bd, $query);
?>
<html>  
 <head>  
   
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 </head>  
 <body>  
  <div class="container">  
   <br />  
   <br />  
   <br />  
   <div class="table-responsive">  
    <br /> 
    <table class="table table-bordered">
      <tr>  
          <th>studentRegno</th>  
          <th>uid</th>  
          <th>Elective 1&3</th>  
        
          <th>semester</th>
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))
  {
   echo '
    <tr>  
        <td>'.$row["studentRegno"].'</td>  
        <td>'.$row["pincode"].'</td>  
        <td>'.$row["courseName"].'</td>  

       <td>'.$row["semester"].'</td>
                    </tr>
   ';
  }
     ?>
    </table>
    <br />
    <form method="post" action="excel.php">
     <input type="submit" name="export" class="btn btn-success" value="Export to excel" />
    </form>
   </div>  
  </div>  
 </body>  
</html>