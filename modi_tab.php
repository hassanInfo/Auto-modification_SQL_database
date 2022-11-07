<?php session_start();

?>

<!DOCTYPE html>
<html>
<head>

	<title></title>

  <script type="text/javascript" src="tst.js"></script>
</head>
<body style="text-align: center;background: #161623;color :white;">


   <h1>Modify the columns</h1>

<form method="POST" action="colonne.php">
	<?php
	$nomtab = $_SESSION['tab'];
   echo "<h3 style='color :aqua;'>Add or remove columns from the table  <b style='color :green;'> $nomtab </b> </h3><br>";
   ?>
    <input type='submit' value='+ ADD or x Remove'>
</form>
    <br><br><br>

<?php
  

  $nomtab = $_SESSION['tab'];

  $nom=$_SESSION['nomBD'];

    $conn = new mysqli("localhost","root","",$nom);
   
      if($conn){
                     if($conn->connect_error){

          	                    die("conncetion_filed:".$conn->conncet_error);
                     }   


     }else 


             echo "erreur";



           $res=$conn->query(" show columns from  $nomtab ");


                                  echo "<form method='POST' action='' border=2><table style=' margin-left:34%;color:white'>"; 

                                 
                                  echo "<h3 style='color :aqua;'>Change the columns the table is <b style='color :green;'> $nomtab </b></h3>";

                                  echo "<tr><th style='color :green;' >The old name</th><th>&nbsp&nbsp</th><th style='color :green;'>The old type</th><th>&nbsp&nbsp</th></th><th>new name </th><th>&nbsp&nbsp</th><th>new type</th></tr>";
                                  
                                  $i=0;

                                  while(($row=$res->fetch_row())){

                                   
                                      echo "<tr><td style='color :green;'>".$row[0]."</td><td>&nbsp&nbsp</td><td style='color :green;'>".$row[1]."</td><td>&nbsp&nbsp</td><td><input id='$i' name='nom".$i."' > </td><td>&nbsp&nbsp</td><td><select class='cols' name='typ".$i."'><option value='int' selected='selected'>INT(5)</option><option value='varc' >VARCHAR(5)</option>  </select>   </td> </tr>";


                                        $i++;
                                  }      

                                      

                                  echo "</table><br><input type='submit' value='Change the table $nomtab' name='changer_suit_processus' onclick='return vide_change( $i )'></form>";
                                  
                                 
                                 if(isset($_POST['changer_suit_processus'])){


                                 $res=$conn->query("show columns from  $nomtab");

                                  $i=0;

                                  while(($row=$res->fetch_row())){

             
                                          $s='nom'.$i;
                                          
                                          $s=$_POST[$s];

                                          $r=$row[0];

                                          $t='typ'.$i;

                                          $ty=$_POST[$t];

                                          $ty = ($ty==1)?'INT(5)':'VARCHAR(5)';

                                       if($r!="")

                                          $conn->query("ALTER TABLE `$nomtab` CHANGE `$r` `$s` $ty NOT NULL");  

                                                    
                                         $i++;
                                         
                                   }

                               }




?>

</body>
</html>