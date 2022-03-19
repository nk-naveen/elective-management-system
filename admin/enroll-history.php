<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enroll History</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
  
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>

    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Enroll History  </h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Elective 1 & 3 Enroll History
                        </div>
                      
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><div align="center">#</div></th>
                                            <th><div align="center">Student Reg. No</div> </th>
                                            <th><div align="center">Student Name</div></th>
                                            <th><div align="center">Course</div></th>
                                                <th><div align="center">Semester</div></th>
                                                
                                             <th><div align="center">Enrollment Date</div></th>
                                             <th><div align="right"><a href="export1.php?id=<?php echo $pcid; ?>" target="_blank">
                                            <button class="btn btn-primary"><i class="fa fa-print "></i> Export</button> </a></th>
                                            <th><div align="right"><a href="print1.php?id=<?php echo $pcid; ?>" target="_blank">
                                            <button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> </a></th>
                                             <!-- <th><div align="center">Action</div></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$un=$_SESSION['alogin'];
$sl=0;
$sql=mysqli_query($bd, "select * from students s,courseenrolls ce,course c where c.id=ce.course1 and ce.studentRegno=s.StudentRegno ");
while($row=mysqli_fetch_array($sql))
{
    $sl++;
    $pcid=$row['course1'];
?>

                                        <tr>

                                            <td><div align="center"><?php echo $sl;?></div></td>
                                            <td><div align="center"><?php echo $row['StudentRegno'];?></div></td>
                                            
                                            <td><div align="center"><?php echo $row['studentName'];?></div></td>

                                            <td><div align="center"><?php echo $row['courseName'];?></div></td>
                                            
                                            <td><div align="center"><?php echo $row['semester'];?></div></td>
                                           
                                             <td><div align="center"><?php echo $row['enrollDate'];?></div></td>
                                            <td><div align="center">
                                            <!--                                      
 <a href="print.php?id=<?php echo $row['cid']?>a" target="_blank">
<button class="btn btn-primary"><i class="fa fa-print "></i> edit</button> </a>  </div>                                      




                                            </td>-->  

                                            
                                        </tr>
<?php 
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                       
                   </br>

                    <div class="panel panel-default">
                        <div class="panel-heading">Elective 2 & 4  Enroll History</th>
                           
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><div align="center">#</div></th>
                                            <th><div align="center">Student Reg. No</div> </th>
                                            <th><div align="center">Student Name</div></th>
                                            <th><div align="center">Course</div></th>
                                                <th><div align="center">Semester</div></th>
                                                
                                             <th><div align="center">Enrollment Date</div></th>
                                             <th><div align="right"><a href="export2.php?id=<?php echo $pcid; ?>" target="_blank">
<button class="btn btn-primary"><i class="fa fa-print "></i> Export</button> </a></th>
 <th><div align="right"><a href="print2.php?id=<?php echo $pcid; ?>" target="_blank">
                                            <button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> </a></th>
                                              
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$un=$_SESSION['alogin'];
$sl=0;
$sql=mysqli_query($bd, "select * from students s,courseenrolls ce,course c where c.id=ce.course2 and ce.studentRegno=s.StudentRegno ");
while($row=mysqli_fetch_array($sql))
{
    $sl++;
?>


                                        <tr>
                                            <td><div align="center"><?php echo $sl;?></div></td>
                                            <td><div align="center"><?php echo $row['StudentRegno'];?></div></td>
                                            
                                            <td><div align="center"><?php echo $row['studentName'];?></div></td>

                                            <td><div align="center"><?php echo $row['courseName'];?></div></td>
                                            
                                            <td><div align="center"><?php echo $row['semester'];?></div></td>
                                           
                                             <td><div align="center"><?php echo $row['enrollDate'];?></div></td>
                                             <td><div align="center">
                                                                                    
 <!--<a href="editele.php?id=<?php echo $row['cid']?>a" target="_blank">
<button class="btn btn-primary"><i class="fa fa-print "></i> edit</button> </a>  </div>                                      




                                            </td>-->  

                                            
                                        </tr>
<?php 
} ?>

                                        
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
   
  <?php include('includes/footer.php');?>
   
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
