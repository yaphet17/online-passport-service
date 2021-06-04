<?php
//Including database configuration file

include('config.php');

  //Generate payment code
function generatePNR($val){
  $curr_date=date('d').date('m');
  $randNum=rand(000,999);
  $PNR=$val.$curr_date.$randNum;
  return $PNR;
}
//Fetch applicant Id
function fetchId($fname,$ffname,$gfname,$email){
  include('config.php');
  $query1_1="SELECT applicationid FROM personaldetail WHERE firstName='".$fname."' and fatherName='".$ffname."' and grandfatherName='".$gfname."' and email='".$email."' LIMIT 1";
  $result=mysqli_query($con,$query1_1) or die("Id fetch failed!");
  $numRows2=mysqli_num_rows($result);

  if($numRows2!=0){//To be changed
    	$row=mysqli_fetch_assoc($result);
  }else{
    die("No such id!");
  }
return $row['applicationid'];
}
//Get File Path
function getPath($val){
  $fileName=$_FILES[$val]['name'];
  $fileTmpName=$_FILES[$val]['tmp_name'];
  $fileSize=$_FILES[$val]['size'];
  $fileError=$_FILES[$val]['error'];
  $fileType=$_FILES[$val]['type'];

  $fileExt=explode('.', $fileName);
  $fileActualExt=strtolower(end($fileExt));
  $allowed=array('zip','pdf');
  if(in_array($fileActualExt, $allowed)){
      if ($fileError===0){
           if($fileSize<1000000){
                 $fileNameNew=uniqid('',true).'.'.$fileActualExt;
                 if($val==='idDoc'){
                   $pathFolder='Document/Id-Document';
                 }else{
                   $pathFolder='Document/Birth-Certificate-Document';
                 }

                 $fileDestination=$pathFolder.'/'.$fileNameNew;
                 move_uploaded_file($fileTmpName, $fileDestination);
                 return $fileDestination;

           }else{
                 die('File Size too large!');
           }
     }else{
          echo "<script>alert('Some error occured');</script>";
    }

}else{
  die('file type not allowed');
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
                <li class="active"><a href="admin-panel.php"><i class="fa fa-dashboard"></i><span>Apply</span></a></li>
                <li><a href="check-status.php"><i class="fa fa-list-ul"></i><span>Check Status</span></a></li>
            </ul>
        </nav>
    </div>

    <div class="page">
        <div id="page_top" class="section-body top_dark">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <a href="javascript:void(0)" class="icon menu_toggle mr-3"><i class="fa  fa-align-left"></i></a>
                        <h1 class="page-title">Apply</h1>
                    </div>
                    <div class="right">

                    </div>
                </div>
            </div>
        </div>
		<div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="d-lg-flex justify-content-between">
                            <ul class="nav nav-tabs page-header-tab">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Company_Settings">Personal Information</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Localization" id='address'>Address</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Roles_Permissions" id='applicationDetail'>Application Detail</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Site_Selection" id='site'>Site Selection</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Email_Settings" id='attachment'>Attachment</a></li>
                            </ul>
                        </div>
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
                            <div class="tab-pane active show" id="Company_Settings">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 id='notif1' class="card-title" style='height:20px;color:red'>
                                          <?php
                                          if(isset($_POST['apply'])){
                                              //Personal Details
                                              $fname=$_POST['fname'];
                                              $ffname=$_POST['ffname'];
                                              $gfname=$_POST['gfname'];
                                              $aFname=$_POST['aFname'];
                                              $aFfname=$_POST['aFfname'];
                                              $aGfname=$_POST['aGfname'];
                                              $birthDate=$_POST['birthDate'];
                                              $nationality=$_POST['nationality'];
                                              $phoneNum=$_POST['phoneNum'];
                                              $email=$_POST['email'];
                                              $birthPlace=$_POST['birthPlace'];
                                              $occupation=$_POST['occupation'];
                                              $gender=$_POST['gender'];
                                              $hairColor=$_POST['hairColor'];
                                              $eyeColor=$_POST['eyeColor'];
                                              $height=$_POST['height'];
                                              $martialStatus=$_POST['martialStatus'];

                                              //Address information
                                              $region=$_POST['region'];
                                              $city=$_POST['city'];
                                              $state=$_POST['state'];
                                              $woreda=$_POST['woreda'];
                                              $kebele=$_POST['kebele'];
                                              $houseNo=$_POST['houseNum'];
                                              $poBox=$_POST['poBox'];

                                              //Site selection
                                              $siteSelection=$_POST['siteSelection'];
                                              $siteCity=$_POST['siteCity'];
                                              $office=$_POST['office'];
                                              $deliverySite=$_POST['deliverySite'];

                                              //Attachment
                                              $idDoc=getPath('idDoc');
                                              $birthCertDoc=getPath('birthCertDoc');
                                              $courtLettDoc="path";

                                              //Application
                                              $requestType="New";
                                              $pageNum=$_POST['pageNum'];
                                              $scheduleDate=$_POST['scheduleDate'];
                                              $scheduleTime=$_POST['scheduleTime'];
                                              $applicationNum=$fname.$ffname.date('d');
                                              $confirmationNum=bin2hex(openssl_random_pseudo_bytes(7));
                                              $paymentCode=generatePNR(substr($fname,0,2));
                                              $status="0";

                                              //Sanitize user input
                                              $fname=stripcslashes($fname);
                                              $ffname=stripcslashes($ffname);
                                              $gfname=stripcslashes($gfname);
                                              $aFname=stripcslashes($aFname);
                                              $aFfname=stripcslashes($aFfname);
                                              $aGfname=stripcslashes($aGfname);
                                              $birthPlace=stripcslashes($birthPlace);
                                              $phoneNum=stripcslashes($phoneNum);
                                              $email=stripcslashes($email);
                                              $height=stripcslashes($height);
                                              $city=stripcslashes($city);
                                              $state=stripcslashes($state);
                                              $woreda=stripcslashes($woreda);
                                              $kebele=stripcslashes($kebele);

                                              //Current day and posix_times$currDate=date('y-m-d');
                                              $currDate=date('y-m-d');
                                              $currTime=date('h:i:s');
                                              $currDateTime=date('y-m-d h:i:s');




                                              //Personal detail query

                                              $columns="firstName,fatherName,grandfatherName,amharicFname,amharicFfname,amharicGfname,birthDate,nationality,
                                                        phoneNum,email,birthPlace,occupation,gender,hairColor,eyeColor,height,martialStatus";
                                              $validationQuery="SELECT applicationid FROM personaldetail WHERE firstName='".$fname."' and fatherName='".$ffname."' and grandfatherName='".$gfname."' and email='".$email."'";
                                              $validationResult=mysqli_query($con,$validationQuery) or  die("Some error occured!");
                                              $numRows1=mysqli_num_rows($validationResult);
                                                if($numRows1===0){
                                                  /*Personal detail query*/

                                                  $query1="INSERT INTO personaldetail (".$columns.") VALUES('".$fname."','".$ffname."','".$gfname."','".$aFname."','".$aFfname."','".$aGfname."','".$birthDate."','".$nationality."','".$phoneNum."','".$email."','".$birthPlace."','".$occupation."','".$gender."','".$hairColor."','".$eyeColor."',".$height.",'".$martialStatus."')";

                                                  if(mysqli_query($con,$query1)){
                                                    //Address query
                                                    $query2="INSERT INTO address VALUES('".fetchId($fname,$ffname,$gfname,$email)."','".$region."','".$city."','".$state."','".$woreda."','".$kebele."','".$houseNo."','".$poBox."')";
                                                    mysqli_query($con,$query2) or  die("Some error occured!");
                                                    //Site selection query
                                                    $query3="INSERT INTO site VALUES('".fetchId($fname,$ffname,$gfname,$email)."','".$siteSelection."','".$city."','".$office."','".$deliverySite."')";
                                                    mysqli_query($con,$query3) or  die("Some error occured!");
                                                    //File Attachment
                                                    $query4="INSERT INTO attachment VALUES('".fetchId($fname,$ffname,$gfname,$email)."','".$idDoc."','".$birthCertDoc."','".$courtLettDoc."')";
                                                    mysqli_query($con,$query4) or  die("Some error occured!");
                                                    //Application query
                                                    $query5="INSERT INTO application VALUES('".fetchId($fname,$ffname,$gfname,$email)."','".$requestType."','".$pageNum."','".$scheduleDate."',
                                                            '".$scheduleTime."','".$applicationNum."','".$confirmationNum."','".$paymentCode."','".$currDateTime."','".$status."')";
                                                    mysqli_query($con,$query5) or  die("Some error occured!");
                                                    //Notification query
                                                    $query6="INSERT INTO  notification VALUES('".fetchId($fname,$ffname,$gfname,$email)."','".$currDate."','".$currTime."','unread')";
                                                    mysqli_query($con,$query6) or  die("Some error occured!");
                                                  }else{
                                                     die("Some error occured!");
                                                  }
                                                  //Email information for request confirmation
                                                  $to=$email;
                                                  $subject="OPS Confirmation Code";
                                                  $message="Dear ".$fname." ".$ffname." below is your application number along with unique confirmation code\nfor your passport appointment application\nAppilcation number=".$applicationNum."\nConfirmation Number=".$confirmationNum;
                                                  if(mail($to,$subject,$message)){
                                                    echo "<p style='color:green;'><i class='fa fa-check' style='font-size:24px;color:green;margin-right:5px;'></i>Application Successfully completed</p>";
                                                  }else{
                                                    echo "<p style='color:red;'><i class='fa fa-warning' style='font-size:24px;color:red;margin-right:5px;'></i>Application Successfully completed but failed to email application detail</p>";
                                                  }

                                              }else{
                                                echo "<p style='color:red;'><i class='fa fa-warning' style='font-size:24px;color:red;margin-right:5px;'></i>There is an application with the same personal detail</p>";
                                              }
                                            }
                                          ?>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>First Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text"id='fname' name='fname' placeholder='Enter your first name' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Father Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id='ffname' name='ffname' placeholder='Enter your father name' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Grand Father Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id='gfname' name='gfname' placeholder='Enter your grand father name' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>First Name In Amharic <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name='aFname' placeholder='ስም' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Father Name In Amharic <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name='aFfname' placeholder='የአባት ስም' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Grand Father Name In Amharic <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name='aGfname'  placeholder='የአያት ስም' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Birth Date <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="date" id='bplace' name='birthDate' placeholder='Enter your birth date' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Birth Place <span class="text-danger">*</span></label>
                                                        <input class="form-control"  type="text" name='birthPlace' placeholder='Enter your birth place' required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Mobile Number <span class="text-danger">*</span></label>
                                                        <input class="form-control"  type="number" name='phoneNum' placeholder='Enter your mobile number' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class=" fa fa-envelope"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" type="email" name='email' placeholder='Enter your email address' required>
                                                        </div>
                                                    </div>


                                              </div>
                                              <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">
                                                      <label>Height <span class="text-danger">*</span></label>
                                                      <input class="form-control" type="number" name='height' placeholder='Enter your height (cm)' required>
                                                  </div>
                                              </div>
                                              <div class="col-md-4 col-sm-12">
                                                  <div class="form-group">

                                                      <select class="form-control" name="nationality" required>
                                                        <option disable hidden selected>Nationality</option>
                                                        <option value='Ethiopia'>Ethiopia</option>
                                                      </select>
                                                  </div>
                                              </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control" name='occupation' required>
                                                          <option disabled hidden  selected>Occupation</option>
                                                          <option value='Student'>Student</option>
                                                          <option value='NGO'>NGO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control" name='gender' required>
                                                          <option disabled hidden  selected>Gender</option>
                                                          <option value='Female'>Female</option>
                                                          <option value='Male'>Male</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control" name='hairColor' required>
                                                          <option disable hidden  selected>Hair Color</option>
                                                          <option value='Black'>Black</option>
                                                          <option value='Brown'>Brown</option>
                                                          <option value='Blonde'>Blonde</option>
                                                          <option value='White'>White</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control" name='eyeColor' required>
                                                          <option diable hidden  selected>Eye Color</option>
                                                          <option value='Black'>Black</option>
                                                          <option value='Brown'>Brown</option>
                                                          <option value='White'>White</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control" name='martialStatus' required>
                                                          <option disable hidden  selected>Martial Status</option>
                                                          <option value='Single'>Single</option>
                                                          <option value='Married'>Married</option>
                                                          <option value='Divorced'>Divorced</option>
                                                          <option value='Widowed'>Widow</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-sm-12 text-right m-t-20">
                                                    <button type="button" class="btn btn-primary" onclick="nextForm('address');">Next</button>
                                                </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="tab-pane" id="Localization">
                          <div class="card">
                              <div class="card-header">
                                    <h3 id='notifyAddress' class="card-title" style='height:20px;'></h3>
                              </div>
                              <div class="card-body">
                                      <div class="row">
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <select class="form-control" name='region' required>
                                                      <option disabled hidden selected>Region</option>
                                                      <option value='Addis Ababa'>Addis Ababa</option>
                                                      <option value='Afar'>Afar</option>
                                                      <option value='Amhara'>Amhara</option>
                                                      <option value='Benishangul Gumuz'>Benishangul Gumuz</option>
                                                      <option value='Dire Dawa'>Dire Dawa</option>
                                                      <option value='Gambela'>Gambela</option>
                                                      <option value='Harari'>Harari</option>
                                                      <option value='Oromia'>Oromia</option>
                                                      <option value='Sidama'>Sidama</option>
                                                      <option value='Somali'>Somali</option>
                                                      <option value='Southern Nation and Nationalities and Peoples'>Southern Nation and Nationalities and Peoples</option>
                                                      <option value='Tigray'>Tigray</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <select class="form-control" name='city' required>
                                                      <option diabled hidden selected>City</option>
                                                      <option value="Addis Ababa">Addis Ababa</option>
                                                      <option value="Semera">Semera</option>
                                                      <option value="Bahirdar">Bahirdar</option>
                                                      <option value="Assosa">Assosa</option>
                                                      <option value="Harari">Harar</option>
                                                      <option value="Adama">Adama</option>
                                                      <option value="Hawasa">Hawasa</option>
                                                      <option value="Jigjiga">Jigjiga</option>
                                                      <option value="Hawasa">Hawasa</option>
                                                      <option value="Mekelle">Mekelle</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>State <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name='state' placeholder='Enter your state' required>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Woreda <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name='woreda' placeholder='Enter your woreda' required>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kebelle <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name='kebele' placeholder='Enter your kebelle' required>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>House Number </label>
                                                <input class="form-control" type="text" name='houseNum' placeholder='Enter your house number' required>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>P.O Box </label>
                                                <input class="form-control" type="text" name='poBox' placeholder='Enter your p.o box' required>
                                            </div>
                                          </div>


                                          <div class="col-sm-12 text-right m-t-20">
                                              <button type="button" class="btn btn-primary" onclick="nextForm('applicationDetail')">Next</button>
                                          </div>
                                      </div>
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="Roles_Permissions">
                      <div class="card">
                          <div class="card-header">
                                <h3 id='notifyAddress' class="card-title" style='height:20px;'></h3>
                          </div>
                          <div class="card-body">
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                              <select class="form-control" name='pageNum' required>
                                                  <option diabled hidden selected>Page Number</option>
                                                  <option value='32'>32</option>
                                                  <option value='64'>64</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                              <select class="form-control" name='scheduleTime' required>
                                                  <option disabled hidden selected>Schedule Time</option>
                                                  <option disabled style='color:#808080'>Morning</option>
                                                  <option value="1"> 08:00-09:00</option>
                                                  <option value="2"> 09:01-10:00</option>
                                                  <option value="3"> 10:01-11:00</option>
                                                  <option value="4"> 11:01-12:00</option>
                                                  <option disabled style='color:#808080'>Afternoon</option>
                                                  <option value="5"> 14:00-15:00</option>
                                                  <option value="6"> 15:01-16:00</option>
                                                  <option value="7"> 16:01-17:00</option>
                                                  <option value="8"> 17:01-18:00</option>
                                              </select>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Schedule date <span class="text-danger">*</span></label>
                                          <input class="form-control" type="date" name='scheduleDate'>
                                      </div>
                                    </div>


                                      <div class="col-sm-12 text-right m-t-20">
                                          <button type="button" class="btn btn-primary" onclick="nextForm('site')">Next</button>
                                      </div>
                                  </div>
                          </div>
                      </div>

                  <div class="tab-pane" id="Site_Selection">
                  <div class="card">
                      <div class="card-header">
                            <h3 id='notifySite' class="card-title" style='height:20px;'></h3>
                      </div>
                      <div class="card-body">
                              <div class="row">
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <select class="form-control" name='siteSelection' required>
                                            <option disabled hidden selected>Site Selection</option>
                                            <option value='Addis Ababa'>Addis Ababa</option>
                                            <option value='Afar'>Afar</option>
                                            <option value='Amhara'>Amhara</option>
                                            <option value='Benishangul Gumuz'>Benishangul Gumuz</option>
                                            <option value='Dire Dawa'>Dire Dawa</option>
                                            <option value='Gambela'>Gambela</option>
                                            <option value='Harari'>Harari</option>
                                            <option value='Oromia'>Oromia</option>
                                            <option value='Sidama'>Sidama</option>
                                            <option value='Somali'>Somali</option>
                                            <option value='Southern Nation and Nationalities and Peoples'>Southern Nation and Nationalities and Peoples</option>
                                            <option value='Tigray'>Tigray</option>
                                        </select>
                                    </div>

                                      </div>
                                      <div class="col-sm-6">

                                          <div class="form-group">
                                            <select class="form-control" name='siteCity' required>
                                                <option diabled hidden selected>City</option>
                                                <option value="Addis Ababa">Addis Ababa</option>
                                                <option value="Semera">Semera</option>
                                                <option value="Bahirdar">Bahirdar</option>
                                                <option value="Assosa">Assosa</option>
                                                <option value="Harari">Harar</option>
                                                <option value="Adama">Adama</option>
                                                <option value="Hawasa">Hawasa</option>
                                                <option value="Jigjiga">Jigjiga</option>
                                                <option value="Hawasa">Hawasa</option>
                                                <option value="Mekelle">Mekelle</option>
                                            </select>

                                          </div>
                                      </div>
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                            <select class="form-control" name='office' required>
                                                <option diabled hidden selected>Office</option>
                                                <option value="Addis Ababa INVEA">Addis Ababa INVEA</option>
                                                <option value="Semera INVEA">Semera INVEA</option>
                                                <option value="Bahirdar INVEA">Bahirdar INVEA</option>
                                                <option value="Assosa INVEA">Assosa INVEA</option>
                                                <option value="Harari INVEA">Harar INVEA</option>
                                                <option value="Adama INVEA">Adama INVEA</option>
                                                <option value="Hawassa INVEA">Hawassa INVEA</option>
                                                <option value="Jigjiga INVEA">Jigjiga INVEA</option>
                                                <option value="Hawassa INVEA">Hawassa INVEA</option>
                                                <option value="Mekelle INVEA">Mekelle INVEA</option>
                                            </select>

                                          </div>
                                      </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <select class="form-control" name='deliverySite' required>
                                              <option diabled hidden selected>Delivery Site</option>
                                              <option value="Addis Ababa Post Office">Addis Ababa Post Office</option>
                                              <option value="Semera Post Office">Semera Post Office</option>
                                              <option value="Bahirdar Post Office">Bahirdar Post Office</option>
                                              <option value="Assosa Post Office">Assosa Post Office</option>
                                              <option value="Harari Post OfficeA">Harar Post Office</option>
                                              <option value="Adama Post Office">Adama Post Office</option>
                                              <option value="Hawassa Post Office">Hawassa Post Office</option>
                                              <option value="Jigjiga Post Office">Jigjiga Post Office</option>
                                              <option value="Hawassa Post Office">Hawassa Post Office</option>
                                              <option value="Mekelle Post Office">Mekelle Post Office</option>
                                          </select>
                                        </div>
                                    </div>

                                  </div>


                                  <div class="col-sm-12 text-right m-t-20">
                                      <button type="button" class="btn btn-primary" onclick="nextForm('attachment')">Next</button>
                                  </div>
                                  </div>
                              </div>

                      </div>


                  <div class="tab-pane" id="Email_Settings">
                  <div class="card">
                      <div class="card-header">
                            <h3 id='notifyAttachment' class="card-title" style='height:20px;'></h3>
                      </div>
                      <div class="card-body">
                              <div class="row">
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Id Document <span class="text-danger">*</span></label>
                                          <input class="form-control" type="file" name='idDoc' id='idDoc' required>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Birth Certificate Document <span class="text-danger">*</span></label>
                                          <input class="form-control" type="file" name='birthCertDoc' id='birthCertDoc' required>
                                      </div>
                                  </div>

                                  <div class="col-sm-12 text-right m-t-20">
                                      <button type="submit" class="btn btn-primary" name='apply'>Submit</button>
                                  </div>
                              </div>

                      </div>
                  </div>
              </div>

              </form>



<script src="assets/bundles/lib.vendor.bundle.js"></script>

<script src="assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/bundles/counterup.bundle.js"></script>
<script src="assets/bundles/knobjs.bundle.js"></script>
<script src="assets/bundles/c3.bundle.js"></script>

<script src="assets/js/core.js"></script>
<script src="assets/js/page/project-index.js"></script>
<script>
  //Move to next tab
  function nextForm(val){
    target=document.getElementById(val);
    target.click();
  }
  //Form Validation
  function init(){
    notif1=document.getElementById("notif1");
    notif5=document.getElementById("notif5");
    fname=document.getElementById("fname");
    ffname=document.getElementById("ffname");
    gfname=document.getElementById("gfname");
    bplace=document.getElementById("bplace");


    fname.addEventListener('keyup',checkFname,false);
    ffname.addEventListener('keyup',checkLname,false);
    gfname.addEventListener('keyup',checkGname,false);
    bplace.addEventListener('keyup',checkBplace,false);
}

function checkFname(e){
    let regex=/^[a-zA-Z]+$/;
    if(fname.value!=""){
        if(!fname.value.match(regex)){
            e.preventDefault();
            notif1.innerHTML="Invalid first name";
            fname.style.borderColor='#F4432F';
            return false;
        }
    else{
        notif1.innerHTML="";
        fname.style.borderColor=' #cfcfcf';
        return true;
    }
    }
    else{
        notif1.innerHTML="";
        fname.style.borderColor=' #cfcfcf';
    }
}
function checkLname(e){
    let regex=/^[a-zA-Z]+$/;
    if(ffname.value!=""){
        if(!ffname.value.match(regex)){
            e.preventDefault();
            notif1.innerHTML="Invalid father name";
            ffname.style.borderColor='#F4432F';
            return false;
        }
    else{
        notif1.innerHTML="";
        ffname.style.borderColor=' #cfcfcf';
        return true;
    }
    }
    else{
        notif1.innerHTML="";
        ffname.style.borderColor=' #cfcfcf';
    }
}
function checkGname(e){
    let regex=/^[a-zA-Z]+$/;
    if(gfname.value!=""){
        if(!gfname.value.match(regex)){
            e.preventDefault();
            notif1.innerHTML="Invalid grand father name";
            gfname.style.borderColor='#F4432F';
            return false;
        }
    else{
        notif1.innerHTML="";
        gfname.style.borderColor=' #cfcfcf';
        return true;
    }
    }
    else{
        notif1.innerHTML="";
        gfname.style.borderColor=' #cfcfcf';
    }
}

function checkBplace(e){
    let regex=/^[a-zA-Z]+$/;
    if(bplace.value!=""){
        if(!bplace.value.match(regex)){
            e.preventDefault();
            notif1.innerHTML="Invalid birth place ";
            bplace.style.borderColor='#F4432F';
            return false;
        }
    else{
        notif1.innerHTML="";
        bplace.style.borderColor=' #cfcfcf';
        return true;
    }
    }
    else{
        notif1.innerHTML="";
        bplace.style.borderColor=' #cfcfcf';
    }
}

window.onload=init;
</script>
<noscript>
    document.body.innerHTML="Yes";
</noscript>
</body>

<!-- soccer/project/  07 Jan 2020 03:37:22 GMT -->
</html>
