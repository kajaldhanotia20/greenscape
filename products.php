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
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Greenscape</title>
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/rating.css" rel="stylesheet" />

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
</head>
<body>
<center>
<h2>Product</h2>
<h3><?php echo $name; ?></h3>
<img src="<?php echo $img; ?>" height="300px">
<p><i><?php echo $desc; ?></i></p>




<!----------------------------------------------------------------Section: Block Content-->
<div class="classic-tabs border rounded px-4 pt-1">

  <ul class="nav tabs-primary nav-justified" id="advancedTab" role="tablist">
  <li class="nav-item">
      <a class="nav-link active show" id="description-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="description" aria-selected="true">Reviews & Ratings(<?php echo $numReviews;?>)</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#add-review" role="tab" aria-controls="reviews" aria-selected="false">Add Review</a>
    </li>
  </ul>
  <hr>
  <div class="tab-content" id="advancedTabContent">
    <div class="tab-pane fade show active" id="reviews" role="tabpanel" aria-labelledby="description-tab">
        <h5>Reviews</h5>


        <?php 
        
        include('config.php');
        $sql = "SELECT * from  review where productId=$id";
        $query = $dbh -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
         foreach($results as $result)
         {
          ?>
             <h5 class="small text-muted text-uppercase mb-2"><?php echo htmlentities($result->userName);?></h5>
                <ul class = "list-inline" white-space="nowrap" overflow="hidden">

                  <?php
                    $stars = $result->rating;
                    $count = 1;
                    
                    for($i = 1; $i <= 5; $i++){
                        if($stars >= $count){
                            $printstar = 
                            "<li class='list-inline-item' display='inline'>
                            <i class='fas fa-star fa-sm text-primary'></i>
                            </li>";
                        } else {
                            $printstar =
                            "<li class='list-inline-item' display='inline'>
                            <i class='far fa-star fa-sm text-primary'></i>
                            </li>";
                        }
                        $count++;

                        echo $printstar;
                      }
                  ?>
                </ul>
                <p class="pt-1"> <?php echo htmlentities($result->review);?></p>
                <hr>
          <?php  }} ?>
            
    </div>
    
    
    <div class="tab-pane fade" id="add-review" role="tabpanel" aria-labelledby="reviews-tab">
      <h5 class="mt-4">Add a review</h5>

      <div>
        <!-- Your review -->
        <form method="post">

            <div class="rate">
              <input type="radio" id="star5" name="rate" value="5" />
              <label for="star5" title="text">5 stars</label>
              <input type="radio" id="star4" name="rate" value="4" />
              <label for="star4" title="text">4 stars</label>
              <input type="radio" id="star3" name="rate" value="3" />
              <label for="star3" title="text">3 stars</label>
              <input type="radio" id="star2" name="rate" value="2" />
              <label for="star2" title="text">2 stars</label>
              <input type="radio" id="star1" name="rate" value="1" />
              <label for="star1" title="text">1 star</label>
            </div>
            <br/> <br/>
            <div class="md-form md-outline">
            <label for="form76">Review</label>
            <textarea id="form76" name="review" class="md-textarea form-control pr-6" rows="4"></textarea>
            </div>
            <!-- Name -->
            <div class="md-form md-outline">
            <label for="form75">Name</label>
            <input type="text" name="name" id="form75" class="form-control pr-6">
            </div>
            <!-- Email -->
            <div class="md-form md-outline">
            <label for="form77">Email</label>
            <input type="email" name="email" id="form77" class="form-control pr-6">
            </div>
            <br/>
            <div class="text-right pb-2">
            <button type="submit" name="submit" class="btn btn-primary">Add a review</button>
            </div>
        </form>
      </div>
    </div>

    <?php

//ratings and review php logic start-----------------------------------------------------------
include('config.php');
        $rating_stats = "SELECT ROUND(AVG(a.rating), 1) AS averageRating, COUNT(a.rating) as numOfRatings 
        FROM review as a INNER JOIN products as b WHERE a.productId = b.id and a.productId = $id GROUP BY a.productId";
        $query = $dbh -> prepare($rating_stats);
        $query->execute();
        $rating_obj=$query->fetch(PDO::FETCH_OBJ);
        
        $avgRating = (int)$rating_obj->averageRating;
        $numReviews = (int)$rating_obj->numOfRatings; 

    if(isset($_POST['submit']))
    {
        echo "submitting..";

    
        $userName=$_POST['name'];
        $review=$_POST['review'];
        $email=$_POST['email'];
        $rating = $_POST["rating"];;

        $sql ="INSERT INTO review(productId,userName, emailId, rating, review) VALUES(:id,:userName, :email, :rating, :review)";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':id', $id, PDO::PARAM_STR);
        $query-> bindParam(':userName', $userName, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':rating', $rating, PDO::PARAM_STR);
        $query-> bindParam(':review', $review, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
        echo "<script type='text/javascript'>alert('Review Added Successfully!');</script>";
        echo "<meta http-equiv='refresh' content='0'>";
    
        }
        else 
        {
        $error="Something went wrong. Please try again";
        }

    }

//ratings and review php logic end-----------------------------------------------------------

?>



  </div>

</div>



<!----------------------------------------------------------------Section: Block Content-->


</center>
</body>
</html>