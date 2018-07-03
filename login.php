 <?php
    $error="";
    $dbhost='localhost';
    $dbuser='root';
    $conn= mysqli_connect($dbhost,$dbuser);
    $myusername="";
    $rand=substr(rand(),0,4);
    
     if(!$conn)
    {
      die('could not connect'.mysql_error());
    }
     mysqli_select_db($conn,'hari_db');
     session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
      $mycaptcha  = $_POST['captcha'];
      $mypassword = hash('sha512', $mypassword); 
      
      $sql = "SELECT id FROM user WHERE name = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $uid = $row['id'];
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 ro

      if($count == 1 && $_SESSION['r']==$mycaptcha ) {
    
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $_SESSION['login_id'] = $uid;
         header("location: welcome.php");
      }
      else if($count == 1 && $_SESSION['r']!=$mycaptcha)
        {
          $error = "Your captcha is invalid  ";
        }
        else if($count != 1&& $_SESSION['r']==$mycaptcha)
        {
          $error = "Your User Name or Password is invalid  ";
        }
      else {
         $error = "Your User Name or Password and captcha is invalid";
      }
   }
?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
    	<meta charset="utf-8" description="designing a login page" >
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Login Page</title>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <style type="text/css">
          body {background-image: url("social3.jpg");}           
          header {
                   padding: 30px 50px 10px 50px;
                 }	
          h1    {
                  /*color: red;*/
                  text-align: center;
                  font-size: 50px;
                  text-shadow: 4px 1px 2px red, 0 0 2em blue, 0 0 0.5em blue;
                 }
          #log   {
                  padding-top: 20px;
                  padding-left: 220px;
                  font-size: 40px;
                  font-weight: bold;
                  color: rgba(42,91,30,0.8);     
                  font-style: italic;
                  font-stretch: 20px   	
                }
          #details{
                    padding-top: 25px;
                    padding-left: 250px;
                    padding-right: 
                   }
          #cont   {
                    align-content: center;
                    /*border-color:black;
                    border-style: solid;
                    border-width: 5px;
                    border-radius: 1px;*/
                    margin: auto;
                    
                   }
          input[type=text] {
                    width: 33%;
                    color: black;
                    padding: 10px 10px 10px 10px;
                    margin: 10px 0;
                    border: 5px solid;
                    border-color: rgb(180,180,180);
                    height: 
                    }         
          input[type=password] {
                    width: 33%;
                    color: black;
                    padding: 10px 10px 10px 10px;
                    margin: 10px 0;
                    border: 5px solid;
                    border-color: rgb(180,180,180);
                    height: 
                    }
           input[type=submit] {
                     width: 19%;
                     background-color: blue;
                     color: white;
                     padding: 14px 20px;
                     margin: 8px 0;
                     border: 3px solid;
                     border-radius: 4px;
                     cursor: pointer;
                     }  
           #register {    
           	            width: 15%;
           	            background-color: red;
           	            color: white;
           	            padding: 14px 20px 15px;
           	            height: 20%;
           	            text-align: center; 
           	          }
            #recem {    
                        width: 15%;
                        background-color: red;
                        color: white;
                        padding: 14px 20px 15px;
                        height: 20%;
                        text-align: center; 
                      }
           #su       {

                       padding-left: 250px;

                      }     
        </style>
        <!-- Jquerry animation slides-->

        <script>
      /*Dynamic background with jquerry        
               $(document).ready(function() {
                var urls = ['social.jpg','social2.jpg', 'social3.jpg'];

               var cout = 1;
               $('body').css('background-image', 'url("' + urls[0] + '")');
               setInterval(function() {
                              $('body').css('background-image', 'url("' + urls[cout] + '")');
                              cout == urls.length-1 ? cout = 0 : cout++;
                                      }, 5500);

});*/
      // function that accepts numbers only in the input field
 function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

        </script>
      
    </head>
    <body>
         <header id="he">
         	<h1> Desi Calendar</h1>
         </header>
         <div id="cont">
             <div id="log">USER LOGIN</div>
             <?php $_SESSION['r'] = $rand;?>
          
              <div id="details">
                <form  action="login.php" method="post" autocomplete="off">
        	         
        	           <input type="text" name="username" placeholder="User Name" required><br>
                     <input type="password" name="password" placeholder="Password" required><br>
                     <input type="text" name="discaptcha" value="<?php echo $rand?>" style="background-color: grey; text-align: center; font-weight: bold; font-size: 15px; " readonly="readonly" required><br>
                     <input type="text" name="captcha" placeholder="Enter Captcha" onkeypress="return isNumber(event)" maxlength="4" required><br>   
                     <input type="submit" name="submit"><span id="sa" style="color: red; font-style: bold;"><?php echo $error?></span>
              </div>
         </div>
         <span id="su">
         <button id="register" onclick="location.href='register.html'" align="center">New user,click here to Register</button>
         
         </span>
     </body>
     </html>
     