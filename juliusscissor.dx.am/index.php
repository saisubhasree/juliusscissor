<?php 
// The following code extracts information from contact us form and sends mail to the admin along with form fields

if (isset($_POST['sendemail'])) {
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $first=$_POST['first'];
        $last=$_POST['last'];
        $phone = $_POST["phone"];
        $body=$_POST['message']." Phone Number: ".$_POST['phone']." Email ID: ".$_POST['email'];
        $email=$_POST['email'];
        $subject="Email from Contact Us Section - ".$first." ".$last;
        $to='team29@juliusscissor.dx.am';
        $headers = "From:" . $email;
        $headers = array(
            'From' => $email,
            'Reply-To' => $to,
            'X-Mailer' => 'PHP/' . phpversion()
        );
        $val = mail($to, $subject, $body, $headers);
        //success message is shown at the top of the index page
        $success_email_msg = "<div class='w3-container'><div class='w3-panel w3-pale-green w3-leftbar w3-rightbar w3-border-green'><p>Email sent successfully!</p></div></div>";
        echo $success_email_msg; 

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Julius Scissor</title>
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
        
<style> 

/*This is to make the required field star red in color*/

 .required-style {
  border: none;
  font-weight: bold;
  color: #ff0000;
 }
 
</style>

</head>
<body>

<!-- Navigation -->
<!--following code is for navigation bar, it is responsive and compresses in a burger, it has sticky-top class to let it stick while scrolling-->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img class="navbar-logo" src="img/IS_logo3_transparent.png"></a>
		<p class="navbar-title">JULIUS SCISSOR</p>
                <!-- Following three lines are for the burger button for responsiveness -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
                        <!-- Following are the items in the nav bar that link to other pages -->
				<li class="nav-item active">
					<a class="nav-link" href="index.php">HOME</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#aboutUs">ABOUT US</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="stylists_link.php">OUR STYLISTS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#services">SERVICES</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#contact">CONTACT</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="appointment.php">APPOINTMENTS</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<!--- Image Slider -->
<div id="slides" class="carousel slide" data-ride="carousel">
        <!-- Following carousel is set as a list of three slides -->
	<ul class="carousel-indicators">
		<li data-target="#slides" data-slide-to="0" class="active"></li>
		<li data-target="#slides" data-slide-to="1"></li>
		<li data-target="#slides" data-slide-to="2"></li>
	</ul>
        <!-- following are the set of images and captions with it -->
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="img/background11.jpg">
			<div class="carousel-caption">
				<h1 class="display-2">Take an Appointment!</h1>
				<h3>Your one stop solution is <i>hair...</i></h3>
				<button type="button" class="btn btn-outline-light btn-lg" onclick="document.location.href = 'appointment.php';">Book</button>
			</div>
		</div>
		<div class="carousel-item">
			<img src="img/background12.jpg">
			<div class="carousel-caption">
				<h1 class="display-2">We are a match (po)made in heaven</h1>
				
			</div>
		</div>
		<div class="carousel-item">
			<img src="img/background13.jpg">
                        <div class="carousel-caption">
				<h1 class="display-2">We <i>shear</i> your passion for good looks.</h1>
				
			</div>
		</div>
	</div>
</div>

<!--- Jumbotron -->


<!--- Welcome Section -->
<div class="container-fluid padding">
<div class="row welcome text-center">

	<div class="col-12">
		<h1 class="display-4"> Built for Men. </h1>
  	</div>
  	<hr>

  	<div class="col-12">
  		<p class="lead"> Welcome to Julius Scissor! We revolutionized the men's salon. We are the pioneers in modern hair styles for men with unparalleled high quality customer service </p>
  	</div>

</div>
</div>


<!--- Three Column Section -->
<div class="container-fluid padding">
<div class="row text-center padding">
	<div class="col-xs-12 col-sm-6 col-md-4">

		<i class="fas fa-male"></i>
		<h3>For Men</h3>
		<p>Our salon is tailor fit for men</p>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-4">

		<i class="fas fa-cut"></i>
		<h3>HairStyles</h3>
		<p>We have all the latest hairstyles</p>
    </div>

    <div class="col-sm-12 col-md-4">

		<i class="fas fa-heart"></i>
		<h3>Love</h3>
		<p>Our secret tool is love </p>
    </div>
</div>
<hr class="my-4">
</div>

<!--- Two Column Section -->
<div class="container-fluid padding">
<div class="row padding">
	<div class="col-lg-6" id="aboutUs">
		<h2> About Us </h2>
		<p> We have created history in hairdressing. We are the first men-only hair salon in the world since 1851. Grooming and hairdressing is often perceived to be feminine and not something men would need. But, we believe in equality and men deserve as much care and attention as women do when it comes to looking good.</p>
		<br>
		<p> Be it any wedding, interview or you have a woman to impress. We have your back. We have the world's finest hairstylists who have pursued the art of hairdressing for more than a decade and have done extensive research. We strive to provide high quality hair services with good comfort and satisfaction all at affordable prices.</p>
        <br>
	</div>
	<div class="col-lg-6">
		<img src="img/white-and-brown-chairs-inside-a-salon-705255.jpg" class="img-fluid">
	</div>
</div>
<hr class="my-4">
</div>

<!--- Fixed background -->
<!-- following div accomodates the parallax effect and is styled using the class parallax in css -->
<div class="parallax"></div>

<!--- Emoji Section -->

  
<!--- Meet the team -->

<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Meet the Team</h1>
		</div>	
		<hr>
	</div>
</div>


<!--- Cards -->
<!-- Used four cards for meet the team section, the bootstrap class used in card-img-top that has image on top of text, each button in card is linked to our linkedIn profiles -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-md-3 col-sm-6">
			<div class="card">
				<img class="card-img-top" src="img/shreyank2.jpg">
				<div class="card-body">
					<h4 class="card-title">Shreyank Prabhu</h4>
					<p class="card-text">He is a student at TAMU and is completing his degree in MIS</p>
					<a href="https://www.linkedin.com/in/shreyank-prabhu/" target = "_blank" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 col-sm-6">
			<div class="card">
				<img class="card-img-top" src="img/harmit2.jpg">
				<div class="card-body">
					<h4 class="card-title">Harmit Jasani</h4>
					<p class="card-text">He is a student at TAMU and is completing his degree in MIS</p>
					<a href="https://www.linkedin.com/in/harmitjasani/" target = "_blank" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 col-sm-6">
			<div class="card">
				<img class="card-img-top" src="img/sai.jpg">
				<div class="card-body">
					<h4 class="card-title">Sai Pakina</h4>
					<p class="card-text">She is a student at TAMU and is completing her degree in MIS</p>
					<a href="https://www.linkedin.com/in/saisubhasree/" target = "_blank" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 col-sm-6">
			<div class="card">
				<img class="card-img-top" src="img/mihir.jpg">
				<div class="card-body">
					<h4 class="card-title">Mihir Bhende</h4>
					<p class="card-text">He is a student at TAMU and is completing his degree in MIS</p>
					<a href="https://www.linkedin.com/in/mihir-bhende/" target = "_blank" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!--- Two Column Section -->
<!-- This section is composed of three cards and each card has image along with text side by side -->
<div class="container-fluid padding" id="services">
<div class="row padding service-bg-colour">
<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Our Services</h1>
		</div>	
		<hr>
	</div>
</div>

<div class="card mb-3 shadow-effect">
  <div class="row no-gutters">
    <div class="col-md-4" style="padding: 10px;">
      <img src="img/service1.jpg" class="card-img service-image-temp img-thumbnail" alt="haricut service 1">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h3 class="card-title">Kewl Hairstyles!</h3>
        <p class="card-text">We have the most modern and fancy looking hairstyles at our shop. Each of them are done by our expert stylists who have over ten years of experience. We have been in this industry for 30 years and we wish the best for our customers.You can select any haristyle you wish with our guidance and be assured you will always leave happy from our store.</p>
        <p class="card-text"><small class="text-muted">"Kewl Hairstyles maketh a man"</small></p>
      </div>
    </div>
  </div>
</div>


<div class="card mb-3 shadow-effect">
  <div class="row no-gutters">
    
    <div class="col-md-8">
      <div class="card-body">
        <h3 class="card-title">30 years of experience</h3>
        <p class="card-text">We pride ourselves on our experience in this field. We have groomed our stylists to be the best in the idustry. Our barber shop was one of the first in the city and over the years we have won many accolades. You can always count on us for the best hairstyle. You can also provide us feedback on your hairstyle so that we can contantly improve our styles.</p>
        <p class="card-text"><small class="text-muted">"This is the best barber shop"</small></p>
      </div>
    </div>
    <div class="col-md-4" style="padding: 10px;">
      <img src="img/service2.jpg" class="card-img service-image-temp img-thumbnail" alt="...">
    </div>
  </div>
</div>

<div class="card mb-3 shadow-effect">
  <div class="row no-gutters">
    <div class="col-md-4" style="padding: 10px;">
      <img src="img/service3.jpg" class="card-img service-image-temp img-thumbnail" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h3 class="card-title">Best in class</h3>
        <p class="card-text">Our website allows you to book appointments online so that you never have to wait. We value peoples' time and therefore this feature has been our priority. This website allows you to read about stylists and know them better before placing your hairstyle in their safe hands. This website is our online catalog that lets you know our expertise in this field.</p>
        <p class="card-text"><small class="text-muted">"Only we are the best"</small></p>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<hr class="my-4">
</div>

<!-- contact me -->
<!-- This section is a form with action post, it provdies details for the php script at the top of this code, this form sends email to the admin of the page -->
<div class="contact-me col-lg-12">
	<div class="col-lg-12" id="contact">
		<form method = "POST" action="" class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin contact-form">
		<h2 class="title-contact w3-center">Contact Us</h2>

		<div class="w3-row w3-section">
		  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
		    <div class="w3-rest">
                      <abbr title="Required" class="required-style">*</abbr> First Name:
		      <input class="w3-input w3-border" name="first" type="text" placeholder="John" required="required" aria-required="true" pattern="^([- \w\d\u00c0-\u024f]+)$" title="Your name (no special characters, diacritics are okay)" type="text" spellcheck="false" size="20">
		    </div>
		</div>

		<div class="w3-row w3-section">
		  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
		    <div class="w3-rest">
                      <abbr title="Required" class="required-style">*</abbr> Last Name:
		      <input class="w3-input w3-border" name="last" type="text" placeholder="Doe" required="required" aria-required="true" pattern="^([- \w\d\u00c0-\u024f]+)$" title="Your name (no special characters, diacritics are okay)" type="text" spellcheck="false" size="20">
		    </div>
		</div>

		<div class="w3-row w3-section">
		  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-envelope"></i></div>
		    <div class="w3-rest">
                      <abbr title="Required" class="required-style">*</abbr> Email:
		      <input class="w3-input w3-border" name="email" type="email" placeholder="johndoe@gmail.com" required="required" aria-required="true" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" title="Your email address" type="email" spellcheck="false" size="30">
		    </div>
		</div>

		<div class="w3-row w3-section">
		  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
		    <div class="w3-rest">
                      <abbr title="Required" class="required-style">*</abbr> Phone number:
		      <input class="w3-input w3-border" name="phone" type="text" placeholder="XXXXXXXXXX" required="required" aria-required="true" pattern="[1-9]{1}[0-9]{9}" title="Your phone number (10 digits only)">
		    </div>
		</div>

		<div class="w3-row w3-section">
		  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-pencil-alt"></i></div>
		    <div class="w3-rest">
                      <abbr title="Required" class="required-style">*</abbr> Message:
		      <textarea class="w3-input w3-border" name="message" type="text" placeholder="Please type your message here" required="required" aria-required="true" title="Your message" spellcheck="true" cols="40" rows="5"></textarea>
		    </div>
		</div>

		<button type="submit" name="sendemail" class="w3-button w3-block w3-section w3-black w3-ripple w3-padding">Send</button>

		</form>
	</div>
</div>

<script>

//This function is invoked when there is an onChange event that is tied to the Contact Form above

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
  document.getElementsByTagName("input"),
  document.getElementsByTagName("textarea")
];
for (var a = fields.length, i = 0; i < a; i++) {
  for (var b = fields[i].length, j = 0; j < b; j++) {
    addEvent(fields[i][j], "change", function(e, target) {
      instantValidation(target);
    });
  }
}

</script>


<hr class="my-4"> 

<!--- Connect -->
<!-- Bootstrap is used to split each portion by 3 columns for large screens and two for mobile -->
<div class="container-fluid padding">
<div class="row text-center padding">
	<div class="col-12">
			<h2> Connect </h2>
	</div>
        <!-- Each glyph is linked to social media sites -->
	<div class="col-12 social padding">
                <a href="https://www.instagram.com/?hl=en"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
		<a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
		<a href="https://www.google.com/"><i class="fab fa-google-plus-g"></i></a>
	</div>

</div>
</div>


<!--- Footer -->
<!-- the footer section consists of details split in columns of 4 in bootstrap, at the end the button direct users to admin login -->
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















 

