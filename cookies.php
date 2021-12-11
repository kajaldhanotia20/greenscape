<!DOCTYPE html>
<head>
    <title>View Last 5</title>
</head>
<body>
    <?php
        if(isset($_COOKIE["user_activity"])){
            $cookie_data = stripslashes($_COOKIE['user_activity']);
            $cookie_data = json_decode($cookie_data, true);
            $arrLength = count($cookie_data);
        }
    ?>
    <h3>Last 5 Visited Products (latest first)</h3>
    <p><?php echo $cookie_data[$arrLength - 1]; ?></p>
    <p><?php echo $cookie_data[$arrLength - 2]; ?></p>
    <p><?php echo $cookie_data[$arrLength - 3]; ?></p>
    <p><?php echo $cookie_data[$arrLength - 4]; ?></p>
    <p><?php echo $cookie_data[$arrLength - 5]; ?></p>
</body>
</html>