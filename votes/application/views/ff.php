<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head'); ?>
        <h3> FIND FRIENDS FROM YOUR CLASS</h3>
   <font color="green"><br><?php echo $this->session->flashdata('msg'); ?></font><br>
      <font color="green"> <?php echo validation_errors(); ?></font>
        <form action="/people/friends" id="usrform" method="post">
            
  Year: <select name="year" class="form-control" >
  <option value="F">First Year</option>
  <option value="S">Second Year</option>
  <option value="T">Third Year</option>
</select>
  Division: Year: <select name="div" class="form-control" >
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
  <option value="D">D</option>
  <option value="E">E</option>
  <option value="F">F</option>
  <option value="G">G</option>
  <option value="H">H</option>
  <option value="I">I</option>
  <option value="J">J</option>
  <option value="K">K</option>
  <option value="L">L</option>
  <option value="M">M</option>
  <option value="N">N</option>
  <option value="O">O</option>
  <option value="P">P</option>
</select>
<br>
<input class="w3-btn w3-ripple w3-red w3-border w3-border-red  w3-round-large center" type="submit" value="Find Friends">
</form>
</div>
<?php $this->view('footer'); ?>
</body>
</html>



