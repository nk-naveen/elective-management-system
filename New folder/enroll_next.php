<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0 or strlen($_SESSION['pcode'])==0)
    {   
header('location:index.php');
}


$studentregno=$_POST['studentregno'];
$pincode=$_POST['Pincode'];

$sem=$_POST['sem'];



//$ret=mysqli_query($bd, "insert into courseenrolls(studentRegno,pincode,level,course,semester) values('$studentregno','$pincode','$level','$course','$sem')");

/*if($ret)
{
$_SESSION['msg']="Enroll Successfully !!";
}
else
{
  $_SESSION['msg']="Error : Not Enroll";
}*/

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Course Enroll</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course Enroll </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Course Enroll
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>



                        <div class="panel-body">
                       <form method="post" action="enroll_next2.php">
                         
                          <input type="hidden" name="regno" value="<?php echo $studentregno;?>">
                          <input type="hidden" name="pincode" value="<?php echo $pincode;?>">
                          <input type="hidden" name="sem" value="<?php echo $sem;?>">
                          
                         
                                  <?php
								   if($sem=="1")
								   {
								      $sem="semester2";
								   ?>
   									
                                    <table class="table">
                                      <tr>
                                      <td> Elective 1 </td>
                                      <td> Preferences</td>
                                      </tr>
                                      <?php
									  $i=1;
									  $ss="select * from course where semester='$sem'";
									  $rs=mysqli_query($bd,$ss);
									  while($row=mysqli_fetch_array($rs))
									  {
									  ?>
                                      <tr>
                                      <td> <input type="text" value="<?php echo $row['courseName'];?>" name="<?php echo "c".$i?>"> </td>
                                       <td> <input type="number" name="<?php echo "p".$i?>" min="1" max="5"> </td>
                                      </tr>
                                      <?php
									  $i++;
									  }
									  ?>
                                    
                                    </table>
                                    <?php
									
									?>
                                    
                                    
                                   
   									
                                    <table class="table">
                                      <tr>
                                      <td> Elective 2 </td>
                                      <td> Preferences</td>
                                      </tr>
                                      <?php
									  $i=1;
									  $ss="select * from course where semester='$sem'";
									  $rs=mysqli_query($bd,$ss);
									  while($row=mysqli_fetch_array($rs))
									  {
									  ?>
                                      <tr>
                                      <td> <input type="text" value="<?php echo $row['courseName'];?>" name="<?php echo "c".$i?>"> </td>
                                       <td> <input type="number" name="<?php echo "p".$i?>" min="1" max="5"> </td>
                                      </tr>
                                      <?php
									  $i++;
									  }
									  ?>
                                    
                                    </table>
                                    <?php
									
									} ?>


  <?php
                   if($sem=="2")
                   {
                      $sem="semester3";
                   ?>

                   <table class="table">
                                      <tr>
                                      <td> Elective 3 </td>
                                      <td> Preferences</td>
                                      </tr>
                                      <?php
                    $i=1;
                    $ss="select * from course where semester='$sem'";
                    $rs=mysqli_query($bd,$ss);
                    while($row=mysqli_fetch_array($rs))
                    {
                    ?>
                                      <tr>
                                      <td> <input type="text" value="<?php echo $row['courseName'];?>" name="<?php echo "c".$i?>"> </td>
                                       <td> <input type="number" name="<?php echo "p".$i?>" min="1" max="5"> </td>
                                      </tr>
                                      <?php
                    $i++;
                    }
                    ?>
                                    
                                    </table>
                                    <?php
                  
                  ?>
                                    
                                    
                                   
                    
                                    <table class="table">
                                      <tr>
                                      <td> Elective 4</td>
                                      <td> Preferences</td>
                                      </tr>
                                      <?php
                    $i=1;
                    $ss="select * from course where semester='$sem'";
                    $rs=mysqli_query($bd,$ss);
                    while($row=mysqli_fetch_array($rs))
                    {
                    ?>
                                      <tr>
                                      <td> <input type="text" value="<?php echo $row['courseName'];?>" name="<?php echo "c".$i?>"> </td>
                                       <td> <input type="number" name="<?php echo "p".$i?>" min="1" max="5"> </td>
                                      </tr>
                                      <?php
                    $i++;
                    }
                    ?>
                                    
                                    </table>
                                    <?php
                  
                 } ?>

 <button type="submit" name="FormSubmit" id="submit" class="btn btn-default">Enroll</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>

            </div>






        </div>
    </div>
  <?php include('includes/footer.php');?>



</body>
</html>

