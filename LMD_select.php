<!DOCTYPE html>
<html>
<head>
	<title>Insert data</title>

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
                                            
                                            alert("The name of the table or the DB is invalid (start with a letter) !!");
                                          
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
    
    <h1>DML show the Data</h1>
	<input type="text" name="BD" id ="BD" placeholder ="The Database name" >
    <input type="text" name="TAB" id ="TAB" placeholder ="The table name ">

    <input type="submit"  name="val" value="# Show" onclick="return valider();">

</form>


<?php


   if(isset($_POST["val"])){

                 $bd_in=$_POST["BD"];
                 $tab=$_POST["TAB"];
                  

                 $conn = new mysqli("localhost","root","");

                 if(!$conn ){


                 	  echo "<h3 style='color:red;'><b>Server connection error<b></h3>";

                 	  exit();
                 }

                 $bd=mysqli_select_db($conn,"$bd_in");

                 if(!$bd){


                 	  echo  "<h3 style='color:red;' ><b>Error :/!\ The database '$bd_in' does not exist<b></h3>";
                 	  exit();
                 }

                  $sql=$conn->query("select * from $tab ;");

                 if(!$sql){

                 	  echo  "<h3 style='color:red;' ><b>Error :/!\ The table '$tab' does not exist DB='$bd_in'<b></h3>";
                 	  exit();                              


                 }

                 $sql_col=$conn->query("desc $tab");
                 $i=0;
                 
                 echo "<br>";

                 echo "<table align='center' border =2><tr>";

               
             
                 while ($row=$sql_col->fetch_row()) {
                 	
                    echo "<th style='color:green;'>".$row[0]."</th>";
                    $i++;

                 }
                 echo "</tr>";

                 $sql=$conn->query("select * from $tab ; ");


                 while (($row=$sql->fetch_row())) {

                 	echo "<tr>";
                
                 	for($j=0;$j<$i;$j++){

                        echo "<td>".$row[$j]."</td>";
                        
                    }
                     

                    echo "</tr>";


                 }



                 echo "</table>";

                  


   }


?>

</body>
</html>
