<!DOCTYPE html>
<html>
<head>
	<title>Insert the data</title>

	<script type="text/javascript">

		
             function valider() {


		       bd= document.getElementById("BD");
		       tab=document.getElementById("TAB");
             	
             	if(bd && tab){
                            
                            if(bd.value==="" || tab.value===""){

                                    alert("One or more fields is empty!!");
                                    return false ;



                            }else if(bd.value==="" || tab.value===""){


                            	     for(var i=0;i<10;i++){



                                          if(bd.value[0]==i || tab.value==i){       
                                            
                                            alert("the name of the table or the DB is invalid (start with a letter) !!");
                                          
                                            return false ; 

                                        }
                                       }
  
                            }
                        }


             	
             }


	</script>
</head>
<body style="text-align: center;background: #161623;color: white;">

<form method="POST" action=''>
    
    <h1>DML Modify the Data</h1>
	<input type="text" name="BD" id ="BD" placeholder ="The Database name" >
    <input type="text" name="TAB" id ="TAB" placeholder ="The table name">

    <input type="submit"  name="ins" value="Insert"    onclick="return valider();">
    <input type="submit"  name="modi" value="Modify"  onclick="return valider();">


</form>


<?php

  SESSION_START();


   if(isset($_POST['ins'])){

/***************************************************************/
                 $bd_in=$_POST["BD"];
                 $tab=$_POST["TAB"];
                  
                  $_SESSION['BD']=$bd_in;
                  $_SESSION['TAB']=$tab;

                 $conn = new mysqli("localhost","root","");

                 if(!$conn ){


                      echo "<h3 style='color:red;'><b>Server connection error <b></h3>";

                      exit();
                 }

                 $bd=mysqli_select_db($conn,"$bd_in");

                 if(!$bd){

                      echo  "<h3 style='color:red;' ><b>Error :/!\ The database '$bd_in' does not exist<b></h3>";
                      exit();
                 }


                 if(!($sql = $conn->query("select * from $tab"))){

                      echo  "<h3 style='color:red;' ><b>Error :/!\ The table '$tab' does not exist in DB='$bd_in'<b></h3>";
                      exit(); 

                 }

                 $sql_col=$conn->query("desc $tab");
                 $i=0;

                 echo "<form method='POST' action=''>";
                 echo "<table align='center' border='2'>";


                 $n_col=$sql_col->num_rows;

                 echo "<tr ><th colspan='$n_col'>Insert the values</th></tr><tr>";   

                    
             
                 while ($row=$sql_col->fetch_row()) {

                    echo "<th style='color:green;'>".$row[0]."</th>";
                    
                    $_SESSION['ses'.$i]=$row[0];

                    $i++;

                    

                 }

                 $sql_col=$conn->query("desc $tab");


                 echo "</tr>";

                 $c=0;

    

                       $i=$sql_col->num_rows;

                       echo "<tr>";
                    
                       for($j=0;$j<$i;$j++){

                             echo "<td><input type='text' name='val".$j."' placeholder='val".$j."'></td>";
                        }

                      
                       $c++;

                       echo "</tr>";


                

                  $_SESSION['colonnes']=$i;
                  $_SESSION['lignes']=$c;
                  $_SESSION['tab']=$tab;
                  $_SESSION['bd_in']=$bd_in;


                 echo "</table><input type='submit' name='insert' value='~ Insert'></form>";


 /**************************************************************/                

    }else if(isset($_POST['insert'])){


                 $bd_in=$_SESSION["BD"];
                 $tab=$_SESSION["TAB"];

                $conn = new mysqli("localhost","root","");

                 if(!$conn ){


                      echo "<h3 style='color:red;'><b>Server connection error <b></h3>";

                      exit();
                 }
                 


                 $bd=mysqli_select_db($conn,"$bd_in");

                 if(!$bd){

                      echo  "<h3 style='color:red;' ><b>Erreur :/!\ The database '$bd_in' does not exist<b></h3>";
                      exit();
                 }


                 if(!($sql = $conn->query("select * from $tab"))){

                      echo  "<h3 style='color:red;' ><b>Error :/!\ The table '$tab' does not exist in DB='$bd_in'<b></h3>";
                      exit(); 

                 }

                 $i=$_SESSION['colonnes'];

               
                 $str="insert into $tab values(";

                for($j=0;$j<$i;$j++){
 
 
                    
                       $mat='val'.$j;

                       $str.="'".$_POST[$mat]."'";

                       if($j<$i-1) $str.=",";
                    
                 }
                  
                  $str.=");";

                  if($conn->query($str)){


                         echo " --".$conn->error."<br><br>";

                         exit();
                  }

                  $conn->query("insert into $tab values(".$_POST['val0'].",".$_POST['val1'].") ");

/************************************************************/
   }else if(isset($_POST["modi"])){


                 $bd_in=$_POST["BD"];
                 $tab=$_POST["TAB"];
                  

                 $conn = new mysqli("localhost","root","");

                 if(!$conn ){


                 	  echo "<h3 style='color:red;'><b>Server connection error <b></h3>";

                 	  exit();
                 }

                 $bd=mysqli_select_db($conn,"$bd_in");


                 if(!$bd){

                      echo  "<h3 style='color:red;' ><b>Error :/!\ The database '$bd_in' does not exist<b></h3>";
                      exit();
                 }


                 if(!($sql = $conn->query("select * from $tab"))){

                      echo  "<h3 style='color:red;' ><b>Erreur :/!\ The table '$tab' does not exist in DB='$bd_in'<b></h3>";
                      exit(); 

                 }

                 $sql_col=$conn->query("desc $tab");
                 $i=0;

                 echo "<form method='POST' action=''>";

                 echo "<br><h4 style='color:green;' ><b>**To delete leave the fields empty**<b></h4><br>" ;  
                 echo "<table align='center' border='2'>";


                 $n_col=$sql_col->num_rows;

                 echo "<tr ><th colspan='$n_col'>Old values </th><th colspan='$n_col' >New values </th></tr><tr>";   

                    
             
                 while ($row=$sql_col->fetch_row()) {

                    echo "<th style='color:green;'>".$row[0]."</th>";
                    
                    $_SESSION['ses'.$i]=$row[0];

                    $i++;

                    

                 }

                 $sql_col=$conn->query("desc $tab");


                 while ($row=$sql_col->fetch_row()) {

                    echo "<th style='color:green;'>".$row[0]."</th>";

                 }


                 echo "</tr>";

                 $c=0;

                 while ($row=$sql->fetch_row()) {



                 	   echo "<tr>";
                 	
                 	   for($j=0;$j<$i;$j++){

                             echo "<td>".$row[$j]."</td>";
                        }

                       for($j=0;$j<$i;$j++){

                             echo "<td><input type='text' name='val".$c.$j."' placeholder='val".$c.$j."'></td>";


                       }
                      
                       $c++;

                       echo "</tr>";


                   }

                  $_SESSION['colonnes']=$i;
                  $_SESSION['lignes']=$c;
                  $_SESSION['tab']=$tab;
                  $_SESSION['bd_in']=$bd_in;





                 echo "</table><input type='submit' name='modi_supp' value='~ modify'></form>";
                  
               }else if(isset($_POST['modi_supp'])){


                        $conn = new mysqli("localhost","root","");

                        $bd_in=$_SESSION['bd_in'];

                       if(!$conn ){


                              echo "<h3 style='color:red;'><b>Erreur de connexion au serveur <b></h3>";

                             exit();
                       }

                      $bd=mysqli_select_db($conn,"$bd_in");



                     if(!$bd){

                      echo  "<h3 style='color:red;' ><b>Erreur :/!\ The database '$bd_in' does not exist<b></h3>";
    
                        exit();
                     }




                       $tab=$_SESSION['tab'];

                       if(!$conn->query("delete  from $tab ;")){

                                  echo "traversé l erreur : ".$conn->error;

                       }
           
                      for($i=0;$i<$_SESSION['lignes'];$i++){
                                        
                                        $str ="INSERT INTO  ".$tab ." VALUES( ";

                                         // $_SESSION['ses'.$i];

                                          for($j=0;$j<$_SESSION['colonnes'];$j++){


                                                  $mat='val'.$i.$j;


                                               if(empty($_POST[$mat]))
                                                    
                                                     $str.="''"; 


                                                else {

                                                    $str.="'";
                                                    $str.=$_POST[$mat];
                                                    $str.="'";

                                               }

                                              if($j<$_SESSION['colonnes']-1)  $str.=" , ";     


 

                                          }

                                          $str.=" ) ;";


                                          if(!$conn->query($str)){


                                           echo " --".$conn->error."<br><br>";
                                           exit();
                                         }

                                   $sql_col=$conn->query("desc $tab");
                              
                             for($i=0;$i<$_SESSION['lignes'];$i++){
                                        
                                        $str ="delete from $tab where ";


                                          $sql_col=$conn->query("desc $tab ;");                                         

                                          $j=0;
                                          

                                          while(($row = $sql_col->fetch_row())){


                                               $mat='val'.$i.$j;

                                               if(!empty($_POST[$mat])) break;
                                       

                                                $str.=$row[0];
                                                $str.=" = '' ";

                                                if( $j<$_SESSION['colonnes']-1 )
                                                    $str.=" && ";
                                             
                                             $j++;

                                          }


                                          $str.=" ;";

                                          /* if(!$conn->query($str)){

                                                  echo " --".$conn->error."<br><br>";

                                           }*/

                                          

                                           
                      }


            } 

   
}

?>

</body>
</html>
