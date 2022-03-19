<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit'])){
    $file=$_FILES['doc']['tmp_name'];
    
    $ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
    if($ext=='xlsx'){

        require('PHPExcel/PHPExcel.php');
        require('PHPExcel/PHPExcel/IOFactory.php');
        
        
        $obj=PHPExcel_IOFactory::load($file);
        foreach($obj->getWorksheetIterator() as $sheet){
            $getHighestRow=$sheet->getHighestRow();
            for($i=0;$i<=$getHighestRow;$i++){
                $StudentRegno =$sheet->getCellByColumnAndRow(0,$i)->getValue();
                $password=$sheet->getCellByColumnAndRow(1,$i)->getValue();
                $studentName=$sheet->getCellByColumnAndRow(2,$i)->getValue();
                $pincode=$sheet->getCellByColumnAndRow(3,$i)->getValue();
                $semester=$sheet->getCellByColumnAndRow(4,$i)->getValue();
               
                if($studentName!=''){
                    mysqli_query($bd,"insert into students(StudentRegno,password,studentName,pincode,semester) values('$StudentRegno','$password','$studentName','$pincode','$semester')");
                }
            }
        }
    }else{
        echo "Invalid file format";
    }
      } 

    if(isset($_GET['del']))
      {
              mysqli_query($bd, "delete from students where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Student deleted !!";
      }  
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | student</title>
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
 <br>
 <div  align="center" style="color: white;">
                           <h3 >Register students</h3> 
                        
   <div align="center"><form method="post" enctype="multipart/form-data">
    <input type="file" name="doc" style="color: green;" />
    <div align="center"><input type="submit" name="submit"/></div>
</form>
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">student details</h1>
                    </div>
                </div>
                <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registered students
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr><th><div align="center">#</div></th>
                                            <th><div align="center">Reg No</div></th>
                                            <th><div align="center">Student Name </div></th>
                                            <th><div align="center">UID</div></th>
                                            <th><div align="center">Reg Date</div></th>
                                            
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select * from students");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['StudentRegno']);?></td>
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['pincode']);?></td>
                                            <td><?php echo htmlentities($row['creationdate']);?></td>
                                            <td>              
 <a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button>
</a>
<!--
<a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&pass=update" onClick="return confirm('Are you sure you want to reset password?')">
<button type="submit" name="submit" id="submit" class="btn btn-default">Reset Password</button>
</a>
                                            </td> -->
                                        </tr>
<?php 
$cnt++;
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
    
  <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
