

<!DOCTYPE html>
<html>
<head>

	<title>The Database</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="tst.js"></script> 
    

</head>
<body style="text-align: center;background: #161623;">
 
   <form action="" method="POST">
   	
     <h1 style="color: white;">DDL Modify the structer </h1>
  	 <input type="text" name="nomBD" id ="BD" size="24" placeholder="The Database name" >
  	 <br><br><br>

  	 <input type='submit' name="creer" value='+ Create'     onclick="return ch_vide();">
  	 <input type='submit' name="supp"  value='X Delete' onclick="return ch_vide()">
  	 <input type='submit' name="modi"  value='~ Modify'  onclick="passer_BD();return ch_vide();"> 
     <input type="submit" name="aff_BD" value='# Show all databases' onclick="passer_BD();">      
     <br>
    </form>
    <button name="cacher" onclick="cacher_BD();"># Hide all DBs</button>      


<?php
          
          $conn = new mysqli("localhost","root","");

          if($conn->connect_error){

          	die("conncetion_filed:".$conn->conncet_error);
          }
?>


<?php

         if(isset($_POST['nomBD'])){

                           $nom=$_POST['nomBD'] ;

                           $action="";

                           if(isset($_POST['supp']))
 
                                   $action="Supprimer";

                           if(isset($_POST['modi']) && !isset($_POST['creer']))

                           	          $action="modifier";

         
                           if(isset($_POST['modi']) || isset($_POST['supp'])){


                                     $exist=0;

                                     session_start();

                                     $_SESSION['nomBD']=$_POST['nomBD'];

                                     $res=$conn->query("show databases");

                                     while( $row=$res->fetch_row()){
                  
                                             if($row[0]=="$nom"){ 

                                                   $exist++;

                                             } 

                                    }
                                    if($exist==0){
                                    
                                                echo "<h3 style='color:red;'><b>Error:/!\ you can't [$action] a DB does not yet exist !!<b></h3>";

                       	                        exit();
                                      
                                    }else if(isset($_POST['supp'])){

                                    	        $conn->query("DROP DATABASE $nom");

                                    	        echo "<h3 style='color:green;'><b >The database $nom is successfully deleted.<b></h3>";

          	                                   
                                  
                                    }else if(isset($_POST['modi'])){

                                                 
                                                header('Location: table.php'); 

                                    }

                           }

          
                           if(isset($_POST['creer'])){

                                $sql="CREATE DATABASE $nom";

                                try {   $conn->query($sql);
                                        // run your code here
                                        echo "<h3 style='color:green;'><b>The database $nom is successfully created.<b></h3>";
                                    }
                                    catch (exception $e) {
                                        //code to handle the exception
                                                                        //$conn->error <-- erreur produite par serveur
                                                                                $i=0; 

                                                                                for(;$i<9;$i++){
                                        
                                                                                if($nom[0]==$i){
                                        
                                                                                        echo "<h3 style='color:red;'><b>Error:/!\ incorrect name (start with a letter)<b></h3>";exit();
                                        
                                                                                }
                                        
                                                                                }
                                        
                                                                        echo "<h3 style='color:red;' ><b>Error:/!\ The database $nom already exist<b></h3>";
                                                                        exit();
                                    }


 
                }

                
                if(isset($_POST['aff_BD'])){


                	   echo "<table id='array' border=2 style='margin-left:36%;margin-top:10px;color: white;'>";
                	   echo "<tr><td><h2><b>Available DBs</b></h2></td></tr>";

                       $res=$conn->query("show databases");

                       while( $row=$res->fetch_row()){
                  
                               echo "<tr><th><h3><b>".$row[0]."</b></h3></th></tr>"; 

                        }


                        echo "</table>";   

              }              




       }         

               

           
                $conn->close();


     ?>

</body></html>