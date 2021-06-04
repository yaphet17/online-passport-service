<?php
session_start();

if(!isset($_SESSION['uname']) or isset($_SESSION['adminlevel'])){
  header('Location: admin-panel.php');
  session_destroy();
}

include('config.php');

$appId=$_GET['applicant'];

//Time schedule VALUES
$timeValues=array('08:00-09:00','09:01-10:00','10:01-12:00','14:00-15:00','15:01-16:00','16:01-17:00');

//Fetch pplicant email
$query1="SELECT firstName,fatherName,email FROM personaldetail WHERE applicationid='".$appId."' LIMIT 1";
$result1=mysqli_query($con,$query1) or die("Some error occured on query |Email fetching|");

$row1=mysqli_fetch_assoc($result1) or die("Unable to fetch query 1");
$fname=$row1['firstName'];
$ffname=$row1['fatherName'];
$gfame=$row1['grandfatherName'];
$email="reciever@localhost";

if(isset($_POST['submit1'])){
  $status=1;
  $query2="SELECT scheduleDate,scheduleTime,applicationNum,confirmationNum,paymentCode FROM application WHERE  applicantId='".$appId."' LIMIT 1";
  $result2=mysqli_query($con,$query2) or die("Some error occured on query |Confirmation|");

  $row2=mysqli_fetch_assoc($result2) or die("Unable to fetch query 2");
  //Set schedule time(
  $scheduleTime=$timeValues[intval($row2['scheduleTime'])];

    //Email information for pnr code
  $to=$email;
  $subject="Payment Order";
  $message="
          Dear ".$fname." ".$ffname." ".$gfname."\n
          You requested appointment for ".$row2['scheduleDate']." ".$scheduleTime."\n
          Amount: 600\n

          Please Pay at CBE Branch using  below PNR code and get confirmation by Email or SMS\n

          Application no:".$row2['applicationNum']."
          
          PNR:".$row2['paymentCode']."\n

          Note: Payment should be made before Visit to passport Service.\n

          Thank You!";
  if(mail($to,$subject,$message)){
    header("Location: application.php");
  }else{
    echo "Email sending failed!";
  }
}else{
  $status=-1;
  $to=$email;
  $subject="OPS application response";
  $message="
            Dear ".$fname." ".$ffname." ".$gfname."\n

            Your request for passport appointment has been rejected.\n

            please contact example@gmail.com for further clarification\n

            Thank you!";

  if(mail($to,$subject,$message))
  {
    header("Location: application.php");
  }else{
    echo "Email sending failed";
  }
}
$query3="UPDATE application SET status=".$status." WHERE applicantId=".$appId;
mysqli_query($con,$query3) or die("Some error occured on query |UPDATE|");

?>
