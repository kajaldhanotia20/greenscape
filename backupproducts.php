<?php
    $servername = "ls-1c31f2d025ebc54e33379b49252559964309ae0e.cwaaley7zj90.us-east-2.rds.amazonaws.com";
    $username = "dbmasteruser";
    $password = "v*&Z[lBm-fA_]W.#f5[S=^uaDAJJ8c)t";
    $dbname = "dbmaster";
    
     // Create a connection 
     $conn = mysqli_connect($servername, 
         $username, $password, $dbname);
    
    if($conn) {
        // echo "ready \n"; 
    } 
    else {
        // die("Error". mysqli_connect_error()); 
    }
    
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['item'];
        
        $sql = "select * from products where id={$id}";
    
        $result = mysqli_query($conn, $sql);
            if (!mysqli_num_rows($result) > 0) {
                
            }
            else{
                if(isset($_COOKIE["user_activity"])){
                    
                    $cookie_data = stripslashes($_COOKIE['user_activity']);

                    $cookie_data = json_decode($cookie_data, true);
                }
                else{
                    $cookie_data = array();
                }
                
                $arrLength = count($cookie_data);
                
                while($row = mysqli_fetch_assoc($result)) {
                    $name = $row["name"];
                    $desc = $row["description"];
                    $img = $row["img"];
                }
                $cookie_data[$arrLength] = $name;
                
                $cookie_data = json_encode($cookie_data);
                
                setcookie("user_activity", $cookie_data, time()+2*24*60*60, '/');
            }

        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<head><title> Product</title></head>
<body>
<center>
<h2>Product</h2>
<h3><?php echo $name; ?></h3>
<img src="<?php echo $img; ?>" height="300px">
<p><i><?php echo $desc; ?></i></p>
</center>
</body>
</html>