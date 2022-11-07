         

         function input_table(x) {
      
               

                if(document.getElementById("col").value===""){


                     //document.getElementById("in_tab").setAttribute("type","hidden");

                    var list=document.getElementsByClassName("classe_col");

                       list[0].setAttribute('type',"hidden");

                        list[0].value="";
                       
                }else{




                	//document.getElementById("in_tab").setAttribute("type","");
                	var list=document.getElementsByClassName("classe_col");
                	list[0].setAttribute('type',"");
                }



            /*   if(document.getElementById("BD").value==="")
              
                      document.getElementById("in_tab").remove();

                else{

                      var para = document.createElement("input");

                      var node = document.createTextNode("table");

                      para.appendChild(node);

                      var ele = document.getElementById("f");

                      ele.appendChild(para);


                }

*/

         }

         window.onload =function(){

                 
               if(document.getElementById("col")){

                  document.getElementById("col").value="";


                  var list=document.getElementsByClassName("classe_col");
                  list[0].value="";
               }


         }

         function cacher_BD(){



              if(document.getElementById("array")){


                    document.getElementById("array").remove();


                 }    

         }


        



         function ch_vide(){

                
               if(document.getElementById("BD").value===""){
          
                  alert("The field is empty !!");

                return false;
               }

         }

       function passer_BD(){

              if(document.getElementById('hidd_input'))
              document.getElementById('hidd_input').value=document.getElementById('BD').value; 

       }



      function vide_change(n){



                
              for(var i=0;i<n;i++){
                


                if(document.getElementById(i).value===""){

                         
                        alert("The field number "+(i+1)+" is empty");

                        return false ;

                }
              }

                

      }




