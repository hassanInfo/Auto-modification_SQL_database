





<?php

?>
<!DOCTYPE html>
<html>
<head>

	<title>Les colonnes</title>
    
    <meta charset="utf-8">

    <script  src="jquery-3.6.0.min.js"></script>

    <script type="text/javascript" >
         /*function input_table(champ) {

                if(document.getElementById("col").value===""){

                    var list=document.getElementsByClassName("classe_col");

                       list[0].setAttribute('type',"hidden");
                       

                        list[0].value="";
        
                }else{

                  var list=document.getElementsByClassName("classe_col");
                  list[0].setAttribute('type',"");
                   
                }

         }*/

         window.onload =function(){



                  document.getElementById("col").value="";


                  var list=document.getElementsByClassName("classe_col");
                  list[0].value="";

         }

    </script>
    <script >
      
      $(document).ready(function(){

          $("#n_champ").keyup(function () {

            var n= document.getElementById("n_champ");

            var str="<table><tr> <td>Nom de champ </td><td>Type</td><td>Contrainte</td></tr>";  


            if (n.value!=="") {

                    for(var i=0;i<n.value;i++)
 
                           str+="<tr> <td><input type='text' name='ch"+i+"' ></td> <td><select name='"+i+"'><option value='int' selected='selected'>INT</option><option value='VARCHAR5' >VARCHAR(5)</option>  </select>  </td>  <td><select name='const"+i+"'><option value='----' selected='selected'>----</option> <option value='Clé primaire' >Clé primaire</option> <option value='Unique' >Unique</option><option value='Non null' >Non null </option> <option value='Clé etrangère' >Clé etrangère</option></select> </td> </tr>";   

                    str+="</table>"

                    $("table").html(str);
          
            }else{

                    $("table").html("");


            }


         });
      });
    



    </script>

</head>


<body style="text-align: center;background: #161623;color :white;">
 

    <h1>Add columns  </h1>

    
 <form action='' method="POST"> 
    

  <input  id ="n_champ"   name='n_champs'   class="classe_col" placeholder='Number of columns ' onkeyup ="input_table(2)">

    <table border="1">

    </table>



  
    <input type='submit'  value='+ Add' name="ajout">

  </form>

<br><br><br>

<h1>Delete column  </h1>

    
 <form action='' method="POST"> 
    

  <input     name='col_a_sup'   class="classe_col" placeholder='Set the column name'>
  
    <input type='submit'  value='x Delete' name="supp">

  </form>





</body>
</html>


<?php

  session_start();

  $nomtab = $_SESSION['tab'];

  $nom=$_SESSION['nomBD'];

    $conn = new mysqli("localhost","root","",$nom);
   
      if($conn){
                     if($conn->connect_error){

                                die("conncetion_filed:".$conn->conncet_error);
                     } 
                     else{

                              

                               if( isset($_POST['n_champs']) && !empty('n_champs') && isset($_POST['ajout'])){
                                       
                                            $n=(int)$_POST['n_champs'];

                      
                                             for($i=0;$i<$n;$i++){

                                                                     $s='ch'.$i;
                
                                                                      $nom_champ =  $_POST[$s] ;

                                                                      $ty=$_POST[$i];                                                                         
                                                                      if( $nom_champ!="" && $ty!="" ){

                                                                             $str ="ALTER TABLE ".$nomtab." ADD ".$nom_champ." ".$ty." ;"; 

                                                                              if(!$conn->query($str))  
               
                                                                                      echo "<h3>ERREUR</h3>".$conn->error;
                                                                                     exit();
                                                                        }
                                                                  }



                                           echo "<h3 style='color:green;'><b>The columns ".$_POST['col_a_sup']." are successfully added to the tabel='$nomtab'</b></h3>";                       
                               }

                               else if(isset($_POST['supp']) && isset($_POST['col_a_sup']) && !empty($_POST['col_a_sup'])){

                                           
                                             $res=$conn->query("show columns from  $nomtab");
                                            
                                             $exist=0;

                                              while( ( $row=$res->fetch_row() ) ){
                                                         
                                                           if( $row[0]==$_POST['col_a_sup'] ) $exist++;

                                              }

                                              if($exist>0){

                                                     $str ="alter table ".$nomtab." drop column ".$_POST['col_a_sup']; 

                                                      if($conn->query($str)){

                                                           echo "<h3 style='color:green;'><b>The column ".$_POST['col_a_sup']." are successfully deleted from the table='$nomtab'</b></h3>";

                                                            
                                                      }

                                               }else {


                                                      echo "<h3 style='color:red;'><b>The column  ".$_POST['col_a_sup']." doesn't exist in the table ".$nomtab."<b></h3>";
                                                      exit();
                                               }

                               }            

                         }  


               }else 

                  echo "Error";



?>


