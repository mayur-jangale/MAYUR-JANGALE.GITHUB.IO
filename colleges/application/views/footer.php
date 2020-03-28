</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<center><a href="https://www.classbroom.me">Home</a> | <a href="https://social.classbroom.me">Globe</a> | <a href="https://chat.classbroom.me">English Practice</a> | <a href="https://test.classbroom.me">Tests</a> | 
<a href="https://forum.classbroom.me">Questions</a> | <a href="https://notes.classbroom.me">Notes</a> | <a href="https://dictionary.classbroom.me">Dictionary</a> 
</center>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© Classbroom.me - All Rights Reserved | Template Donated by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
                          <?php if($user['type']==0){?>
		        <li id="menu-home" >
                            <a href="/users/dash"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li><a href="/announcement"><i class="fa fa-bullhorn"></i><span>Announce</a></li>
		        <li><a href="/classroom"><i class="fa fa-graduation-cap"></i><span>Classrooms</span></span></a></li>
		        <li><a href="/classroom/newclass"><i class="fa fa-plus nav_icon"></i><span>New Classroom</span></span></a></li>
		         <li><a href="/attend"><i class="fa fa-file-text"></i><span>Attendance</span></a></li>
		        <li><a href="/attend/edit/"><i class="fa fa-pencil-square-o"></i><span>Edit Attendance</span></a></li>
		        <li><a href="/attend/export"><i class="fa fa-bar-chart"></i><span>Export Attendance</span></a>
			<!--	<li><a href="/import"><i class="fa fa-cloud-upload"></i><span>Import Students</span></a>-->
                          <?php }else { ?>
                             <li id="menu-home" >
                            <a href="/users/dash"><i class="fa fa-tachometer"></i><span>Home</span></a></li>
                       
                        <?php } ?>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div> 
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="/js/jquery.nicescroll.js"></script>
		<script src="/js/scripts.js"></script>
		<!--//scrolling js-->
<script src="/js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>   