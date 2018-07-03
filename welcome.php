<?php
include('session.php');
?>
<html lang="en">
   
   <head>
    	<meta charset="utf-8" description="designing a Welcome page" >
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Welcome to Desi Calendar</title>
        <style>
           body{
                 background-image: url("bg.jpg");
                }
           #prof {
                                     width: 15%;
                                     background-color: blue;
                                     color: white;
                                     padding: 14px 	0px;

                                     margin: 8px 0;
                                     border: 3px solid;
                                     border-radius: 4px;
                                     cursor: pointer;
                               }
           #prof1 {
                                     width: 15%;
                                     background-color: blue;
                                     color: white;
                                     padding: 14px 	0px;

                                     margin: 8px 0;
                                     border: 3px solid;
                                     border-radius: 4px;
                                     cursor: pointer;
                               }
            #prof2 {
                                     width: 15%;
                                     background-color: blue;
                                     color: white;
                                     padding: 14px 	0px;

                                     margin: 8px 0;
                                     border: 3px solid;
                                     border-radius: 4px;
                                     cursor: pointer;
                               }
            #prof3 {
                                     width: 15%;
                                     background-color: blue;
                                     color: white;
                                     padding: 14px  0px;

                                     margin: 8px 0;
                                     border: 3px solid;
                                     border-radius: 4px;
                                     cursor: pointer;
                               }

            .bu {
                     padding-left: 120px;
                     padding-right: 50px;
                        
                }      
            .lu {
                   
                     padding-right: 50px;
                        
                }
                #po {
                	padding-top: 20px;
                	padding-right: 50px;
                }

        </style>

             <script>
              /*    Jquerry implementation
                 $(document).ready(function(){
                 $('#prof').click(function(){
                 	                          $('#po').load('profile.php');
                 	                         }
                 	                         );
                 

                 });*/
                 function mypr(){               
                                    po = document.getElementById("po");
                                    var x = new XMLHttpRequest();
                                    x.open("GET", "profile.php", true);
                                    x.send();
                                    x.onreadystatechange = function(){
                                   if(x.readyState == 4&&x.status==200){
                                      po.innerHTML = x.responseText;}
                                 else po.innerHTML = "Error loading document";
                                }
                           }
                         
                function mycal(){               
                                    po = document.getElementById("po");
                                    var x = new XMLHttpRequest();
                                    x.open("GET", "calen.php", true);
                                    x.send();
                                    x.onreadystatechange = function(){
                                   if(x.readyState == 4&&x.status==200){
                                      po.innerHTML = x.responseText;}
                                 else po.innerHTML = "Error loading document";
                                }
                           }



            /*   Jquerry implementation              
                 $(document).ready(function(){
                 $('#prof2').click(function(){
                                            $('#po').load('search.php');
                                           }
                                           );
                 

                 });
                 
                 $(document).ready(function(){
                 $('#prof1').click(function(){
                                            $('#po').load('myfriends.php');
                                           }
                                           );
                 

                 });
                 $(document).ready(function(){
                    $("#prof3").click(function(){
                          $('#po').load('myimages.php');
                    });


                 });
                 */
              </script>
   </head>
   
   <body>
      <h2 style="text-align: right;";><a href = "logout.php">Sign Out</a></h2>   	
      <h1 style="text-align: center; color: rgb(200,10,70); font-style: bold; font-size: 30px;">Welcome to your Desi Profile Page <?php echo $login_session; ?></h1>
      <span class="bu"> 
      <button id="prof" onclick="mypr()">MY PROFILE</button>
      </span>
      <span class="lu">
      <button id="prof1" onclick="location.href='appointment.php'">CREATE APPOINTMENT</button>
      </span>
      <span class="lu">
      <button id="prof2" onclick="location.href='meeting.php'">SCHEDULE MEETING</button>
       </span>
      <button id="prof3" onclick="location.href='calen.php'">MY APPOINTMENTS</button>	
            <div id="po">
  
            
            </div>   
     
   </body>

   
</html>    
