<?php

// Initialize the session
session_start();

require_once("../crud/php/component.php");
require_once("../crud/php/operation.php");


// Check if the user is logged in, if not  redirect  to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else {

echo '<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>';

}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>

    <!--fontawesome icons-->
    <script src="https://kit.fontawesome.com/211eb7a1fd.js" crossorigin="anonymous"></script>

    <!--Bootstrap Library to style-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--custom stylesheet-->
    <link rel="stylesheet" href="style.css">
</head>

<main>

    <div class="container text-center">
    <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"></i> Book Store</h1>
        <div class="d-flex justify-content-center">
            <form action="" method="post" class="w-50">
                <div class="pt-2">
                    <?php inputelement("<i class='fas fa-id-badge'></i>","ID","book_id",setID());
                    ?>
                    </div>
                    <div class="pt-2">
                        <?php inputelement("<i class='fas fa-book'></i>","Book Name","book_name","");
                        ?>
                    </div>
                <div class="pt-2">
                    <?php inputelement("<i class='fas fa-id-badge'></i>","ISBN","isbn","");
                    ?>
                </div>
                <div class="pt-2">
                    <?php inputelement("<i class='fas fa-user'></i>","Book Author","book_author","");
                    ?>
                </div>

                <div class="pt-2">
                <div class="col"> Category: <i class='fas fa-book'></i>   <?php selectElement("category");
                    ?>
                </div>
                </div>

                <div class="row pt-2">
                    <div class="col"><?php inputelement("<i class='fas fa-calendar'></i>","Published Year","published_year","");
                        ?>
                  </div>
                    <div class="col">
                        <?php inputelement("<i class='far fa-money-bill-alt'></i>","Price","book_price","");
                        ?>
                    </div>

                <div class="d-flex justify content-center">
                    <?php buttonElement("btn-add","btn btn-success","Add","add","")?>
                    <?php buttonElement("btn-view","btn btn-warning","View","view","")?>
                    <?php buttonElement("btn-edit","btn btn-secondary","Update","update","")?>
                    <?php buttonElement("btn-delete","btn btn-danger","Delete","delete","")?>
                    <?php deleteBtn()?>
                </div>
            </form>

       <!--Bootstrap table-->
            <!--Books Table-->
       <div class="d-flex table-data">
           <table class="table table-striped table-dark">
               <thead class="thread-dark">
                   <tr>
                       <th>Book ID</th>
                       <th>Book Title</th>
                       <th>ISBN</th>
                       <th>Book Author</th>
                       <th>Published Year</th>
                       <th>Book Price(LKR)</th>
                       <th>Edit</th>
                   </tr>
               </thead>
               <tbody id="tbody">
               <?php
               if(isset($_POST['view'])){
                  $result= getData();

                  if($result){
                      while($row=mysqli_fetch_assoc($result)){
                          ?>

                          <tr>
                              <td data-id="<?php echo $row['id'];?>"> <?php echo $row['id'];?></td>
                              <td data-id="<?php echo $row['id'];?>"> <?php echo $row['book_name'];?></td>
                              <td data-id="<?php echo $row['id'];?>"> <?php echo $row['isbn'];?></td>
                              <td data-id="<?php echo $row['id'];?>"> <?php echo $row['book_author'];?></td>
                              <td data-id="<?php echo $row['id'];?>"> <?php echo $row['category'];?></td>
                              <td data-id="<?php echo $row['id'];?>"> <?php echo $row['published_year'];?></td>
                              <td data-id="<?php echo $row['id'];?>"> <?php echo $row['book_price']." RS";?></td>
                              <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['id'];?>"></i></td>
                          </tr>
                          <?php
                      }
                  }
               }
               ?>
               </tbody>
           </table>
          </div>
        </div>
    </div>
            <!--Categories Table-->
    <div class="d-flex table-data justify-content-center">
        <table class="table table-striped table-dark">
            <thead class="thread-dark">
            <tr>
                <th>Categories</th>
                <th>Book ISBN</th>
                <th>Book Name</th>
            </tr>
            </thead>
            <tbody id="tbody">
            <?php

           $category =  getCategory();

                  if($category)
                      while($row=mysqli_fetch_assoc($category)) {
                          ?>
                          <tr>
                              <td data-id="<?php echo $row['id']; ?>"> <?php echo $row['category']; ?></td>
                              <td data-id="<?php echo $row['id']; ?>"> <?php echo $row['id']; ?></td>
                              <td data-id="<?php echo $row['id']; ?>"> <?php echo $row['book_name']; ?></td>

                          </tr>
                          <?php
                      }
            ?>

            <!--Author Table-->
            <div class="d-flex table-data justify-content-center">
                <table class="table table-striped table-dark">
                    <thead class="thread-dark">
                    <tr>
                        <th>Author</th>
                        <th>Book ISBN</th>

                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php

                    $author =  getAuthor();

                    if($author)
                        while($row=mysqli_fetch_assoc($author)) {
                            ?>
                            <tr>
                                <td data-id="<?php echo $row['id']; ?>"> <?php echo $row['book_Author']; ?></td>
                                <td data-id="<?php echo $row['id']; ?>"> <?php echo $row['id']; ?></td>


                            </tr>
                            <?php
                        }
                    ?>

            </tbody>
        </table>

    </div>
    </div>
    </div>

</main>
<!--Bootstrap library scripts-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="../crud/php/main.js"></script>
<body>
</html>