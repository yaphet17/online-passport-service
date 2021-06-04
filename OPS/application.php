<?php
session_start();

if(!isset($_SESSION['uname']) and !isset($_SESSION['adminlevel'])){
  header("Location: admin-login.php");
}
include('config.php');


//Four schedule time values
$timeValues=array('08:00-09:00','09:01-10:00','10:01-12:00','14:00-15:00','15:01-16:00','16:01-17:00');

$query1="SELECT * FROM application ORDER BY applicationDate DESC";
$result=mysqli_query($con,$query1) or die("Some error occured on fetching |Application|");
$numRows=mysqli_num_rows($result);

$appId=array();
$appName=array();
$applicationDate=array();
$requestType=array();
$pageNum=array();
$scheduleDate=array();
$scheduleT=array();
$site=array();
if($numRows!=0){
  while($row1=mysqli_fetch_assoc($result)){
    $applicantId=$row1['applicantId'];
    $scheduleTime=$timeValues[intval($row1['scheduleTime'])];
    $query2="SELECT firstName,fatherName,grandfatherName FROM personaldetail WHERE applicationId='".$applicantId."'";
    $query3="SELECT siteSelection FROM site WHERE applicantId='".$applicantId."'";
    $result2=mysqli_query($con,$query2);
    $result3=mysqli_query($con,$query3);
    $row2=mysqli_fetch_assoc($result2) or die("Some error occured on fetching |Application|");
    $row3=mysqli_fetch_assoc($result3) or die("Some error occured on fetching |Application|");

    //Append values to arrays
    $aName=$row2['firstName']." ".$row2['fatherName'];
    array_push($appId,$applicantId);
    array_push($appName,$aName);
    array_push($applicationDate,$row1['applicationDate']);
    array_push($requestType,$row1['requestType']);
    array_push($pageNum,$row1['pageNum']);
    array_push($scheduleDate,$row1['scheduleDate']);
    array_push($scheduleT,$scheduleTime);
    array_push($site,$row3['siteSelection']);

  }
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

function showApplicants($appId,$appName,$applicationDate,$requestType,$pageNum,$scheduleDate,$scheduleT,$site){
  for($j=0;$j<count($appName);$j++){
      echo "
      <tr>
          <td><a href='application-detail.php?applicant=".$appId[$j]."'>".$appName[$j]."</a></td>
          <td><span>".$applicationDate[$j]."</span></td>
          <td><span class='tag tag-default'>".$requestType[$j]."</span></td>
          <td><span>".$pageNum[$j]."</span></td>
          <td><span>".$scheduleDate[$j]."</span></td>
          <td><span>".$scheduleT[$j]."</span></td>
          <td>".$site[$j]."</td>
      </tr>
      ";
    }
}

function checkStatus($status){
  if($status==='1'){
    return "Approved";
  }else if($status==='0'){
    return "Unresolved";
  }else{
    return "Rejected";
  }

}
?>

		<!doctype html>
<html lang="en" dir="ltr">

<!-- soccer/project/  07 Jan 2020 03:36:49 GMT -->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>OPS applications</title>

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
				<a class="header-brand" href="application.php"><img src='passport.png'></a>
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
                        <a href="project-dark/index.html"><img src="assets/images/themes/dark.png" class="img-fluid" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>RTL Version</p>
                        <a href="project-rtl/index.html"><img src="assets/images/themes/rtl.png" class="img-fluid" /></a>
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
                        <h1 class="page-title">Applications</h1>
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
                    <div class="col-12">

                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-vcenter mb-0 text-nowrap">
                                    <thead>

                                        <tr>

                                            <th>Name</th>
                                            <th>Application date</th>
                                            <th>Request type</th>
                                            <th>Page number</th>
                                            <th>Schdule Date</th>
                                            <th>Schedule Time</th>
                                            <th>Site</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      showApplicants($appId,$appName,$applicationDate,$requestType,$pageNum,$scheduleDate,$scheduleT,$site);
                                      ?>


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
