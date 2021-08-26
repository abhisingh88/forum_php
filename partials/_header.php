<?php
session_start();
include "partials/_dbconnect.php";
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/forum/">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum/">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Top Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
                $result = mysqli_query($conn, $sql); 
                while($row = mysqli_fetch_assoc($result)){
                    echo '<a class="dropdown-item" href="threadlist.php?catid='. $row['category_id']. '">' . $row['category_name']. '</a>'; 
                }        
                ?>
            </div>
        </li>
        <li class="nav-item">
                <a class="nav-link " href="contact.php" tabindex="-1" >Contact</a>
                </li>
                </ul>
                <div class="row mx-2">
                <div class="d-flex align-content-end flex-wrap">
                
                <?php
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                        echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
                          <input class="form-control mr-sm-2" name="search" type="search" actiion="search.php" placeholder="Search" aria-label="Search">
                          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                            <p class="text-light my-0 mx-2">Welcome '. $_SESSION['useremail']. ' </p>
                            <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>
                            </form>';
                      }
                      else{ 
                        echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php" >
                          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                          </form>
                          <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
                          <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>';
                        }
                      
                ?>
                </div>    
            </div>
    </div>
</nav>
            
<?php
include "partials/_loginModal.php";
include "partials/_signupModal.php";

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              <strong>Success!</strong> You can now login
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
}

?>