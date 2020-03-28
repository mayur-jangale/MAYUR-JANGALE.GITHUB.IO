<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>
        <form action="/people/results" id="usrform" method="post">
  <input class="form-control" type="text" name="key">
  
<br>
<input class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center" type="submit">
</form>
        <hr>
        <h3>Results:</h3>
        
              <?php
  $i=1;
  foreach($results as $row)
  { 
  
  echo '<a href="/people/vote/'.$row->user_id.'"><b> Name: '.$row->user_fullname.'  <br> ';
  echo "Total Votes: ".$row->votes."<br>"; 

  echo '<button class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center"><a href="/people/vote/'.$row->user_id.'">Vote >></a></button><br>'
          . '  <a href="https://api.whatsapp.com/send?text=MITACSC STUDENTS CORNER: VOTE FOR '.$row->user_fullname.', CLICK HERE https://studcorner.000webhostapp.com/people/vote/'.$row->user_id.'"><img src="/assets/whats.png" height="40px"></a><br>
		  <button class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center"><a href="/people/vote/'.$row->user_id.'">WRITE FOR '.$row->user_fullname.' >></a></button><hr />';
  
  $i++;
  } 
  ?>
     </div>
	 <?php $this->view('footer'); ?>
</body>
</html>

 