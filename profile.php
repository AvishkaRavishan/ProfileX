<?php
include '../php/connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare a statement to retrieve user details using prepared statements
    $sql = "SELECT * FROM users WHERE userID = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameter and execute the statement
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    }
    $stmt->close();
}

// Prepare a statement to retrieve gallery data using prepared statements
if (isset($userId)) {
    $sql1 = "SELECT * FROM gallery WHERE image_data = ?";
    $stmt1 = $conn->prepare($sql1);

    // Bind the parameter and execute the statement
    $stmt1->bind_param("i", $userId);
    $stmt1->execute();

    // Get the result
    $result1 = $stmt1->get_result();

    // Check if the query was successful
    if ($result1 && $result1->num_rows > 0) {
        // Handle the result
    }
    $stmt1->close();
}
?>
<?php

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare a statement to retrieve user details using prepared statements
    $sql = "SELECT * FROM socials WHERE userID = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameter and execute the statement
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $userDetails2 = $result->fetch_assoc();
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SynerX Beta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/svg" href="https://synerx.sirigampola.com/assets/favicon.svg" />
    <!-- Meta tags for SEO and social media -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Project SynerX">
    <meta name="keywords" content="global, synerx, business, sirigampola, project">
    <meta name="author" content="Sirigampola Holdings">
    <!-- Open Graph tags -->
    <meta property="og:title" content="SynerX Beta" />
    <meta property="og:description" content="Project SynerX" />
    <meta property="og:image" content="https://synerx.sirigampola.com/assets/synerx.png" />
    <meta property="og:url" content="https://synerx.sirigampola.com" />
    <meta property="og:type" content="website" />
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="SynerX Beta" />
    <meta name="twitter:description" content="Project SynerX" />
    <meta name="twitter:image" content="https://synerx.sirigampola.com/assets/synerx.png" />
  </head>
  <body>
    <!-- SynerX Navbavr -->
    <div class=".container " id="main">
      <nav class="navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="https://synerx.sirigampola.com">
            <b>SynerX</b>
          </a>
        </div>
      </nav>
      <!-- Glass -->
      <div class="glass">
        <!-- Save Icon -->
        <div class="save-icon" id="downloadVcfButton">
          <i class="bi bi-save"></i>
        </div>
        <section class="socials">
          <!-- Profile Picture and a little summary -->
          <div class="profile">
            <img src="../php/user/img/user/uploads/profile_picture/<?php echo $userDetails['ProPic']; ?>" alt="profile-picture" />
            <h3><?php echo $userDetails['Name']; ?> <i class="bi bi-patch-check"></i>
            </h3>
            <p class="summary"><?php echo $userDetails['Position']; ?></p>
          </div>
          <!-- Socials Links -->
          <div class="d-flex justify-content-center">
            <a class="icon-link" href="<?php echo $userDetails2['Linkedin']; ?>">
              <i class="bi bi-linkedin"></i>
            </a>
            <a class="icon-link" href="<?php echo $userDetails2['Facebook']; ?>">
              <i class="bi bi-facebook"></i>
            </a>
            <a class="icon-link" href="<?php echo $userDetails2['Twitter']; ?>">
              <i class="bi bi-twitter"></i>
            </a>
            <a class="icon-link" href="<?php echo $userDetails2['Instagram']; ?>">
              <i class="bi bi-instagram"></i>
            </a>
            <a class="icon-link" href="<?php echo $userDetails['Email']; ?>">
              <i class="bi bi-envelope-check-fill" href="mailto:<?php echo $userDetails['Email']; ?>"></i>
            </a>
        </section>
        <!-- Tiles  -->
        <section class="tiles d-flex flex-column align-items-center ">
          <a class="tile" href="https://sirigampola.com">
            <p>Visit Company Website</p>
          </a>
          <section class="tiles d-flex flex-column align-items-center">
            <a class="tile" href="tel:<?php echo $userDetails['contact']; ?>">
                <p>Mobile No: <?php echo $userDetails['contact']; ?></p>
            </a>
          <section class="tiles d-flex flex-column align-items-center">
            <a class="tile" href="<?php echo $userDetails['Email']; ?>">
                <p>Email: <?php echo $userDetails['Email']; ?></p>
            </a>
          <!-- Card -->
          <div class="cards d-flex flex-column align-items-center">
            <a href="https://synerx.lk" class="card">
              <img src="../php/user/img/user/uploads/covers/<?php echo $userDetails['CoverPhoto']; ?>" class="img-fluid" alt="SynerX">
              <p><?php echo $userDetails['Description']; ?></p>
            </a>
          </div>
        </section>
      </div>
      <!-- Network Icon Button -->
      <div class="network-btn-container">
        <button class="network-btn">
          <i class="bi bi-person-plus-fill"></i>
        </button>
      </div>
      <footer>
        <p>© SynerX V2.0 All Rights Reserved.</p>
      </footer>
    </div>
    <!-- Floating Share Icon Button -->
    <div class="floating-btn" onclick="shareWebpage(this)">
      <i class="bi bi-share"></i>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
    <script>
      VANTA.NET({
        el: "#main",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        backgroundColor: 0x0
      })

      document.getElementById('downloadVcfButton').addEventListener('click', function() {
                            window.location.href = '../php/user/php/create_vcf.php?id=<?php echo $userDetails['userID']; ?>';
                        });
      
      function shareWebpage(element) {
          var userId = element.getAttribute('data-userid');
          var username = element.getAttribute('data-username');

          if (navigator.share) {
              navigator.share({
                  title: document.title,
                  text: 'Check out the profile of ' + username + '!',
                  url: 'http://synerx.lk/sprint3/dist/profile/index.php?id=' + userId,
              })
              .then(() => console.log('Webpage shared successfully'))
              .catch((error) => console.error('Error sharing webpage:', error));
          } else {
              alert('Web Share API is not supported on this device.');
          }
      }
    </script>
  </body>
</html>
