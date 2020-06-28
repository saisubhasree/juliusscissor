<?php

//creating connection with the database, using server name, username, password, database

        $servername = "fdb22.awardspace.net";
        $username = "2846112_db";
        $password = "js123!@#";
        $dbname = "2846112_db";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
//Cancelling connection to the database and displaying error message if it fails

        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        
        date_default_timezone_set("America/Chicago");
?>
        
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Julius Scissor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiri">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  
  
  <style>
  
  /* Styling for w3css card that is displayed as a form on the page */
  .padding {
      padding-left:20%;
      padding-right:20%;
      padding-top: 5%;
    }
    
  /* Styling for javascript validation of the form to highlight invalid data */
  form input[aria-invalid="true"] {
  border: 1px solid #ff0000;
  box-shadow: 0 0 4px 0 #ff0000;
 }

/* Styling for the requiref field to be displayed in red */
 .try{
  border: none;
  font-weight: bold;
  color: #ff0000;
 }
  </style>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img class="navbar-logo" src="img/IS_logo3_transparent.png"></a>
		<p class="navbar-title">JULIUS SCISSOR</p>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php">HOME</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#aboutUs">ABOUT US</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="stylists_link.php">OUR STYLISTS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#services">SERVICES</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#contact">CONTACT</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="appointment.php">APPOINTMENTS</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="w3-row-padding padding">

<!-- HTMl form to make an appointment -->

<form class="w3-container w3-animate-left w3-card-4" action="appointment_form1.php" method="POST"> 

  <div style="float:left">
 	<img src="img/mascot.jpg" class="mascot-img">	
  </div>
  <br>
  <center><h2>Make Appointment</h2></center>
  <br>
  <abbr title="Required" class="try">*</abbr> First Name: 
  <input id="fname" class="w3-input" type="text" placeholder="John" style="width:30%" name="fname" required="required" aria-required="true" pattern="^([- \w\d\u00c0-\u024f]+)$" title="Your name (no special characters, diacritics are okay)" type="text" spellcheck="false" size="20">
  <br>

  <abbr title="Required" class="try">*</abbr> Last Name: 
  <input id="lname" class="w3-input" type="text" placeholder="Doe" style="width:30%" name="lname" required="required" aria-required="true" pattern="^([- \w\d\u00c0-\u024f]+)$" title="Your name (no special characters, diacritics are okay)" type="text" spellcheck="false" size="20">
  <br>

  <abbr title="Required" class="try">*</abbr> Email: 
  <input id="email" class="w3-input" type="email" placeholder="johndoe@example.com" style="width:30%" name="email" required="required" aria-required="true" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" title="Your email address" type="email" spellcheck="false" size="30" />
  <br>

  <abbr title="Required" class="try">*</abbr> Phone Number: 
  <input id="cell_number" class="w3-input" type="text" placeholder="XXXXXXXXXX" style="width:30%" name="cell_number" required="required" aria-required="true" pattern="[1-9]{1}[0-9]{9}" title="Your phone number (10 digits only)">
  <br>
  
  <abbr title="Required" class="try">*</abbr> Choose your Timeslot for <?php echo date("m/d/Y", strtotime('tomorrow'))?>:
  <select class="w3-select box" id="time" name="option" required="required" aria-required="true">
    <option value="" disabled selected>Time slot</option>
    
<?php 

//php code to dynamically update the available timeslots on the appointments form page
// Fetch all timeslots from the timeslots table

       $slot_info = "SELECT timeslot_duration FROM timeslots;";
        date_default_timezone_set("America/Chicago");

        $all_slots = mysqli_query($conn, $slot_info);
        
// Iterate through each timeslot by joining appointments on each timeslot and for each day
// Count the number of hairstylists that are free for each timeslot by using status column and performing left join on timeslot
// If the count reaches the mazimum number of customers who can be accomodated, then that option is disabled from the html form, otherwise the remaining number of appointments is displayed
        while($slot_entry = mysqli_fetch_assoc($all_slots)) {
                $slot_duration = $slot_entry['timeslot_duration'];
                $appt = "select t.timeslot_duration AS slot, count(a.appt_id) as appt_count, (select count(hairstylist_id) as max_customers 
                from hairstylists where status = 'A') as max_customers 
                from timeslots t LEFT join (select * from appointments 
                where appt_status <> 'Canceled' and date_appt = DATE(CONVERT_TZ(date_add(now(),INTERVAL 1 DAY),'+00:00','-5:00'))) a 
                ON t.timeslot_id = a.timeslot_id GROUP by slot order by t.timeslot_id;";
                $appointments_info = mysqli_query($conn, $appt);        
                while($appointment = mysqli_fetch_assoc($appointments_info)) {
                $slot = $appointment['slot'];
                $appt_count = $appointment['appt_count'];
                if($slot_duration==$slot) {
                        $max_customers = $appointment['max_customers'];
                        $max_permissible_customers = $max_customers - $appt_count;
                          ?>
                        
                        <option value="<?php echo $slot;?>" <?php 
                        if($max_permissible_customers == 0) 
                        {echo "disabled";
                        } ?>><?php echo $slot?> | <?php echo $max_permissible_customers?> more customer<?php 
                        if($max_permissible_customers=1)
                        {echo "s";}
                        ?> can be accommodated</option>
                        
                        <?php 
                }
                
        }
        
        }
        
        
        
        
    ?>
    

  </select>

  <br><br>

  <br><br>
  <center><p><input type="submit" class="w3-btn w3-black" name="submit" value="Book Appointment"/></p></center>
  

</form>


<!--</div>-->

<br><br>

<!-- HTML Form to retrieve an existing appointment -->
<!-- We take both appointment id and email id of the customer to make sure the database fetches the right appointment of the customer -->
<form class="w3-container w3-animate-right w3-card-4" action="appointment_form2.php" method="POST">
  <center><h2>Retrieve appointment</h2></center>
  <br>
  <abbr title="Required" class="try">*</abbr>
  Appointment ID: <input class="w3-input" type="text" style="width:50%" name="appt_id" required="required" aria-required="true" pattern="^[1-9]\d*$" title="Your Appointment ID">
  <br>
  <abbr title="Required" class="try">*</abbr>
  Email ID: <input class="w3-input" type="email" style="width:50%" name="email_id" placeholder="johndoe@example.com" required="required" aria-required="true" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" title="Your email address" spellcheck="false" size="30">
  <br>

  <center><p><input type="submit" class="w3-btn w3-black" name="submit" value="Retrieve Appointment" /></p></center>

</form>
<br><br>


<!-- HTML Form to delete an existing appointment -->
<!-- We take both appointment id and email id of the customer to make sure the database changes the status of the right appointment of the customer -->
<form class="w3-container w3-animate-right w3-card-4" action="appointment_form3.php" method="POST">
<div style="float:left">
 	<img src="img/mascot.jpg" class="mascot-img">	
  </div>
  <br>
  <center><h2>Delete appointment</h2></center>
  <br>
  <abbr title="Required" class="try">*</abbr>
  Appointment ID: <input class="w3-input" type="text" style="width:50%" name="appt_id" required="required" aria-required="true" pattern="^[1-9]\d*$" title="Your Appointment ID">
  <br>
  <abbr title="Required" class="try">*</abbr>
  Email ID: <input class="w3-input" type="email" style="width:50%" name="email_id" placeholder="johndoe@example.com" required="required" aria-required="true" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" title="Your email address" spellcheck="false" size="30">
  <br>

  <center><p><input type="submit" class="w3-btn w3-black" name="submit" value="Delete Appointment" /></p></center>

</form>


</div>

<br><br>

<!-- Javascript code for html form validation of all the three forms -->

<script>

//This function is invoked on an onChange event which is triggered when the field value of the input tags changes

function addEvent(node, type, callback) {
  if (node.addEventListener) {
    node.addEventListener(
      type,
      function(e) {
        callback(e, e.target);
      },
      false
    );
  } else if (node.attachEvent) {
    node.attachEvent("on" + type, function(e) {
      callback(e, e.srcElement);
    });
  }
}

//identify whether a field should be validated
//ie. true if the field is neither readonly nor disabled,
//and has either "pattern", "required" or "aria-invalid"
function shouldBeValidated(field) {
  return (
    !(field.getAttribute("readonly") || field.readonly) &&
    !(field.getAttribute("disabled") || field.disabled) &&
    (field.getAttribute("pattern") || field.getAttribute("required"))
  );
}

//field testing and validation function
function instantValidation(field) {
  //if the field should be validated
  if (shouldBeValidated(field)) {
    //the field is invalid if:
    //it's required but the value is empty
    //it has a pattern but the (non-empty) value doesn't pass
    var invalid =
      (field.getAttribute("required") && !field.value) ||
      (field.getAttribute("pattern") &&
        field.value &&
        !new RegExp(field.getAttribute("pattern")).test(field.value));

    //add or remove the attribute is indicated by
    //the invalid flag and the current attribute state
    if (!invalid && field.getAttribute("aria-invalid")) {
      field.removeAttribute("aria-invalid");
    } else if (invalid && !field.getAttribute("aria-invalid")) {
      field.setAttribute("aria-invalid", "true");
    }
  }
}

//now bind a delegated change event
//== THIS FAILS IN INTERNET EXPLORER <= 8 ==//
//addEvent(document, 'change', function(e, target)
//{
//  instantValidation(target);
//});

//now bind a change event to each applicable for field
var fields = [
  document.getElementsByTagName("input")
];
for (var a = fields.length, i = 0; i < a; i++) {
  for (var b = fields[i].length, j = 0; j < b; j++) {
    addEvent(fields[i][j], "change", function(e, target) {
      instantValidation(target);
    });
  }
}

</script>

<!--- Footer -->
<footer>
<div class="container-fluid padding">
<div class="row text-center">
	<div class="col-md-4">
		<center><hr class="light"></center>
		<p>555-555-5555</p>
		<p>team29@tamu.edu</p>
		<p> College Station, TX, 77840 </p>
	</div>

	<div class="col-md-4">
		<center><hr class="light"></center>
		<h5>Our hours</h5>
		<center><hr class="light"></center>
		<p>Monday to Sunday: 8 am - 6 pm </p>
		<p>Contact us: 24/7 </p>
		<p>Public Holidays: closed </p>
	</div>

	<div class="col-md-4">
		<center><hr class="light"></center>
		<h5>Service Areas</h5>
		<center><hr class="light"></center>
		<p>San Francisco, CA, 94102  </p>
		<p>Seattle, WA, 98105 </p>
		<p>New York, NY, 10001</p>
	</div>

	<div class="col-12">
                <button type="button" class="btn btn-outline-light btn-lg" onclick="document.location.href = 'login.php';">Login as Admin</button>
		<br><br>
		<center><hr class="light-100"></center>
		<h5>&copy; Developed by Team 29 </h5>
	</div>	
</div>
</div>
</footer>

</body>
</html>