<?php
$servername = "localhost";
$username = "lol_db";
$password = "Q.AMv8H0D.fv";
$dbname = "jessore_event";

try {
    $conn = new PDO("mysql:host=$servername;dbname=jessore_event", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS eventUser (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(250) NOT NULL UNIQUE,
    University VARCHAR(250),
    contact_number VARCHAR(250) UNIQUE,
    email VARCHAR(250) UNIQUE,
    seminar1 VARCHAR(250),
    seminar2 VARCHAR(250),
    workshop VARCHAR(250),
    reason text(250),

    reg_date TIMESTAMP
    )";
    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "Table MyGuests created successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$msg=1;

if (isset($_POST['save'])) {

    $full_name = $_POST['full_name'];

    $university = $_POST['university'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
	
		
		if (isset($_POST['seminar'][0])) {
			$seminar1= $_POST['seminar'][0] ;
		} else {
			$seminar1="off";
		}
		
		if (isset($_POST['seminar'][1])) {
			$seminar2= $_POST['seminar'][1] ;
		} else {
			$seminar2="off";
		}
		if (isset($_POST['seminar'][2])) {
			$workshop= $_POST['seminar'][2] ;
		} else {
			$workshop="off";
		}
		
	
    $reason = $_POST['reason'];


    try {
		
		
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO eventUser (Name, University, contact_number,email,seminar1,seminar2,workshop,reason)
        VALUES (:Name, :University, :contact_number,:email,:seminar1,:seminar2,:workshop,:reason)");
        $stmt->bindParam(':Name', $full_name);
        $stmt->bindParam(':University', $university);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':email', $email);
		
	
        $stmt->bindParam(':seminar1', $seminar1);
        $stmt->bindParam(':seminar2', $seminar2);
        $stmt->bindParam(':workshop', $workshop);
		 $stmt->bindParam(':reason', $reason);
		
		if(empty($full_name) OR empty($contact_number) OR empty($email)){
			$msg=5;
		}else{
			$stmt->execute();
			 $msg=2;
		}
       
        // use exec() because no results are returned
       
	  
       //echo "Succcefully Registered for this event";
    } catch (PDOException $e) {
		$sql = "SELECT * FROM eventUser WHERE email='$email'";
			$result = $conn->query($sql);

			if (count($result)> 0) {
					$msg=3;
				//echo "Already Registered for this event";
			}
			else{
				$msg=4;
				//echo "There was a problem. Try again.";
			}
        //echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;


}

?>


<html>
<head>

    <meta charset="utf-8">
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Registration Form</title>
    <!-- ============ Google fonts ============ -->
    <link href='http://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet'
          type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,800'
          rel='stylesheet' type='text/css'/>
    <!-- ============ Add custom CSS here ============ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/style1.css" rel="stylesheet" type="text/css"/>

    <link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand" href="#">Event Registration</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span
                        class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>

    </div>
</div>

<div class="container">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
        <div id="banner">
			
			
            <h1><strong>BHTPA Job Fair-2017 Event Registration Form</strong></h1>


        </div>


    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="registrationform">
            <form class="form-horizontal" method="POST" action="">
                <fieldset>
                 <?php
				if($msg==2){
					echo'<h4>Succesfully Registration completed.</h4>';
				}else if($msg==3){
					echo'<h4>Already Registered for this event.</h4>';
				}else if($msg==3){
					echo'<h4>There was a problem.</h4>';
				}else if($msg==5){
					echo'<h4>Please fill all the field.</h4>';
				}
			?>
                    <div class="form-group">
                        <label for="firstname" class="col-lg-3 control-label">
                            Full Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="firstname" placeholder="" name="full_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-lg-3 control-label">
                            University Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="university" name="university" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_number" class="col-lg-3 control-label">
                            Contact Number</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" id="contact_number" name="contact_number"
                                   placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-3 control-label">
                            Email</label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-3 control-label">
                            Choose Option</label>
                        <div class="col-lg-9">
                            <div class="checkbox">
                                <label><input type="checkbox" name="seminar[]">Where do you want to go, tomorrow</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="seminar[]">Seminar 21st Century Skill</label>
                            </div>
                            <div class="checkbox ">
                                <label><input type="checkbox" name="seminar[]">Effective CV writing and preparation for
                                    Interview</label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-3 control-label">
                            Why do You want to Join?</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="3" id="textArea" name="reason"></textarea>
                            <!--    <span class="help-block">A longer block of help text that breaks onto a new line and
                                    may extend beyond one line.</span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-2">
                            <button type="reset" class="btn btn-warning">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" name="save">
                                Submit
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>


    </div>
</div>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.backstretch.js" type="text/javascript"></script>
<script type="text/javascript">
    'use strict';

    /* ========================== */
    /* ::::::: Backstrech ::::::: */
    /* ========================== */
    // You may also attach Backstretch to a block-level element
    $.backstretch(
        [
            "img/44.jpg",
            "img/colorful.jpg",
            "img/34.jpg",
            "img/images.jpg"
        ],

        {
            duration: 4500,
            fade: 1500
        }
    );
</script>

</body>
</html>