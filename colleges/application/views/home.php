<!DOCTYPE html>
<html lang="en">
<title>Classbroom.me Colleges | A platform to interact with your students</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/w3css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-bell,.fa-sticky-note {font-size:200px}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="https://www.classbroom.me" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <!--<a href="/users/login/" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Login</a>
    <a href="/users/register" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Teacher Registration</a>
  -->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="https://www.classbroom.me" class="w3-bar-item w3-button w3-padding-large">Home</a>
    <!--<a href="/users/login/" class="w3-bar-item w3-button w3-padding-large">Login</a>
    <a href="/users/register" class="w3-bar-item w3-button w3-padding-large">Teacher Registration</a>-->
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">CLASS BROOM'S COLLEGES</h1>
  <p class="w3-xlarge">A platform to interact with your students</p>
  <a href="/users/register" class="w3-button w3-green w3-padding-large w3-large w3-margin-top">Get Started</a>
    <a href="/users/login" class="w3-button w3-blue w3-padding-large w3-large w3-margin-top">Login</a>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Sending Notices To Students Was Never So Easy.</h1>
      <h5 class="w3-padding-32">Hello! Respected faculty, welcome to this portal. Here, you can easily make announcements and can post important notices for your students.
</h5>

      <p class="w3-text-grey">Now, there is no need of notifying students by reaching every class and division. They will be immediately notified as soon as any update or information is posted by you on this portal.</p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-bell fa-6 w3-padding-64 w3-text-red"></i>
    </div>
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-sticky-note w3-padding-64 w3-text-red w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>With Online Attendance Facility</h1>
      <h5 class="w3-padding-32">The traditional way of taking attendance through pen and paper takes time and sometimes creates confusion also.
This platform provides you an accurate, precise and very convenient way to take attendance.
</h5>

      <p class="w3-text-grey">You may edit your attendance sheet, in case you have made any mistake while noting presence. It’s very easy and hustles free. So, no worries if you mark someone absent or present by mistake.
<br>
You can also export your data into an excel sheet and in case you need a hard copy of it for more convenience, you can easily take the printout of it.
</p>
    </div>
  </div>
</div>

<div class="w3-container w3-red w3-center  w3-padding-64">
    <h1 class="w3-margin w3-xlarge">“Let’s get started”</h1>

 <h2 class="w3-margin w3-xlarge">“Sign up now for easy interaction with your students”
</h2>
    <a href="/users/register" class="w3-button w3-green w3-padding-large w3-large w3-margin-top">Get Started</a>
   
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-center w3-opacity">  
  
 <p>&copy; Classbroom.me | All Rights Reserved</a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
