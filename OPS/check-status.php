<?php
//Including database configuration file

include('config.php');



?>

<!doctype html>
<html lang="en" dir="ltr">

<!-- soccer/project/  07 Jan 2020 03:36:49 GMT -->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">


<title>OPS Application</title>

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
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

<div id="main_content">

    <div id="header_top" class="header_top">
        <div class="container">
            <div class="hleft">
				<a class="header-brand" href="index.php"><img src='passport.png'></a>
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
        <h5 class="brand-name">OPS <a href="index.php" class="menu_option float-right"></a></h5>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Navigation</li>
                <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Apply</span></a></li>
                <li  class="active"><a href="check-status.php"><i class="fa fa-list-ul"></i><span>Check Status</span></a></li>
            </ul>
        </nav>
    </div>

    <div class="page">
        <div id="page_top" class="section-body top_dark">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <a href="javascript:void(0)" class="icon menu_toggle mr-3"><i class="fa  fa-align-left"></i></a>
                        <h1 class="page-title">Check Status</h1>
                    </div>
                    <div class="right">

                    </div>
                </div>
            </div>
        </div>

        <form action="<?=$_SERVER['PHP_SELF']?>" method='POST' enctype="multipart/form-data">
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="tab-content">


                            <div >
                                <div class="card">
                                    <div class="card-header">
                                          <h3 id='notify' class="card-title" style='height:20px; color:#F4432F;'></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row clearfix">
                                          <form action="<?=$_SERVER['PHP_SELF']?>" metho='POST'>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Application Number <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" id='applicationNum' name='applicationNum' placeholder='Enter your application number'>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Confirmation Number <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text"  id='confirmationNum' name='confirmationNum' placeholder='Enter your confirmation number'>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 m-t-20 text-right">
                                                <button type="submit" class="btn btn-primary" id='checkS' name='checkStatus'>Check Status</button> &nbsp;
                                            </div>
                                          </form>

                                            <div class="col-lg-12 col-md-12">
                                                <hr>
                                                <h6>Status Report</h6>
                                                <?php
                                                  if(isset($_POST['checkStatus'])){
                                                    $applicationNum=$_POST['applicationNum'];
                                                    $confirmationNum=$_POST['confirmationNum'];

                                                    //Sanitize user input
                                                    $applicationNum=stripslashes($applicationNum);
                                                    $confirmationNum=stripcslashes($confirmationNum);

                                                    $timeValues=array('08:00-09:00','09:01-10:00','10:01-12:00','14:00-15:00','15:01-16:00','16:01-17:00');

                                                    $query="SELECT * FROM application WHERE applicationNum='".$applicationNum."' and confirmationNum='".$confirmationNum."' LIMIT 1";
                                                    $result=mysqli_query($con,$query) or die('Wrong query |Check status|');
                                                    $numRows=mysqli_num_rows($result);

                                                    if($numRows===1){
                                                      $row=mysqli_fetch_assoc($result) or die("Some  error occured on fetching");
                                                      //Fetch Applicant Data
                                                      $query2="SELECT firstName,fatherName,grandfatherName FROM personaldetail WHERE applicationId='".$row['applicantId']."' LIMIT 1";
                                                      $result2=mysqli_query($con,$query2) or die('Wrong query |Check status 2|');
                                                      $row2=mysqli_fetch_assoc($result2) or die("Some  error occured on fetching");

                                                      $scheduleTime=$timeValues[intval($row['scheduleTime'])];
                                                      echo "<div class='form-group'>
                                                              <p class='form-control'> Name: ".$row2['firstName']." ".$row2['fatherName']." ".$row2['grandfatherName']."</p>
                                                          </div>
                                                          <div class='form-group'>
                                                                  <p class='form-control'>Schedule Date: ".$row['scheduleDate']." ".$scheduleTime."</p>
                                                          </div>
                                                          ";
                                                      //Check appllication status: 1 if its approved 0 if its on process -1 if its rejected
                                                      if($row['status']==='1'){
                                                        echo "
                                                            <div class='form-group'>
                                                                    <p class='form-control'>Status: Approved</p>
                                                            </div>
                                                            ";
                                                      }else if($row['status']==='0'){
                                                        echo "
                                                            <div class='form-group'>
                                                                    <p class='form-control'>Status: Pending</p>
                                                            </div>
                                                            ";
                                                      }else{
                                                        echo "
                                                            <div class='form-group'>
                                                                    <p class='form-control'>Status: Rejected</p>
                                                            </div>
                                                            ";
                                                      }
                                                    }else{
                                                      die("There is no such app num or conf num");
                                                    }
                                                  }else{
                                                    echo "<div class='form-group'>
                                                            <p class='form-control' >No Application Selected</p>
                                                        </div>";
                                                  }
                                                ?>

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


       </form>
	   </div>



<script src="assets/bundles/lib.vendor.bundle.js"></script>

<script src="assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/bundles/counterup.bundle.js"></script>
<script src="assets/bundles/knobjs.bundle.js"></script>
<script src="assets/bundles/c3.bundle.js"></script>

<script src="assets/js/core.js"></script>
<script src="assets/js/page/project-index.js"></script>
<script>
  function init(){
    checkS=document.getElementById('checkS');
    appN=document.getElementById('applicationNum');
    confN=document.getElementById('confirmationNum');
    notif=document.getElementById('notify');
    //Verify field is not empty when a form is submitted
    checkS.addEventListener('click',notEmpty,false);
  }
  function notEmpty(e){
    if(appN.value=="" || confN.value==""){
      e.preventDefault();
      notif.innerHTML="All fields  are required";
    }else{
      notif.innerHTML="";
    }
  }

  window.onload=init;
</script>
</body>

<!-- soccer/project/  07 Jan 2020 03:37:22 GMT -->
</html>
