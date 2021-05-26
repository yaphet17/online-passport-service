# online-passport-service
This a simple web based passport service  that allows applicants to  secure an appointment for passport issuance.
I designed this website for my 3rd year fundamental of software engineering course project.All necessary files are included and follow the steps below to test it in your device.
-----User guide line-----
    1.First install XAMPP or other php localhost servers  and Thunderbird email application(if you use other applications modify accordingly) in your computer
    2.Place OPS folder where you install your localhost server(installedfolder/XAMPP/htdocs)
    3.Open XAMPP control panel
    4.Start Apache, MySQL and Mercury server
    5.Open PhpMyAdmin using "http://localhost/phpmyadmin/" in your browser adress field
    6.Import ops.sql to phpmysql (ops.sql is provided in the ops/database folder)
    7.Modify database configuration in config.php phpMyAdmin configuration
    8.Use "http://localhost/ops/index.php" or "http://localhost/ops/" to use the system as an applicant
    9.Use "http://localhost/ops/admin-login.php" to use the system as an adminitrator
        -User Name: yafet123
        -Password: 123
    10.Some part of the system requires email services so don't forget to configure email services and modifying your php.ini file
