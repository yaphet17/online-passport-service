<?php
session_start();
if(!isset($_SESSION['uname']) and !isset($_SESSION['adminlevel'])){
  header('Location: admin-login.php');
}

include('config.php');

$query1="SELECT * FROM notification WHERE status='unread' ORDER BY date DESC";
$query2="SELECT * FROM notification WHERE status='read' ORDER BY date DESC";
$result1=mysqli_query($con,$query1) or die("Wrong query |Notification|");
$result2=mysqli_query($con,$query2) or die('Wrong query |Readed notification|');
$numRows1=mysqli_num_rows($result1);
$numRows2=mysqli_num_rows($result2);

echo "New <br/>";

if($numRows1!=0){
  //New notification
  while($row=mysqli_fetch_assoc($result1)){
    $tempQuery="SELECT fname,ffname,gfname  FROM personaldetail WHERE applicationId=".$row['applicantId'];
    $tempResult=mysqli_query($con,$tempQuery) or die("Some error occured on query|Seen notification|");
    $tempRow=mysqli_fetch_assoc($tempResult) or die("Some error occured on fetching");
    echo $tempRow['firstName']." ".$tempRow['fatherName']." ".$tempRow['grandfatherName']."is applied for passport on ".$row['date']." ".$row['time']." <a href='application-detail.php?applicant=".$row['applicantId']."'>see more</a><br/>";
    $query3="UPDATE notification SET status='read' WHERE applicantId='".$row['applicantId']."' and date='".$row['date']."' and time='".$row['time']."'";
    mysqli_query($con,$query3) or die('Failed to update notif status');
  }
}else{
  echo "No  new notification found!<br/>";
}

//Seen notification
echo "Seen <br/>";

//Change status of seen notification
if($numRows2!=0){
  while($row=mysqli_fetch_assoc($result2)){
    $tempQuery="SELECT firstName,fatherName,grandfatherName  FROM personaldetail WHERE applicationId=".$row['applicantId'];
    $tempResult=mysqli_query($con,$tempQuery) or die("Some error occured on query|Unseen notification|");
    $tempRow=mysqli_fetch_assoc($tempResult) or die("Some error occured in fetching");
    echo $tempRow['firstName']." ".$tempRow['fatherName']." ".$tempRow['grandfatherName']." is applied for passport on ".$row['date']." at ".$row['time']." <a href='application-detail.php?applicant=".$row['applicantId']."' > see more</a><br/>";
  }
}else{
  echo "No old notitfication found!";
}


?>
