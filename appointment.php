<?php
       include('session.php');
       $sql=$retval=$title = $description=$starttime=$endtime="";
       $errors= array();
       function test_input($data) {
               $data = trim($data);
               $data = stripslashes($data);
               $data = htmlspecialchars($data);
               return $data;
                          }
 
       
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
          $title = test_input($_POST["Title"]);
          $description = test_input($_POST["Description"]);
          $starttime = test_input($_POST["start"]);
          $endtime =   test_input($_POST["end"]);
    $sql="INSERT INTO appointments(username,title,description,starttime,endtime) VALUES ('$user_check','$title','$description','$starttime','$endtime') ";
       $retval = mysqli_query($conn,$sql);
          if(!$retval)
         {
	         die("<br>could not insert data".mysqli_error($conn));
         }
         else{
          header("location:welcome.php");
          }
      }
   ?>
   <!DOCTYPE html>
   <html>
   <head>
   	<title>Create new Appointment</title>
   	  <style>
         body{
              background-color: rgb(219,219,26);      
             }
         #header{
                   padding-top: 20px;
                   padding-left: 200px;
                }
        #h1{
        	font-weight: bold;
        	color: rgb(219,13,85);
        	font-size: 30px;
        	text-align: center;
        }
         input[type=text] {
                              width: 30%;
                              color: black;
                              padding: 20px 20px 20px 20px;
                              margin: 10px 0;
                              border: 5px solid;
                              border-color: rgb(180,180,180);
                              
                               }
          input[type=submit] {
                                 width: 19%;
                                 background-color: green;
                                 color: white;
                                 padding: 14px 20px;
                                 margin: 8px 0;
                                 border: 3px solid;
                                 border-radius: 4px;
                                 cursor: pointer;
                               } 
           #abc   {
                       text-align: center;
                  }
          #bu    {   width: 19%;
                     background-color: violet;
                     color: red;
                     padding: 14px 20px;
                     margin: 8px 0;
                     border: 3px solid;
                     border-color: white;
                     border-radius: 4px;
                     cursor: pointer;}
      </style>
   </head>
   <body>
   	<h2 style="text-align: right;color: rgb(255,255,255);"><a href = "logout.php">Sign Out</a></h2>   
      <div id="header"><h1 style="color: blue;font-size: 35px;font-weight: bold;">Create your Appointments</h1></div>
        <form method="post" autocomplete="off" id="abc">
               <input name="Title" type="text" placeholder="Appointment Title"><br>
                <input name="Description" type="text" placeholder="Description"><br>
                 <strong style="font-weight: bold;font-size: 30px;">Start Time</strong><br>
                  <input type="datetime-local" id="start-time" name="start" value="<?php echo date('d-m-Y G:i',time());?>" step=1 style="padding-top: 12px; padding-left: 27px; padding-right: 27px; padding-bottom: 12px; font-size: 25px;" /><br>
                     <strong style="font-weight: bold;font-size: 30px;">End Time</strong><br>
                     <input type="datetime-local" id="end-time" name="end" value="<?php echo date('d-m-Y G:i',time());?>" step=1 style="padding-top: 12px; padding-left: 23px; padding-right: 23px; padding-bottom: 12px; font-size: 25px;" /><br> 
                     <input type="submit" name="submit" value="Schedule Appointment">
        </form>
        <div id="l" style="padding-left: 560px;">
         <button onclick="location.href='welcome.php' " id="bu">Go back to home Page</button>
         </div>   
   </body>
   </html>