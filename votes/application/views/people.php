<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>
        <a href="/people/search" class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center">
        VOTE YOUR FRIENDS
        </a>
		
	
        <br>
        
        <h3>MOST FAMOUS PEOPLE FROM <b>MITACSC</b></h3> 
        <?php
        echo '<b>From: '.$location->name.'</b><a href="/people/change"> Change</a><hr>  ';
        
        
        
  $i=1;
  foreach($data as $row)
  { 
  
  echo '<a href="/people/vote/'.$row->user_id.'"><b> Name: '.$row->user_fullname.'  <br> ';
  echo "Rank: #".$i." | Total Votes: ".$row->votes."<br>"; 
  echo '<button class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center"><a href="/people/vote/'.$row->user_id.'">+VOTE</a></button><br>'
          . '  <a href="https://api.whatsapp.com/send?text= STUDENTS CORNER: VOTE FOR '.$row->user_fullname.', CLICK HERE https://studcorner.000webhostapp.com/people/vote/'.$row->user_id.'"><img src="/assets/whats.png" height="40px"></a><br>
		  <button class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center"><a href="/people/vote/'.$row->user_id.'">WRITE FOR '.$row->user_fullname.' >></a></button><hr />';
  
  $i++;
  }
  ?>
        
</div>
<?php $this->view('footer'); ?>
</body>
</html>

