<!DOCTYPE html>

<html lang="en">

<title>Dictionary ClassBroom.me </title>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

<style>


body,h1 {font-family: "Raleway", sans-serif}

body{ max-width: 500px;

  margin: auto;

  border: 3px solid red;

  text-align: center;

}

.what{
   
    padding: 10px;
}

.content{

    border: 3px solid red;

    padding: 10px;

}

 

</style>

<body>

    <h1><font size="30" color="red"><b>CLASSBROOM.ME</b></font> <br>DICTIONARY</h1>

   
    <div class="content"> 

<?php

if(isset($_GET['word']))
{
$servername = "localhost";
//enter the credentials bellow
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$word= ucfirst($_GET['word']);


$sql = "SELECT * FROM entries where word='".$word."' limit 10";
$result = $conn->query($sql);
$head= '<form action="" method="get"><p>Enter the word </p><input type="text" name="word"><input type="submit" value="check"></form>';

echo $head;
if ($result->num_rows > 0) {
    
	echo  "<h2>".$word."</h2><hr>";
    while($row = $result->fetch_assoc()) {
		 echo  "Type:<i>".$row["wordtype"]."</i>";
        echo  "<p>".$row["definition"]."</p><hr>";
	
		
		
		
		
    }
} else {
    echo "<hr>".$word." Not Present in database<hr>";
}
$conn->close();

}
else
{?>
<form action="" method="get">
<p>Enter the word </p><input type="text" name="word">
<input type="submit" value="check">
</form>
	<hr>
	
	
	
	
	
	
<?php }


?><a href="https://www.classbroom.me">Home</a> | <a href="https://social.classbroom.me">Globe</a> | <a href="https://chat.classbroom.me">English Practice</a> | <a href="https://test.classbroom.me">Tests</a> | <a href="https://votes.classbroom.me">Votes</a> | <a href="https://notes.classbroom.me">Notes</a> | <a href="https://forum.classbroom.me">Questions</a> 
<hr>
<b>&copy CLASSBROOM.ME | ALL RIGHTS RESERVED</b>