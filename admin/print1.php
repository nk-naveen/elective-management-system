<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Print</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="print.css" media="print">
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <br><br>
      <h2 align="center">Elective 1&3 Enrolled list</h2>
      <br>
      <table class="table table-bordered print">
        <thead>
          <tr>
            <th>sl.no</th>
            <th>studentRegno</th>  
          <th>uid</th>  
          <th>Elective1&3</th>  
        
          <th>semester</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sn=1;
          $user_qry="select * from students s,courseenrolls ce,course c where c.id=ce.course1 and ce.studentRegno=s.StudentRegno ";
          $user_res=mysqli_query($bd,$user_qry);
          while($user_data=mysqli_fetch_assoc($user_res))
          {
          ?>
          <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $user_data['studentRegno']; ?></td>
            <td><?php echo $user_data['pincode']; ?></td>
            <td><?php echo $user_data['courseName']; ?></td>
            <td><?php echo $user_data['semester']; ?></td>
          </tr>
          <?php
          $sn++;
          }
          ?>
        </tbody>
      </table>

      <div class="text-center">
        <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>





























