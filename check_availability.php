<?php 
require_once("includes/config.php");
session_start();

if(!empty($_POST["cid"])) {
	$un=$_SESSION['login'];
	$cid= $_POST["cid"];
	//echo 'course id: '.$cid=4; echo'</br>';
		$res1 =mysqli_query($bd, "SELECT count(studentRegno) as nst FROM courseenrolls WHERE course1='$cid' and studentRegno='$un'");
		$row1=mysqli_fetch_array($res1);
		 $sct=$row1['nst'];
if($sct>0)
{
echo "<span style='color:red'> Already Applied for this course.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} 
//}
//if(!empty($_POST["cid"])) {
	//$cid= $_POST["cid"];
	
		$res2 =mysqli_query($bd, "SELECT count(id) as tc FROM courseenrolls WHERE course1='$cid' and studentRegno='$un'");
		$row2=mysqli_fetch_array($res2);
        $tc=$row2['tc'];

		$result1 =mysqli_query($bd, "SELECT noofSeats FROM course WHERE id='$cid'");
		$row=mysqli_fetch_array($result1);
		$noofseat=$row['noofSeats'];

if($tc>=$noofseat)
{
echo "<span style='color:red'> Seat not available for this course. All Seats Are full</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} 
}

?>
