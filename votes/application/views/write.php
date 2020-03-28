<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>
        <font color="green"><br><?php echo $this->session->flashdata('msg'); ?><?php echo validation_errors(); ?></font><br>
        <?php

 
    
  
  echo "<b> Name: ".$row->user_fullname."  <br> ";
  echo "Total Votes:".$row->votes." <br>";

  echo '<button class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center"><a href="/people/vote/'.$row->user_id.'">Vote >></a></button>   '
          . '   <a href="https://api.whatsapp.com/send?text= STUDENTS CORNER: VOTE FOR '.$row->user_fullname.', CLICK HERE https://studcorner.000webhostapp.com/people/vote/'.$row->user_id.'"><img src="/assets/whats.png" height="40px"></a>';
      
  ?><hr>	
  <a href="https://votes.classbroom.me/people/search">
        <button class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center"  >>> FIND YOUR FRIENDS >></button>
        </a>
	
        <p><font color="green"><br><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg'); ?></font></p>
        <h3>Write about <?php echo $row->user_fullname ?></h3> 
        <form action="/people/write/<?php echo $row->user_id ?>" id="usrform" method="post">
  Name (optional) <input class="form-control" type="text" name="name">
  
<br>
<textarea class="form-control" rows="4" cols="50" name="comment" form="usrform">
</textarea><br >
<input class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center" type="submit">
</form>
        <hr />
     
        <h3> What People said about <?php echo $row->user_fullname ?></h3> 
   <?php  foreach($comment as $row)
  { 
  if($row->user== null){$a='Anonymous';}else{$a = $row->user;}
  echo "<b> Name: ".$a."  <br> ";
  echo "Written :".$row->comment."</b><br>";
  echo "by:".$row->ip."</b><br>";
  echo '<hr />';
  

      }
  ?>
        
     </div>
	 <?php $this->view('footer'); ?>
</body>
</html>

