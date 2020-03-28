<!DOCTYPE html>
<html>
<title>RESULT | Classbroom.me Free Tests</title> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142168353-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-142168353-1');
</script>



body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <img src="/logo.png" alt="classbroom.me logo" style="width:65%;" class="w3-round"><br><br>
    <h4><b>TESTS</b></h4>
  
  </div>
  <div class="w3-bar-block"><a href="https://www.classbroom.me"  class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Home</a>     <a href="/"  class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Tests Home</a> 
    <a href="https://social.classbroom.me/"  class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-globe w3-margin-right"></i>Globe</a> 
    <a href="https://notes.classbroom.me/"  class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-pencil-square-o w3-margin-right"></i>Notes</a>
       <a href="https://chat.classbroom.me/"  class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-users w3-margin-right"></i>Practice English</a> 
    <a href="https://resumes.classbroom.me/"  class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-file-text w3-margin-right"></i>Create Free Resume</a>
       <a href="https://votes.classbroom.me/"  class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-list-alt w3-margin-right"></i>Votes</a> 
  </div>

</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <a href="/"><img src="/logo.png" alt="classbroom.me logo" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>Tests</b></h1>
    </div>
  </header>
   <div class="w3-bar-block w3-margin-bottom" style="margin:10px">
        <div class=" w3-white" style="margin:10px; padding:20px">
            <h1>Result:</h1>
            <p>You Answered <?php echo $correct ?> questions correctly out of 20</p>
            <p>Your score is <?php echo ($correct*100)/20 ?>%</p>
            <a href="/" style="margin-bottom:10px" class="w3-button w3-teal w3-padding-large w3-hover-black">Attend the exam again</a>
</form>
</div>
</div>
  <div class="w3-black w3-center w3-padding-24">&copy; CLASSBROOM.ME | ALL RIGHTS RESERVED</a></div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
