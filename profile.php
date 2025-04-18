<?php
session_start();
require "config.php";
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    header("Location: login.html");
    exit();
}
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $fullName = $row["fullName"];
  $email = $row["email"];
  $tel = $row["tel"];
  $gender = $row["gender"];
  $dateJoined = $row["dateJoined"];
  $dateJoined = date("d F Y", strtotime($dateJoined));
}
$stmt->close();

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
  <header class="profileUser">
    <h1><i><?php echo $username ?></i></h1>
  </header> 
  <body>
    <div id="profileInfo">
      <h2>Profile Info</h2>
        <h5>Username: <?php echo $username ?></h5>
        <h5>Full Name: <?php echo $fullName ?></h5>
        <h5>Email: <?php echo $email ?></h5>
        <h5>Tel: <?php echo $tel ?></h5>
        <h5>Gender: <?php echo $gender ?></h5>
        <h5>Date Joined: <?php echo $dateJoined ?></h5>
      <!--Button from Bootstrap-->
      <button type="button" id="changeInfo" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#changeInfoForm">Change Profile Information</button></br>
      <a href="logout.php" id="logOut" class="btn btn-danger btn-sm">Log Out</a>
    </div>
    <!-- Modal taken from Bootstrap -->
    <div class="modal fade" id="changeInfoForm" tabindex="-1" aria-labelledby="profileInfoForm" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changeProfileInfo">Change Profile Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Grid layout taken from Bootstrap -->
            <div class="container" id="changeOptions">
              <div class="row">
                <button class="col btn btn-info" type="button" onclick="showForm('changeUsername')">Change Username</button>
                <button class="col btn btn-info" type="button" onclick="showForm('changePassword')">Change Password</button>
                <div class="w-100"></div>
                <button class="col btn btn-info" type="button" onclick="showForm('changeEmail')">Change Email</button>
                <button class="col btn btn-info" type="button" onclick="showForm('changeTel')">Change Phone Number</button>
              </div>
            </div>
            <div>
              <form id="changeUsername" class="changeForms" action="changeUsername.php" method="POST">
                <label for="username">New Username:</label><br>
                <input type="text" id="newUsername" name="newUsername"><br><br>
                <input type="submit" value="Save Changes">
              </form>
              <form id="changePassword" class="changeForms" action="changePassword.php" method="POST">
                <label for="password">Old Password:</label><br>
                <input type="password" id="oldPassword" name="oldPassword"><br><br>
                <label for="password">New Password:</label><br>
                <input type="password" id="newPassword" name="newPassword"><br><br>
                <input type="submit" value="Save Changes">
              </form>
              <form id="changeEmail" class="changeForms" action="changeEmail.php" method="POST">
                <label for="email">New Email:</label><br>
                <input type="email" id="newEmail" name="newEmail"><br><br>
                <input type="submit" value="Save Changes">
              </form>
              <form id="changeTel" class="changeForms" action="changeTel.php" method="POST">
                <label for="phoneNumber">New Phone Number:</label><br>
                <input type="tel" id="newTel" name="newTel"><br><br>
                <input type="submit" value="Save Changes">
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="goBack" class="btn btn-secondary" onclick="hideForm()">Go Back</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--Grid layout taken from Bootstrap-->
    <h2 id="masterclassInfo">Current Masterclasses (3)</h2>
    <div class="container-fluid text-center">
      <div class="row">
        <div class="col-lg-4">
          <img src="images/Masterclass1_small.jpg" alt ="Masterclass 1" class="masterclassImage"><br>
            <a href="images/Masterclass1.jpg" class="viewFullImage">View full image</a>
          <h5>Masterclass for Basketball</h5>
          <h6>Registered on: 9th December 2024</h6>
          <h6>Progress: 12 / 23 Classes Completed</h6>
          <h6>Status: Ongoing</h6>
          <details>
            <summary>More info</summary>
            <p>Kirklees Local TV - Free Basketball Masterclasses (for 12-17-year-olds) with former 
              British Basketball League and Team GB Professional Andre Rankine. Held at Deighton Sports 
              Arena, Deighton Road, Huddersfield, West Yorkshire, HD2 1JP.<br><br>
              For more information, please contact:<br>
              017-777-7777 James</p>
          </details>
        </div>
        <div class="col-lg-4">
          <img src="images/Masterclass2_small.png" alt ="Masterclass 2" class="masterclassImage"></a><br>
            <a href="images/Masterclass2.png" class="viewFullImage">View full image</a>
          <h5>Masterclass for Football</h5>
          <h6>Registered on: 13rd January 2025</h6>
          <h6>Progress: 7 / 31 Classes Completed</h6>
          <h6>Status: Ongoing</h6>
          <details>
            <summary>More info</summary>
            <p>The football clinic, organized in partnership with the Pilipinas Football Association, 
              will be headed by coaches Marnie Marasigan and Albert Besa. The badminton clinic, on the 
              other hand, is facilitated by Doddie Gutierrez. You can re-learn the basics and even some 
              pro techniques to make how you play a lot more fun and interesting. <br><br>
              For more information, please contact:<br>
              018-888-8888 Emily</p>
          </details>
        </div>
        <div class="col-lg-4">
          <img src="images/Masterclass3_small.png" alt ="Masterclass 3" class="masterclassImage"></a><br>
            <a href="images/Masterclass3.png" class="viewFullImage">View full image</a>
            <h5>Masterclass for Thai Cooking</h5>
            <h6>Registered on: 7th February 2025</h6>
            <h6>Progress: 3 / 19 Classes Completed</h6>
            <h6>Status: Ongoing</h6>
          <details>
            <summary>More info</summary>
            <p>One session spans 3.5-4 hours and is available thrice in a day in the morning, afternoon 
              and evenings. You will be taught 5 dishes in one session along with a market tour at the 
              starting which will give you an understanding of all the basic ingredients fresh from the 
              supermarket that goes into cooking.<br><br>
              For more information, please contact:<br>
              019-999-9999 Michael</p>
          </details>
        </div>
      </div>
    </div>
    <div id="userReview">
      <h2>Your Reviews</h2>
      <div class="container">
        <div class="row row-cols-1">
          <!-- Collapse component taken from Bootstrap -->
          <button class="col-lg-10 btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#BasketballReview" aria-expanded="false" aria-controls="BasketballReview">Masterclass for Basketball</button>
          <div class="collapse multi-collapse" id="BasketballReview">
            <div class="card card-body">
              No review given yet on Masterclass for Basketball.
            </div>
          </div>
          <button class="col-lg-10 btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#FootballReview" aria-expanded="false" aria-controls="FootballReview">Masterclass for Football</button>
          <div class="collapse multi-collapse" id="FootballReview">
            <div class="card card-body">
              No review given yet on Masterclass for Football.
            </div>
          </div>
          <button class="col-lg-10 btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#ThaiCookingReview" aria-expanded="false" aria-controls="ThaiCookingReview">Masterclass for Thai Cooking</button>
          <div class="collapse multi-collapse" id="ThaiCookingReview">
            <div class="card card-body">
              No review given yet on Masterclass for Thai Cooking.
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <a href="#top" class="toTop">Go to Top</a>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="script.js"></script>
</main>
</html>