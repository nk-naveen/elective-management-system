<?php
include('includes/config.php');
if(isset($_POST['FormSubmit']))
{

  $regno=$_POST['regno'];
  $pincode=$_POST['pincode'];
  $sem=$_POST['sem'];
  
   if($sem==1)
   {
     $sem="semester2";
   }
   
    if($sem==2)
   {
     $sem="semester3";
   }	 
	 

   $ss="select * from course where semester='$sem'";
   $rs=mysqli_query($bd,$ss);
   
   //echo $ss;
   $i=1;
   while($row=mysqli_fetch_array($rs))
   {
   
      $course=$_POST['c'.$i];
	  $preferences=$_POST['p'.$i];
	  
	  //echo $course;
	  //echo "<br>";
	  //echo $preferences;
	  
	  $m="select noofSeats from course where courseName='$course'";
	  $m1=mysqli_query($bd,$m);
	  $m2=mysqli_fetch_array($m1);
	  
	  $seats=$m2['noofSeats'];
	  
	  $n="select count(*) from courseenrolls where course='$course'";
	  $n1=mysqli_query($bd,$n);
	  $n2=mysqli_fetch_array($n1);
	  
	  $occupied_seats=$n2[0];
	  
	  if($occupied_seats<$seats)
	  {
	  
	       if($preferences=="1" && $course=="Cyber Security")
		   {
		     
			  
			  $k="insert into courseenrolls(studentRegno,pincode,semester,course,enrollDate) values('$regno','$pincode','$sem','$course',curdate())";
			  
			  mysqli_query($bd,$k);
			  
			  echo "Enrolled Successfully.";
			  
		   }
		   
             if($preferences=="1" && $course=="Internet of things")

		   {
		     
			  $k="insert into courseenrolls(studentRegno,pincode,session,department,level,semester,course,enrollDate) values('$regno','$pincode','$sem','$course',curdate())";
			  
			  mysqli_query($bd,$k);
			  
			  echo "Enrolled Successfully.";
			  
		   }
	  
	  
	  }
	  
	  else
	  {
	     echo "Seats are not available";
	  }
	  
	  
   
   $i++;
   }

}


?>