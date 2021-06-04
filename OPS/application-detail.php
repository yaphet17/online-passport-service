<?php
session_start();
if(!isset($_SESSION['uname']) and !isset($_SESSION['adminlevel'])){
  header('Location: admin-login.php');
}
if(!isset($_GET['applicant'])){
    header('Location: application.php');

}
include('config.php');

//Hold applicant id passed through url
$appId=$_GET['applicant'];

$query1="SELECT * FROM personaldetail WHERE applicationId='".$appId."' LIMIT 1";
$query2="SELECT * FROM address WHERE applicantId='".$appId."' LIMIT 1";
$query3="SELECT * FROM attachment WHERE applicantId='".$appId."' LIMIT 1";
$query4="SELECT * FROM site WHERE applicantId='".$appId."' LIMIT 1";
$query5="SELECT * FROM application WHERE applicantId='".$appId."' LIMIT 1";

//Personal detail
$result=mysqli_query($con,$query1) or die('Wrong query |App Detail-personaldetail-1|');
$numRows=mysqli_num_rows($result);

if($numRows===1){
  $row=mysqli_fetch_assoc($result) or die("Some error occured on fetching query 1");
  $fname=$row['firstName'];
  $ffname=$row['fatherName'];
  $gfname=$row['grandfatherName'];
  $aFname=$row['amharicFname'];
  $aFfname=$row['amharicFfname'];
  $aGfname=$row['amharicGfname'];
  $nationality=$row['nationality'];
  $phoneNum=$row['phoneNum'];
  $email=$row['email'];
  $birthDate=$row['birthDate'];
  $birthPlace=$row['birthPlace'];
  $occupation=$row['occupation'];
  if($row['gender']==='F'){
    $gender='Female';
  }else{
    $gender='Male';
  }
  $hairColor=$row['hairColor'];
  $eyeColor=$row['eyeColor'];
  $height=$row['height'];
  $martialStat=$row['martialStatus'];

}else{
  die("No data found");
}
//Address information
$result=mysqli_query($con,$query2) or die('Wrong query |App Detail-personaldetail-2|');
$numRows=mysqli_num_rows($result);
if($numRows===1){
  $row=mysqli_fetch_assoc($result) or die("Some error occured on fetching query 2");
  $region=$row['region'];
  $city=$row['city'];
  $state=$row['state'];
  $woreda=$row['woreda'];
  $kebele=$row['kebele'];
  $houseNum=$row['houseNum'];
  $poBox=$row['poBox'];
}else{
  die("No data found");
}
//Attachment
$result=mysqli_query($con,$query3) or die('Wrong query |App Detail-personaldetail-3|');
$numRows=mysqli_num_rows($result);
if($numRows===1){
  $row=mysqli_fetch_assoc($result) or die("Some error occured on fetching query 3");
  $idDoc=$row['idDoc'];
  $birthCertDoc=$row['birthCertDoc'];
}
//Site Selection
$result=mysqli_query($con,$query4) or die('Wrong query |App Detail-personaldetail-4|');
$numRows=mysqli_num_rows($result);
if($numRows===1){
  $row=mysqli_fetch_assoc($result) or die("Some error occured on fetching query 4");
  $siteSelection=$row['siteSelection'];
  $siteCity=$row['city'];
  $office=$row['office'];
  $deliverySite=$row['deliverySite'];
}else{
  die("No data found");
}
//Application Date
$result=mysqli_query($con,$query5) or die('Wrong query |App Detail-personaldetail-5|');
$numRows=mysqli_num_rows($result);
if($numRows===1){
  $row=mysqli_fetch_assoc($result) or die("Some error occured on fetching query 5");
  $applicationDate=$row['applicationDate'];
  $PNR=$row['paymentCode'];
  if($row['status']==='1'){
    $status='Approved';
  }else if($row['status']==='0'){
    $status='Unresolved';
  }else{
    $status='Rejected';
  }

}else{
  die("No data found");
}

//Notification
$notifQuery="SELECT *  FROM notification WHERE status='unread' ORDER BY date DESC";
$notifResult=mysqli_query($con,$notifQuery) or die('Some error occured on query|Notification|');
$name=array();
$time=array();
$message=array();
if(mysqli_num_rows($notifResult)!=0){
  while($row=mysqli_fetch_assoc($notifResult)){
    $tempQuery="SELECT firstName,fatherName  FROM personaldetail WHERE applicationId=".$row['applicantId'];
    $tempResult=mysqli_query($con,$tempQuery) or die("Some error occured on query|Notification|");
    $tempRow=mysqli_fetch_assoc($tempResult) or die('Some error occured on fetching');
    $tempName=$tempRow['firstName']." ".$tempRow['fatherName'];
    //Append values to array
    array_push($name,$tempName);
    array_push($time,$row['time']);
    array_push($message,"New passport application...................");

    $updateQuery="UPDATE notification SET status='read' WHERE applicantId='".$row['applicantId']."' and date='".$row['date']."' and time='".$row['time']."'";
    mysqli_query($con,$updateQuery) or die('Failed to update notif status');

  }
}else{
  array_push($name,"No unread notifcation found");
  array_push($time," ");
  array_push($message," ");
 }


?>

		<!doctype html>
<html lang="en" dir="ltr">

<!-- soccer/project/  07 Jan 2020 03:36:49 GMT -->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">


<title>OPS Dashboard</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Plugins css -->
<link rel="stylesheet" href="assets/plugins/charts-c3/c3.min.css"/>

<!-- Core css -->
<link rel="stylesheet" href="assets/css/main.css"/>
<link rel="stylesheet" href="assets/css/theme1.css"/>
</head>

<body class="font-montserrat">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

<div id="main_content">
    <div id="header_top" class="header_top">
        <div class="container">
            <div class="hleft">
				<a class="header-brand" href="admin-panel.php"><img src='passport.png'></i></a>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fa fa-gear fa-spin" data-toggle="tooltip" data-placement="right" title="Settings"></i></a>
                    <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa  fa-align-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="rightsidebar" class="right_sidebar">
        <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
        <div class="p-4">
            <div class="mb-4">
                <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                <div class="custom-controls-stacked font_setting">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-opensans">
                        <span class="custom-control-label">Open Sans Font</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-montserrat" checked="">
                        <span class="custom-control-label">Montserrat Google Font</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-roboto">
                        <span class="custom-control-label">Robot Google Font</span>
                    </label>
                </div>
            </div>
            <hr>
            <div class="mb-4">
                <h6 class="font-14 font-weight-bold text-muted">Dropdown Menu Icon</h6>
                <div class="custom-controls-stacked arrow_option">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-a">
                        <span class="custom-control-label">A</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-b">
                        <span class="custom-control-label">B</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-c" checked="">
                        <span class="custom-control-label">C</span>
                    </label>
                </div>
                <h6 class="font-14 font-weight-bold mt-4 text-muted">SubMenu List Icon</h6>
                <div class="custom-controls-stacked list_option">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-a" checked="">
                        <span class="custom-control-label">A</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-b">
                        <span class="custom-control-label">B</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-c">
                        <span class="custom-control-label">C</span>
                    </label>
                </div>
            </div>
            <hr>
            <div>
                <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                <ul class="setting-list list-unstyled mt-1 setting_switch">
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Night Mode</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Fix Navbar top</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Header Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader" checked="">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Min Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Icon Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Gradient Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Shadow</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">RTL Support</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Layout</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                </ul>
            </div>
            <hr>

        </div>
    </div>

    <div class="theme_div">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-unstyled">
                    <li class="list-group-item mb-2">
                        <p>Default Theme</p>
                        <a href="index-2.html"><img src="assets/images/themes/default.png" class="img-fluid" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>Night Mode Theme</p>
                        <a href="project-dark/admin-panel.php"><img src="assets/images/themes/dark.png" class="img-fluid" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>RTL Version</p>
                        <a href="project-rtl/admin-panel.php"><img src="assets/images/themes/rtl.png" class="img-fluid" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div id="left-sidebar" class="sidebar ">
        <h5 class="brand-name">OPS</h5>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Navigation</li>
                <li><a href="admin-panel.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                <li class="active"><a href="application.php"><i class="fa fa-list-ul"></i><span>Applications</span></a></li>

                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="fa fa-lock"></i><span>Authentication</span></a>
                    <ul>
                        <li><a href="change-password.php">Change Password</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>

    <div class="page">
        <div id="page_top" class="section-body top_dark">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <a href="javascript:void(0)" class="icon menu_toggle mr-3"><i class="fa  fa-align-left"></i></a>
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                    <div class="right">

                        <div class="notification d-flex">
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-primary nav-unread"></span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <ul class="list-unstyled feeds_widget">
                                      <?php
                                      for($i=0;$i<count($name);$i++)
                                      echo "
                                        <li>
                                            <div class='feeds-body'>
                                            <h4 class='title text-danger'>".$name[$i]." <small class='float-right text-muted'>".$time[$i]."</small></h4>
                                            <small>".$message[$i]."</small>
                                            </div>
                                            </li>";
                                      ?>


                                    </ul>

                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-center text-muted-dark readall">Mark all as read</a>
                                </div>
                            </div>
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="admin-login.php"><i class="dropdown-icon fa fa-sign-out"></i> Sign out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		 <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        <div class="card c_grid c_yellow">
                            <div class="card-body text-center">
                                <div class="circle">
                                    <img class="rounded-circle" src="assets/images/sm/avatar1.png" alt="">
                                </div>
                                <h6 class="mt-3 mb-0"><?php echo $fname." ".$ffname?></h6>
                                <span><?php echo $email?></span>
                                <?php
                                echo"
                                  <form action='application-detail.php?applicant=".$appId."' method='POST'>
                                    <button type='submit' name='approve' class='btn btn-default btn-sm'>Approve</button>
                                    <button  type='submit' name='reject' class='btn btn-default btn-sm'>Reject</button>
                                  </form>";
                                  //Update application status
                                 if(isset($_POST['approve'])){
                                   $updateQuery="UPDATE application SET status=1 WHERE applicantId=".$appId;
                                   mysqli_query($con,$updateQuery);
                                   $to=$email;
                                   $subject="OPS appointment approval";
                                   $msg="Dear ".$fname." ".$ffname."\nOPS is happy to inform you that your passport appointment request has been approved.Please pay your application fee with in 2 hours starting form now using the payment code(PNR) below\n\nPNR=".$PNR;
                                   mail($to,$subject,$msg) or die('Email sending failed');
                                   echo "<p style='color:green;'>Request Approved</p>";
                                 }
                                 if(isset($_POST['reject'])){
                                   $updateQuery="UPDATE application SET status=-1 WHERE applicantId=".$appId;
                                   mysqli_query($con,$updateQuery);
                                   $to=$email;
                                   $subject="OPS appointment rejection";
                                   $msg="Dear ".$fname." ".$ffname."\nYour OPS appointment request has been rejected.\nFor more information contact reciever@localhost";
                                   mail($to,$subject,$msg) or die('Email sending failed');
                                   echo "<p style='color:green;'>Request Rejected</p>";
                                 }

                                  ?>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Address information</h3>
                            </div>

                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <small class="text-muted">Region: </small>
                                        <p class="mb-0"><?php echo $region?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">State: </small>
                                        <p  class="mb-0"><?php echo $state?></p>
                                    </li>
                                    <li class="list-group-item">
                                            <small class="text-muted">City: </small>
                                            <p  class="mb-0"><?php echo $city?></p>
                                        </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">Woreda: </small>
                                        <p  class="mb-0"><?php echo $woreda?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">kebele: </small>
                                        <p  class="mb-0"><?php echo $kebele?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">House Number: </small>
                                        <p  class="mb-0"><?php echo $houseNum?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">P.O Box: </small>
                                        <p  class="mb-0"><?php echo $poBox?></p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Attachement</h3>
                            </div>

                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <small class="text-muted">ID Document: </small>
                                        <p class="mb-0"><?php echo "<a href='".$idDoc."' download><i class='fa fa-download' style='margin-right:5px;'></i>Id Document</a>"?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">Birth Certificate: </small>
                                        <p  class="mb-0"><?php echo "<a href='".$birthCertDoc."' download><i class='fa fa-download' style='margin-right:5px;'></i>Birth Certificate Document</a>"?></p>
                                    </li>

                                </ul>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Site Selection</h3>
                            </div>

                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <small class="text-muted">Site Selection: </small>
                                        <p class="mb-0"><?php echo $siteSelection?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">City: </small>
                                        <p  class="mb-0"><?php echo $siteCity?></p>
                                    </li>
                                    <li class="list-group-item">
                                            <small class="text-muted">Office: </small>
                                            <p  class="mb-0"><?php echo $office?></p>
                                        </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">Delivery Site: </small>
                                        <p  class="mb-0"><?php echo $deliverySite?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                          <?php
                          //Email Applicant
                          if(isset($_POST['sendmail'])){
                            $to=$email;
                            $subject="Email from OPS Adminstrator";
                            $msg=$_POST['mailMsg'];
                            if(mail($to,$subject,$msg)){
                              echo "<p style='color:green;'><i class='fa fa-check' style='font-size:24px;color:green;margin-right:5px;margin-left:5px;'></i>Email successfully sent</p>";
                            }else{
                                echo "<p style='color:red;'><i class='fa fa-warning' style='font-size:24px;color:red;margin-right:5px;'></i>Email sending failed</p>";
                            }

                          }

                          echo "
                          <form action='application-detail.php?applicant=".$appId."' method='POST'>
                            <div class='card-body'>
                                <textarea name='mailMsg' style='width:100%;height:100px; border:none;' cols='100' placeholder='Write email for applicants' class='summernote'>

                                </textarea>

                                <div class='mt-4 text-right'>

                                    <input type='submit' name='sendmail' value='Send Email' class='btn btn-primary'>
                                </div>
                            </div>
                          </form>";

                          ?>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Personal Details</h3>
                                <div class="card-options">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="timeline_item ">
                                    <span><a href="javascript:void(0);"><?php echo $fname." ".$ffname." ".$gfname?></a> <?php echo $aFname." ".$aFfname." ".$aGfname?> <small class="float-right text-right"><?php echo $applicationDate?></small></span>
                                    <div class="dropdown-divider"></div>
                                    <h6 class="font600">Status: <?php echo $status?></h6>
                                    <div class="msg">
                                        <p>Gender: <?php echo $gender?></p>
                                        <p>Birth Date: <?php echo $birthDate?></p>
                                        <p>Birth Place: <?php echo $birthPlace?></p>
                                        <p>Nationality: <?php echo $nationality?></p>
                                        <p>Phone Number: <?php echo $phoneNum?></p>
                                        <p>Occupation: <?php echo $occupation?></p>
                                        <p>Hair Color: <?php echo $hairColor?></p>
                                        <p>Eye Color: <?php echo $eyeColor?></p>
                                        <p>Height: <?php echo $height?></p>
                                        <p>Martial Status: <?php echo $martialStat?></p>



                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<script src="assets/bundles/lib.vendor.bundle.js"></script>

<script src="assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/bundles/counterup.bundle.js"></script>
<script src="assets/bundles/knobjs.bundle.js"></script>
<script src="assets/bundles/c3.bundle.js"></script>

<script src="assets/js/core.js"></script>
<script src="assets/js/page/project-index.js"></script>
</body>

<!-- soccer/project/  07 Jan 2020 03:37:22 GMT -->
</html>
