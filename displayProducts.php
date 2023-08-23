<!doctype html>

<html>
    <head>
    <title> Display Products</title>

    <style>
            table {
                border: 1px solid white;
            }

            .Name {
                background-color: orange;
            }

            .Header {
                background-color: orange;
                color: white;
                text-align: center;
                font-weight: bold;
            }

            .Body {
                background-color: peachpuff;
            }

    </style>
 
    </head>

    <body>
        <?php
            $id = 0;
            if(isset($_GET['id'])) $id=$_GET['id'];
            echo $id;
            
            require_once("displayProductsdb.php"); 

            if ($id == 0) {
                $sql="SELECT * FROM products Order By ProductID";
                $result = $mydb->query($sql);
                //$result should be a resultset
                echo "<table>";
                    echo "<thead>"; 
                        echo "<tr class = 'Header'>";
                            echo "<td>","Product ID","</td>";
                            echo "<td>","Product Name","</td>";
                            echo "<td>","Supplier ID","</td>";
                            echo "<td>","Category ID","</td>";
                            echo "<td>","Unit Price","</td>";
                            echo "<td>","Units In Stock","</td>";
                        echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td class = 'Name'>".$row["ProductID"]."</td>";
                            echo "<td class = 'Body'>".$row["ProductName"]."</td>";
                            echo "<td class = 'Body'>".$row["SupplierID"]."</td>";
                            echo "<td class = 'Body'>".$row["CategoryID"]."</td>";
                            echo "<td class = 'Body'>".$row["UnitPrice"]."</td>";
                            echo "<td class = 'Body'>".$row["UnitsInStock"]."</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                echo "</table>"; 
            }

            else {
                $sql="SELECT * FROM products WHERE ProductID=".$id;
                $result = $mydb->query($sql);    

                if($row=mysqli_fetch_array($result)){
                    //HTML Table
                    echo "<table>"; 
                        echo "<thead>";
                            echo "<tr class = 'Header'>";
                                echo "<td>","Product ID","</td>";
                                echo "<td>","Product Name","</td>";
                                echo "<td>","Supplier ID","</td>";
                                echo "<td>","Category ID","</td>";
                                echo "<td>","Unit Price","</td>";
                                echo "<td>","Units In Stock","</td>";
                            echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";
                                echo "<tr>";
                                echo "<td class = 'Name'>".$row["ProductID"]."</td>";
                                echo "<td class = 'Body'>".$row["ProductName"]."</td>";
                                echo "<td class = 'Body'>".$row["SupplierID"]."</td>";
                                echo "<td class = 'Body'>".$row["CategoryID"]."</td>";
                                echo "<td class = 'Body'>".$row["UnitPrice"]."</td>";
                                echo "<td class = 'Body'>".$row["UnitsInStock"]."</td>";
                                echo "</tr>";
                        echo "</tbody>";
                    echo "</table>"; 
                } 
            }
            
        ?>
    </body>
</html>