<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0 or strlen($_SESSION['pcode'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$studentregno=$_POST['studentregno'];
$pincode=$_POST['Pincode'];
$course1 = $_POST['course1'];
$course2=$_POST['course2'];
$sem=$_POST['semester'];
$ret=mysqli_query($bd, "insert into courseenrolls(studentRegno,pincode,course1,course2,semester) values('$studentregno','$pincode','$course1','$course2','$sem')");
if($ret)
{
//$_SESSION['msg']="Enroll Successfully !!";
    echo'<script>alert("Successfully Enrolled");document.location="pincode-verification.php";</script>';
}
else
{
  $_SESSION['msg']="Error : Not Enroll";
}
}
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
<?php $sql=mysqli_query($bd, "select * from students where StudentRegno='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>

                        <div class="panel-body">
                    <?php $sm=$_REQUEST['sm']; ?>
                       <form name="dept" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $sm; ?>" name="semester">
   <div class="form-group">
    <label for="studentname">Student Name  </label>
    <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>"  />
  </div>

 <div class="form-group">
    <label for="studentregno">Student Reg No   </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']);?>"  placeholder="Student Reg no" readonly />
    
  </div>



<div class="form-group">
    <label for="Pincode">Pincode  </label>
    <input type="text" class="form-control" id="Pincode" name="Pincode" readonly value="<?php echo htmlentities($row['pincode']);?>" required />
  </div>   







<div class="form-group">
    <label for="Course1">ELECTIVE 1 </label>
   <?php
   if($sm==semester2)
   { ?>
   
   <select class="form-control" name="course1" id="course1" onBlur="courseAvailability()" required="required">
   <option value="">Select </option>   
   <?php 
   $sql=mysqli_query($bd ,"select * from course WHERE courseCode LIKE '26%'");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['courseName']);?></option>
<?php } ?>
    </select>

<?php } else if($sm==semester3) { ?>

 <select class="form-control" name="course1" id="course1" onBlur="courseAvailability()" required="required">
   <option value="">Select </option>   
   <?php 
   $sql=mysqli_query($bd ,"select * from course WHERE courseCode LIKE '35%'");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['courseName']);?></option>
<?php } ?>
    </select>

<?php } ?> 
    <span id="course-availability-status1" style="font-size:12px;">
  </div>

<div class="form-group">
    <label for="Course2">ELECTIVE 2</label>
<?php if($sm==semester2) { ?>
   
    <select class="form-control" name="course2" id="course2" onBlur="courseAvailability1()" required="required">
   <option value="">Select </option>   
   <?php 
$sql=mysqli_query($bd ,"select * from course WHERE semester='$sm' and courseCode LIKE '27%'");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['courseName']);?></option>
<?php } ?>
    </select>

<?php } else if($sm==semester3) { ?>

<select class="form-control" name="course2" id="course2" onBlur="courseAvailability1()" required="required">
   <option value="">Select </option>   
   <?php 
$sql=mysqli_query($bd ,"select * from course WHERE semester='$sm' and courseCode LIKE '36%'");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['courseName']);?></option>
<?php } ?>
    </select>

<?php } ?>
    <span id="course-availability-status2" style="font-size:12px;">
  </div>


 <button type="submit" name="submit" id="submit" class="btn btn-default">Enroll</button>
</form>
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
<script>
function courseAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'cid='+$("#course1").val(),
type: "POST",
success:function(data){
$("#course-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}


function courseAvailability1() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability1.php",
data:'cid='+$("#course2").val(),
type: "POST",
success:function(data){
$("#course-availability-status2").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } } ?>
