<?php 
include "db_conn.php";
$msg = "";
if(isset($_POST['addBtn']))
   {	
$name = $_POST['name'] ;
$email = $_POST['email'] ;
$phone = $_POST['phone'] ;
$message = $_POST['message'] ;
$image_url = "";
$msg = "";


 $secret = "6LeYDy4hAAAAAN1Td_kQ_Lzc7eIyNpAZRcKw6Ll0";
  $response = $_POST['g-recaptcha-response'];
  $remoteip = $_SERVER['REMOTE_ADDR'];
  $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";



if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone'])   ) {
            $msg = "<div class='alert alert-danger'>All fields are required.</div>";
			 
        }else{
		/*var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));*/
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
                  $msg = "<div class='alert alert-danger'>Enter a valid email.</div>";
            }else {
				if (preg_match('/^[0-7]{9}+$/', $phone)) {
                     $msg = "<div class='alert alert-danger'>Invalid Phone Number</div>";
                }else {
                
                    
             

$valid_extensions = array('jpeg', 'jpg', 'png'); 
$path = 'images/'; 

if($_FILES['img'])
{
$img = $_FILES['img']['name'];
$tmp = $_FILES['img']['tmp_name'];

$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

$final_image = rand(1000,1000000).$img;

if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 

if(move_uploaded_file($tmp,$path)) 
{

$image_url = $path;
$SQL = "INSERT INTO user(name,email,phone,message,image_url) VALUES ('$name','$email','$phone','$message','$image_url')";
if(mysqli_query($conn,$SQL))
{
$msg = "<div class='alert alert-success'>sending completed.</div>";  
}else{
$msg = "<div class='alert alert-danger'>Error in SQL.</div>";
} 

}
} 
else 
{
$msg = "<div class='alert alert-danger'>ONLY jpeg , jpg , png = valid extensions.</div>";  
}
}else{
  $msg = "<div class='alert alert-danger'>please select photo to upload.</div>";  
}


                    }
		        }
               
		    }
		
		
}

?>
<html>
    <head>
        
       
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  
    <link rel="stylesheet" href="style.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
      rel="stylesheet" />
	   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>

       
 <form  method="post" enctype="multipart/form-data">
      <h1>Formulaire</h1>
	   <?php echo $msg; ?>
      <div class="separation"></div>
      <div class="corps-formulaire">
        <div class="gauche">
          <div class="groupe">
            <label>Votre Prénom</label>
            <input type="text" name="name"class="input"  placeholder="Enter your full name" />
            <i class="fas fa-user"></i>
          </div>
          <div class="groupe">
            <label>Votre adresse e-mail</label>
            <input type="text" name="email" class="input"  placeholder="Enter your email"   />
            <i class="fas fa-envelope"></i>
          </div>
          <div class="groupe">
            <label>Votre téléphone</label>
            <input type="text" name="phone" class="input"  placeholder="Enter your phone number"  />
            <i class="fas fa-mobile"></i>
          </div>
        </div>
        <div class="droite">
          <div class="groupe">
            <label>Message</label>
            <textarea  name="message" class="input"  placeholder="Saisissez ici..." > </textarea>
          </div>
        </div>
      </div>
	    <label for="img">Select image:</label>
		<input type="file" id="img" name="img" accept="image/*">
		<br>
		<br>
		    <div class="row">
      <div class="g-recaptcha" data-sitekey="6LeYDy4hAAAAAM-LAjSrumIXaLABhIJ0Vb44u4os"></div>
    </div>
		<br>
	        <button name="addBtn" class="btn">Envoyer le message</button>
	</form>




</body>
</html>