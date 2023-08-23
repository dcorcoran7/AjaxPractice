<!doctype HTML>

<?php
  $proID = "";
  $err = false; 
  
  if (isset($_POST["submit"])) {
    if(isset($_POST["proID"])) $proID = $_POST["proID"];
    
    
    if(!empty($proName)) {
      header("HTTP/1.1 307 Temprary Redirect");
      header("Location: displayProducts.php"); 
    } 
    else{
      $err = true;
    }
  }
?>

<html>
    <head>
        <title>
          hw14q1
        </title> 

    <script src="jquery-3.1.1.min.js"></script>
    <script>
      var asyncRequest;
      function getContent() {
        var id = document.forms[0].proID.value;
        var z = document.getElementById("contentArea");
        
        if(id==0) {
          z.innerHTML = "";
        } 
        else {  
          try {
  					asyncRequest = new XMLHttpRequest();  //create request object

  					//register event handler
  					asyncRequest.onreadystatechange=stateChange;
            var url="displayProducts.php?id="+id;
  					asyncRequest.open('GET',url,true);  // prepare the request
  					asyncRequest.send(null);  // send the request
  				}
  					catch (exception) {alert("Request failed");}

        }

        function stateChange() {
          // if request completed successfully
          if(asyncRequest.readyState==4 && asyncRequest.status==200) {
            document.getElementById("contentArea").innerHTML=
              asyncRequest.responseText;  // places text in contentArea
          }
        }
        
      }

      $(document).ready(function(){
          $("select").change(function(){
            getContent();
          });
        });

    </script>
    </head>

    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

          <a href="" id = "allProducts">All Products</a><br><br>
          
          <select name = "proID"> 
            <option>N/A</option>
            <?php 
              require_once("displayProductsdb.php"); 
              $sql = "SELECT ProductID FROM products";
              $result = $mydb->query($sql);

              while($row = mysqli_fetch_array($result)){
                echo "<option selected>" . $row['ProductID'] . "</option>";
              }
              
            ?>
          </select>
          <br><br>
          
        </form> 
        
        <div id = "contentArea">&nbsp;</div>  

        <script>

          document.getElementById("allProducts").onmouseover = function() {mouseOver()};
          document.getElementById("allProducts").onmouseout = function() {mouseOut()};

          function mouseOver() {
            document.getElementById("allProducts").style.color = "red";
            getContent();
            document.forms[0].proID.value = 0;
          }

          function mouseOut() {
            document.getElementById("allProducts").style.color = "black";
            getContent();
            document.forms[0].proID.value = "N/A";
          }
        </script>

    </body>

</html>