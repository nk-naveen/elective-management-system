<?php
session_start();
error_reporting(1);
include("includes/config.php");
if(isset($_POST['submit']))
{
    $regno=$_POST['regno'];
    $password=($_POST['password']);
$query=mysqli_query($bd, "SELECT * FROM students WHERE StudentRegno='$regno' and password='$password'");
if(mysqli_num_rows($query)>0)
{
$num=mysqli_fetch_array($query);
$extra="pincode-verification.php";//
$_SESSION['login']=$_POST['regno'];
$_SESSION['id']=$num['studentRegno'];
$_SESSION['sname']=$num['studentName'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($bd, "insert into userlog(studentRegno,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Invalid Reg no or Password";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
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

    <title>Student Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

    <style type="text/css">
        
    
    .main-navbar {
    margin-bottom: 30px;
    text-align: center;
    padding: 10px 0;
    min-height: 30px;
    position: relative;
    background-color: #1B3058;
    border-top: solid 5px grey;
     background-color: rgb(22, 38, 70);
    border-top-color:grey;
}

 
    #span {
            color: white;
            font-size: 25px;
        
        }

  #span1 {
        color: white;
        font-size: 25px;
       text-align: center;
      } 


    * { margin: 0;
        padding: 0;
        box-sizing: border-box;
  font-family: "Poppins", sans-serif
        }
    
  

.bg-image {
  /* The image used */
  background-image: url("gog.jpg");


  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100% 100%;;
}
    </style>
</head>

<body class="bg-image">



    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line" style="color: white;">Please Login To Enter </h4>

                </div>

            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6">
                     <label style="color:darkred; ">Enter Reg no : </label>
                        <input type="text" name="regno" class="form-control"   />
                        <label style="color:darkred;">Enter Password :  </label>
                        <input type="password" name="password" class="form-control"  />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                </div>
                </form>
            
                <div class="col-md-6">
                   
                         <strong> <h1 style="color:white;">MCA DEPARTMENT:</h1></strong>
                        <ul style="color:white;">
                

                            MCA@GIT was founded in the year 1999. From the last two decades this department has been nurturing graduates from the streams like BCA, BSc and BCom with excellent technical skills, managerial skills, soft skills and ethical values; as a result of which today our alumni are either successful IT professional in top notch IT companies, entrepreneurs or academicians. The speciality of MCA@GIT is its ability to provide state-of-the-art facilities and infrastructure with the backup of highly qualified and dedicated staff. Other than adopting conventional learning process, this department imparts knowledge through workshops, expert talks, certification programmes, cultural/technical programmes, internships etc. and has thus created its unique brand identity in the entire North Karnataka. 
                        </ul>
                       
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
