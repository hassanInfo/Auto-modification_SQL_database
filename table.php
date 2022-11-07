<?php

session_start();


?>


<?php

    
    ob_start();

    if(isset($_SESSION['nomBD'])){
         
                     $nom=$_SESSION['nomBD'] ;

                     echo "<!DOCTYPE html><html><head><title>The table</title><script  src='jquery-3.6.0.min.js'></script><meta charset='utf-8'><head>";


                     /*************************************************************/




echo '<script >  $(document).ready(function(){ $("#n_champ").keyup(function () {var n= document.getElementById("n_champ");';

       echo '     var str="';

       echo "<table align='center' style='text-align:center;color:white;'><tr> <th><b style='color:white;'>The column name<b></td><td><b style='color:white;'>Type<b></td></tr>";
       echo '";';  


       echo      'if (n.value!=="") { for(var i=0;i<n.value;i++)';
 
       echo   'str+="<tr> <td><input type=';

       echo "'text' name='";

       echo 'ch"+i+"';

       echo "' ></td> <td><select class='cols' name='typ";
       echo '"+i+"';

       echo"'><option value='int' selected='selected'>INT(5)</option><option value='VARCHAR5' >VARCHAR(5)</option>  </select>  </td> </tr>";

       echo '";';   

      

       echo   'str+="</table>";';



       echo   '          $("table").html(str);';
          
        echo '   }else{ ';

         echo '          $("table").html("");}';


         echo '}); }); </script>';
/*********************************************************/


echo "<script  src='jquery-3.6.0.min.js'></script><script  >";

echo "function cacher_T(){";



echo'             if(document.getElementById("array")){ document.getElementById("array").remove();}}';

 
echo           'function vide_table(){  var v = document.getElementById("tab");';

echo '                    if(v){ if(v.value===""){  alert("le champ table  vide !!"); return false ;';

                                
echo'                                }else {';
                                       
echo'                                       for(var i=0;i<10;i++){';



echo '                                         if(v.value[0]==i){';       
                                            
echo '                                alert("Table name is invalid (start with letter) !!"); return false ;'; 

echo '                                     } } }} return true; }';



 echo '       function col_vide(){ obj =document.getElementById("n_champ"); cols_tab =document.getElementsByClassName("cols");';
 
 echo '              if(obj.value===""){alert("le champ nombre colonnes est vide !!");return false;} ';
            

 echo'                          for(var i=0;i<obj.value;i++){if(cols_tab[i].value==="") {';

 echo'                            alert("One of the fields of a column is not filled!!");';
                                    
 echo '                                   return false; } }return true;}';


echo'  function input_table(champ) { if(document.getElementsByClassName("classe_col")){';

echo'      if(document.getElementById("col").value===""){ var list=document.getElementsByClassName("classe_col");';

echo'      list[0].setAttribute("type","hidden");list[0].value="";';
        
echo    ' }else{ var list=document.getElementsByClassName("classe_col"); list[0].setAttribute("type","");}';

echo '   }} window.onload =function(){ document.getElementById("col").value="";';


echo 'var list=document.getElementsByClassName("classe_col");list[0].value="";}</script>';


















                     /************************************************************/

                     echo "</head><body style='text-align: center;background: #161623;'><form action='' method='POST' >";
                     
                     echo "<h1 style='color:white;'>The table  </h1>";
                     
                    
                     echo "<input type='text' name='nomtab' id ='tab' size='24' placeholder='Set the table name' >";  
 
                     echo "<input type='submit' name='creer' onclick='return vide_table()' value='+ Create' ><input type='submit' name='supp' value='X Delete' onclick='return vide_table();' ><button type='submit' name='modi'  onclick='return vide_table();'>~ Modify</button>     <input type='submit' name='aff_T' value='# Show all the tables' of $nom onclick='passer_BD();'>      
                      </form>";

                      echo "<button name='cacher' onclick='cacher_T();'># Hide all tables</button>";


                     $conn = new mysqli("localhost","root","",$nom);

                     if($conn->connect_error){

          	                    die("conncetion_filed:".$conn->conncet_error);
                     }

                     if(isset($_POST['nomtab']))     
                
                        $_SESSION['nomtab']=$_POST['nomtab'];  

                      if(!empty($_POST['nomtab'])){
                                     
                                  $nomtab= $_POST['nomtab'];  


                                  $action ="";

                                  if(isset($_POST['supp']))

                                        $action="supprimer";

                                  elseif (isset($_POST['modi'])) 

                                        $action="modifier";

                                  $exist=0;  

                                  $res=$conn->query("show TABLES from $nom");

                                  $t = $_POST['nomtab'];

                                  while(($row=$res->fetch_row())){

                                             if($row[0]=="$t"){ 

                                                   $exist++;

                                             } 
                                  }    

                         
                                  if(isset($_POST['creer'])  && $exist==0){

                                         
                                              
                        
                                            $table=$_POST['nomtab']; 

                                            
                                            echo "<form action='' method='POST'><h3 style='color:white;'> Add columns to the table --> $table</h3>";

                                            echo "<input type='text' id ='n_champ' size='25'  name='n_champ'   class='classe_col' placeholder='Give the number of fields' onkeyup ='input_table()' >";

                                            echo "<table border='1'>";
                                     
                                            echo "</table>";  
  
                                            echo "<input type='submit'  value='+ Add' onclick='return col_vide();'  ></form>";


                                            //---------------------------------------------------
                                            



                                            //-------------------------------------------------
                                                     

                                              if(isset($_POST['n_champ'])){

                                                  echo "p---->";

                                                  $n=$_POST['n_champ'];

                                                  echo "$n";




                                                 for($i=0;$i<$n;$i++){

                                                      $nom_col = "ch".$i;

                                                      $type_col = "typ".$i;
                                                    

                                                      if(empty($_POST[$nom_col])){

                                                                
                                                                echo "<h3 style='color:red;'><b> One of the fields of a column is not filled!!<b></h3>";

                                                                exit();

                                                       }

                                                }
                                             }
                                            



                                      }else if(isset($_POST['creer'])){


                                            echo "<h3 style='color:red;'><b>The table $nomtab already exist in DB='$nom'<b></h3>";

                                            exit();




                                        }else if( isset($_POST['supp'])  && $exist>0 ){

                                                //header('Location: table.php');

                                                $nomtab=$_POST['nomtab'];

                                                $str= 'drop table '.$nomtab;

                                                $conn->query($str); 

                                                echo "<h3 style='color:green;'><b>The table $nomtab it is successfully removed from DB='$nom'</b></h3>";  
                                  
                                      }else if(isset($_POST['modi']) && $exist>0){


                                               $_SESSION['tab']=$_POST['nomtab']; 

                                               header("Location: modi_tab.php");



                                      }else if($exist==0) {
                                             
                                                echo "<h3 style='color:red;'><b>Sorry you can't [$action] a table does not yet exist in the DB='$nom' !!<b></h3>";

                                                exit();
                                   
                                      } 


                          



                          }else if(isset($_POST['n_champ']) && isset($_SESSION['nomtab'])) {
/************************************************************************************/

                                  echo "----".$_POST['n_champ']."---------".$_SESSION['nomtab']; 

                                  $nomtab=$_SESSION['nomtab'];
                                   

                                  $n=$_POST['n_champ'];

                                  $i=0;
                                  $sql="CREATE TABLE $nomtab( ";

                                  for(;$i<$n;$i++){

                                                      $nom_col = "ch".$i;
                                                

                                                      $nom=$_POST[$nom_col];

                                                      $type_col = "typ".$i;

                                                      $type_col = $_POST[$type_col];

                                                    

                                                      if(empty($_POST[$nom_col])){

                                                                
                                                                echo "<h3 style='color:red;'><b>The name  ".$i." of a column is not filled!!<b></h3>";
                                                               
                                                                exit();
                                                            

                                                      }


                                                      $sql.="$nom $type_col ";

                                                      if($i<$n-1)

                                                            $sql.=", ";



                                  }  

                                    $sql.=" );";

                                    if($conn->query($sql)) echo $conn->error;


                                



                         } else{


                                  echo "<h3 style='color:blue;'><b>Fill in the field before any operation<b></h3>";

                         }   

                         

                         echo "</body></html>";


                         if(isset($_POST['aff_T'])){


                     echo "<table align='center' id='array' border=2 style='margin-top:10px;color: white;'>";
                     echo "<tr><td><h2><b>The tables available in DB $nom</b></h2></td></tr>";

                       $res=$conn->query("SHOW TABLES");

                       while( $row=$res->fetch_row()){
                  
                               echo "<tr><th><h3><b>".$row[0]."</b></h3></th></tr>"; 

                        }


                        echo "</table>";  

                        $conn->close(); 

              }              
 


                
                }else{
        	
        	               echo "<h3 style='color:red;'><b>The database does not exist </b><h3>";
        	               echo "<h3 style='color:red;'><b> You skipped a step for this !!! </b><h3>";

                }

          //session_destroy();  

     ?>


