
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>
<div class="blank">
    <?php foreach($class as $row){ ?>	
    <h2>Invite For Class <?php echo $row->name ?></h2>
    <div class="blankpage-main">
         <div class="signup-block">
        Please invite students with the following link to join <?php echo $row->name?> class
        <input type="text" value="https://colleges.classbroom.me/students/register/<?php echo $row->rands ?>" id="myInput" >
    <button onclick="myFunction()">Copy</button>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
    </div>
    </div>
    <?php }?>
</div>

<?php $this->view('footer'); ?>   
