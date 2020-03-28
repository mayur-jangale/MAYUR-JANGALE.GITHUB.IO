
<!DOCTYPE html>

<html lang="en">

<title>People | Classbroom.me Students Corner</title>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142168353-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-142168353-1');
</script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-4133302254014421",
          enable_page_level_ads: true
     });
</script>

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
.form-control {
margin: 0px 20px;
width:90%
}
 

</style>

<body> 

    <h1><font size="30" color="red"><b>CLASSBROOM</b></font> <br>STUDENTS CORNER</h1>

    <b><a href="/">Home</a> | <a href="/people/search">Search</a> | 
        <?php if(!$this->session->userdata('isUserLoggedIn')){ ?>
        <a href="/users/">Login</a> | <a href="/users/register">New Profile</a> 
        <?php }else{
            echo '<a href="/users/">Profile</a> | <a href="/users/logout">Logout</a>';
        }?> 
        | <a href="https://www.classbroom.me/more/">Contact/Report</a> | <a href="/winners">Winners</a></b>

    <div class="content"> 