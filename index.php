<?php
session_start();
require "config.php";
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpUniMasterclass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<main>
  <!--Navbar and button taken from Bootstrap-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i>HelpUniMasterclass</i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Main Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
        </ul>
        <a class="btn btn-danger" href="fawaz WEB form.html">Apply Now</a>
      </div>
    </div>
  </nav>
  <header class="greeting">
    <h1>Hello, <i><?php echo $username ?></i></h1>
    <h3>Welcome back to <i>HelpUniMasterclass!</i></h3>
  </header>
  <body class="MyMasterclasses">
    <h2>My Masterclasses</h2>
    <!--Grid layout, button and modal taken from Bootstrap-->
    <div class="container-fluid text-center">
      <div class="row">
        <div class="col-lg-4">
          <img src="images/Masterclass1_small.jpg" alt ="Masterclass 1" class="masterclassImage"><br>
            <a href="images/Masterclass1.jpg" class="viewFullImage">View full image</a>
          <h5>Masterclass for Basketball</h5>
          <h6>Next Class: 5th March 2025</h6>
          <h6>Progress: 12 / 23 Classes Completed</h6>
          <details>
            <summary>More info</summary>
            <p>Kirklees Local TV - Free Basketball Masterclasses (for 12-17-year-olds) with former 
              British Basketball League and Team GB Professional Andre Rankine. Held at Deighton Sports 
              Arena, Deighton Road, Huddersfield, West Yorkshire, HD2 1JP.<br><br>
              For more information, please contact:<br>
              017-777-7777 James</p>
          </details>
          <button type="button" id="giveReview" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reviewForm">Give Review</button>
        </div>
        <div class="col-lg-4">
          <img src="images/Masterclass2_small.png" alt ="Masterclass 2" class="masterclassImage"></a><br>
            <a href="images/Masterclass2.png" class="viewFullImage">View full image</a>
          <h5>Masterclass for Football</h5>
          <h6>Next Class: 7th March 2025</h6>
          <h6>Progress: 7 / 31 Classes Completed</h6>
          <details>
            <summary>More info</summary>
            <p>The football clinic, organized in partnership with the Pilipinas Football Association, 
              will be headed by coaches Marnie Marasigan and Albert Besa. The badminton clinic, on the 
              other hand, is facilitated by Doddie Gutierrez. You can re-learn the basics and even some 
              pro techniques to make how you play a lot more fun and interesting. <br><br>
              For more information, please contact:<br>
              018-888-8888 Emily</p>
          </details>
          <button type="button" id="giveReview" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reviewForm">Give Review</button>
        </div>
        <div class="col-lg-4">
          <img src="images/Masterclass3_small.png" alt ="Masterclass 3" class="masterclassImage"></a><br>
            <a href="images/Masterclass3.png" class="viewFullImage">View full image</a>
            <h5>Masterclass for Thai Cooking</h5>
            <h6>Next Class: 4th March 2025</h6>
            <h6>Progress: 3 / 19 Classes Completed</h6>
          <details>
            <summary>More info</summary>
            <p>One session spans 3.5-4 hours and is available thrice in a day in the morning, afternoon 
              and evenings. You will be taught 5 dishes in one session along with a market tour at the 
              starting which will give you an understanding of all the basic ingredients fresh from the 
              supermarket that goes into cooking.<br><br>
              For more information, please contact:<br>
              019-999-9999 Michael</p>
          </details>
          <button type="button" id="giveReview" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reviewForm">Give Review</button>
        </div>
      </div>  
    </div>
    <!-- Modal for review form -->
    <div class="modal fade" id="reviewForm" tabindex="-1" aria-labelledby="masterclassReviewForm" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reviewFormLabel">Review Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form taken from Bootstrap-->
            <form action="submitReview.php" method="POST">
              <div class="form-group">
                <label for="reviewFormSelect">Select Masterclass:</label>
                <select class="form-control" id="reviewFormSelect">
                  <option>Masterclass for Basketball</option>
                  <option>Masterclass for Football</option>
                  <option>Masterclass for Thai Cooking</option>
                </select>
              </div><br>
              <div class="form-group">
                <label for="masterclassReview">Give your review:</label>
                <textarea class="form-control" id="masterclassReview" rows="3"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <h2>Recommended Masterclasses</h2>
    <!--Grid layout and button taken from Bootstrap-->
    <div class="container-fluid text-center">
      <div class="row">
        <div class="col-lg-4">
          <img src="images/Masterclass4_small.jpg" alt ="Masterclass 4" class="masterclassImage"></a><br>
            <a href="images/Masterclass4.jpg" class="viewFullImage">View full image</a>
          <h5>Masterclass for Coffee Roasting</h5>
          <h6>Total Classes: 21 Classes</h6>
          <details>
            <summary>More info</summary>
            <p>Ever wondered how your favorite coffee gets its unique flavors? Join our Coffee Roasting 
              Class - an immersive, hands-on experience where you’ll roast, cup, and take home your very 
              own specialty beans!<br><br>
              For more information, please contact:<br>
            013-333-3333 Jessica</p>
          </details>
        </div>
        <div class="col-lg-4">
          <img src="images/Masterclass5_small.jpg" alt ="Masterclass 5" class="masterclassImage"><br>
            <a href="images/Masterclass5.jpg" class="viewFullImage">View full image</a>
          <h5>Masterclass for Chinese Tea Art</h5>
          <h6>Total Classes: 28 Classes</h6>
          <details>
            <summary>More info</summary>
            <p>In collaboration with Koharu Japanese Online Learning & Cultural Service, we are 
              conducting a Tea Tasting class in both Japanese and English on 22 Feb. This class is 
              suitable for students who speaks Japanese as their first language.<br><br>
              For more information, please contact:<br>
              014-444-4444 Sarah</p>
          </details>
        </div>
        <div class="col-lg-4">
          <img src="images/Masterclass6_small.jpg" alt ="Masterclass 6" class="masterclassImage"></a><br>
            <a href="images/Masterclass6.jpg" class="viewFullImage">View full image</a>
          <h5>Masterclass for Gundam</h5>
          <h6>Total Classes: 36 Classes</h6>
          <details>
            <summary>More info</summary>
            <p>Gundam Workshop Course Available (for ages 16 and above). Certificates will be prepared
              for all participants.<br><br>
              For more information, please contact:<br>
              015-555-5555 David</p>
          </details>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <a href="#top" class="toTop">Go to Top</a>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</main>
</html>