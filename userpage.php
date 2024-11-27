  <?php


    $selectedBranch = isset($_GET['branch']) ? $_GET['branch'] : '';
    ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Homepage</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">
      <style>
    .logo-container {
    display: flex;
    align-items: center;
}

.logo-image img {
    width: 50px; /* Adjust size as needed */
    height: auto;
    margin-right: 10px; /* Space between logo and text */
}

.logo-text {
    font-size: 18px; /* Adjust text size as needed */
    text-decoration: none;
    color: #000; /* Adjust text color as needed */
}

.logo-text span {
    font-weight: bold; /* Highlight "Science and Technology" */
}

</style>


  </head>

  <body>

      <div class="container">

          <header>
              <div class="logo-container">
                  <div class="logo-image" >
                      <img src="img/logobg.png" alt="Logo">
                  </div>
                  <a href="#" class="logo-text">
                      Granby Colleges of <span>Science and Technology</span>
                  </a>
              </div>
              <nav class="navbar">
                  <a>Go beyond learning</a>

              </nav>

          </header>



          <!-- home section  -->
          <section class="home">
              <div class="content">
                  <h3>Learning Today, <span style="color:#B8860B;"><br>Leading Tomorrow.</span></h3>
                  <p>Automated Faculty Evaluation and Monitoring System</p>
                  <button class="btn" onclick="window.location.href='?branch=Granby College'">Register now</button>

              </div>
              <div class="image">
                  <img src="img/front1.jpg" alt="">
              </div>
          </section>

<!-- dynamic branch content section -->
<section class="branch-content">
    <div id="Granby College" <?php if ($selectedBranch == 'Granby College') echo 'style="display: block;"'; ?>>
        <div class="flex-parent">
            <!-- Management Login -->
            <div class="boxx management-box">
                <h2>Management Login</h2>
                <a href="m-login.php" class="btnn">Click here</a>
            </div>

            <!-- Student Login -->
            <div class="boxx student-box">
                <h2>Student Login</h2>
                <a href="Slogin.php?branch=<?php echo urlencode($selectedBranch); ?>" class="btnnn">Click here</a>
            </div>

            <!-- Staff Login -->
            <div class="boxx staff-box">
                <h2>Staff Login</h2>
                <a href="staff-login.php?branch=<?php echo urlencode($selectedBranch); ?>" class="btnnn">Click here</a>
            </div>
        </div>
    </div>
</section>





          <!-- footer section  -->

          <section class="footer">

              <div class="box-container">

                  <div class="box">
                      <h3>about us</h3>
                      <a href="mission.html">Vision & Mission</a>

                  </div>

                  <div class="box">
                      <h3>quick links</h3>
                      <a href="#">home</a>
                      <a href="#">course</a>

                  </div>

                  <div class="box">
                      <h3>follow us</h3>
                      <a href="https://www.facebook.com/granbycollegesofscienceandtechnology00">facebook</a>

                  </div>

                  <div class="box">
                      <h3>contact us</h3>
                      <p> <i class="fas fa-phone"></i> (046) 412-0437 </p>
                      <p> <i class="fas fa-envelope"></i> Granby Colleges of Science and Technology </p>
                      <p> <i class="fas fa-map-marker-alt"></i>Ibayo Silangan, Naic, Cavite</p>
                  </div>

              </div>


          </section>

      </div>















      <!-- custom js file link -->
      <script>
          document.addEventListener('DOMContentLoaded', (event) => {
              // Select all text-containing elements, excluding form elements
              const textElements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, a, li');

              textElements.forEach(element => {
                  // Add a subtle transition to each text element
                  element.style.transition = 'color 0.3s ease, transform 0.3s ease';

                 
              });

              // Add a subtle animation for mobile devices
              if ('ontouchstart' in window) {
                  function animateTextElements() {
                      textElements.forEach(element => {
                          element.style.transform = `translateY(${Math.sin(Date.now() / 1000) * 2}px)`;
                      });
                      requestAnimationFrame(animateTextElements);
                  }
                  animateTextElements();
              }
          });

          function removeBranchParam() {
              const url = new URL(window.location.href);
              url.searchParams.delete('branch');
              window.history.replaceState({}, document.title, url); // Update the URL without reloading the page
          }

          // Call the function when the page loads
          window.onload = removeBranchParam;
      </script>

      <style>
          * {
              font-family: 'Nunito', sans-serif;
              margin: 0;
              padding: 0;
              box-sizing: border-box;
              outline: none;
              border: none;
              text-decoration: none;
              text-transform: capitalize;
              transition: all .2s ease-out;
          }

          .branch-content>div {
              display: none;
          }

          .boxx h2 {
              -webkit-background-clip: text;
              background-clip: text;
              font-size: 18px;

          }

          .flex-parent {
              display: flex;
              justify-content: center;
              align-items: center;
              flex-wrap: wrap;
          }

          .boxx {
              box-shadow: 0 5px 10px rgba(0, 0, 0, 10);
              flex: 1;
              padding: 5px;
              margin: 5px;
              border: 1px solid #ccc;

              border-radius: 10px;
              text-align: center;
              min-width: 200px;
              color: #fff;
          }

          .management-box {
              background-color: #245580;
              box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
          }

          .student-box {
              background-color: var(--dark-yellow);
              box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
          }

          .staff-box {
              background-color: darkgreen;
              box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
          }

          @media screen and (max-width: 768px) {
              .boxx {
                  flex: 1;
                  padding: 10px;
                  margin: 10px;
                  border: 1px solid #ccc;
                  background-color: rgba(255, 255, 255, 0.5);
                  /* Transparent background */
                  border-radius: 5px;
                  text-align: center;
              }



              .management-box {
                  background-color: #245580;
                  box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
              }

              .student-box {
                  background-color: var(--dark-yellow);
                  box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
              }
          }

          @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap');

          :root {
              --dark-bluee: #000080;
              --dark-blue: #245580;
              --dark-yellow: #B8860B;
              --gradient: linear-gradient(100deg, var(--dark-blue), var(--dark-yellow));
              --gradientt: linear-gradient(100deg, var(--dark-blue), var(--dark-yellow));
          }

          * {
              font-family: 'Nunito', sans-serif;
              margin: 0;
              padding: 0;
              box-sizing: border-box;
              outline: none;
              border: none;
              text-decoration: none;
              text-transform: capitalize;
              transition: all .2s ease-out;
          }

          html {
              font-size: 62.5%;
              overflow-x: hidden;
          }

          html::-webkit-scrollbar {
              width: 1rem;
          }

          html::-webkit-scrollbar-track {
              background: #333;
          }

          html::-webkit-scrollbar-thumb {
              background: #333;
              border-radius: 2rem;
          }

          body {

              background-image: url(img/background1.jpg);
              padding: 5rem 7%;
          }

          section {
              padding: 2rem 7%;
          }

          .container {
              background: #fff;
              border-radius: 1rem;
              box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
          }

          .heading {
              color: transparent;
              background: var(--gradient);
              -webkit-background-clip: text;
              background-clip: text;
              padding: 0 1rem;
              padding-top: 2.5rem;
              text-align: center;
              font-size: 4rem;
              text-transform: uppercase;
          }

          .btn {
              display: inline-block;
              margin-top: 1rem;
              padding: .8rem 3rem;
              border-radius: .5rem;
              background: var(--gradient);
              color: #fff;
              cursor: pointer;
              font-size: 1.7rem;
          }

          .btnn {
              display: inline-block;
              margin-top: 0.3rem;
              padding: .8rem 3rem;
              border-radius: .5rem;
              background: #B8860B;
              color: #fff;
              cursor: pointer;
              font-size: 1.3rem;
          }

          .btnnn {
              display: inline-block;
              margin-top: 0.3rem;
              padding: .8rem 3rem;
              border-radius: .5rem;
              background: #245580;
              color: #fff;
              cursor: pointer;
              font-size: 1.3rem;
          }

          .btn:hover {
              color: #fff;
              background-color: #000080;
          }

          header {
              display: flex;
              align-items: center;
              justify-content: space-between;
              width: 100%;
              padding: 2rem 7%;
              border-bottom: .1rem solid rgba(0, 0, 0, .1);
              position: relative;
              z-index: 1000;
          }

          header .logo {
              font-size: 2.5rem;
              color: var(--dark-blue);
              font-weight: bold;
          }

          header .logo span {
              color: var(--dark-yellow);
          }

          header .navbar a {
              margin-left: 2rem;
              font-size: 2rem;
              color: #333;
          }

          header .navbar a:hover {
              color: var(--dark-yellow);
          }

          #menu {
              font-size: 2.5rem;
              padding: .5rem 1rem;
              border-radius: .3rem;
              border: .1rem solid rgba(0, 0, 0, .2);
              cursor: pointer;
              display: none;
          }

          .home {
              display: flex;
              flex-wrap: wrap;
              gap: 1.5rem;
              align-items: center;
          }

          .home .content {
              flex: 1 1 40rem;
          }

          .home .image {
              flex: 1 1 40rem;
          }

          .home .image img {
              width: 100%;
          }

          .home .content h3 {
              color: transparent;
              background: var(--gradient);
              -webkit-background-clip: text;
              background-clip: text;
              font-size: 4rem;
          }

          .home .content p {
              padding: .5rem 0;
              font-size: 1.7rem;
              color: #666;
          }

          .course {
              display: flex;
              flex-wrap: wrap;
              gap: 1.5rem;
          }

          .course .box {
              flex: 1 1 30rem;
              border-radius: .5rem;
              border: .1rem solid rgba(0, 0, 0, .1);
              padding: 1rem;
              position: relative;
          }

          .course .box img {
              height: 20rem;
              width: 100%;
          }

          .course .box .amount {
              position: absolute;
              top: 1rem;
              left: 1rem;
              font-size: 2rem;
              padding: .5rem 1rem;
              background: var(--dark-yellow);
              color: #fff;
              border-radius: .5rem;
          }

          .course .box .stars i {
              color: var(--dark-blue);
              font-size: 1.5rem;
              padding: 1rem 0;
          }

          .course .box h3 {
              color: var(--dark-yellow);
              font-size: 2.5rem;
          }

          .course .box p {
              color: #666;
              font-size: 1.5rem;
              padding: .5rem 0;
          }

          .course .icons {
              display: flex;
              justify-content: space-between;
              border-top: .1rem solid rgba(0, 0, 0, .1);
              margin-top: 1rem;
              padding: .5rem;
              padding-top: 1rem;
          }

          .course .icons p {
              color: #666;
              font-size: 1.3rem;
          }

          .course .icons p i {
              padding-right: .4rem;
              color: var(--dark-yellow);
          }

          .teacher {
              display: flex;
              flex-wrap: wrap;
              gap: 1.5rem;
          }

          .teacher .box {
              flex: 1 1 23rem;
              border: .1rem solid rgba(0, 0, 0, .1);
              border-radius: .5rem;
              padding: 1.5rem;
              text-align: center;
          }

          .teacher .box img {
              height: 10rem;
              width: 10rem;
              margin: .5rem 0;
              border-radius: 50%;
              object-fit: cover;
          }

          .teacher .box h3 {
              color: var(--dark-blue);
              font-size: 2.5rem;
          }

          .teacher .box span {
              color: var(--dark-yellow);
              font-size: 2rem;
          }

          .teacher .box p {
              color: #666;
              font-size: 1.5rem;
              padding: 1rem 0;
          }

          .teacher .box .share a {
              height: 4rem;
              width: 4rem;
              line-height: 4rem;
              font-size: 2rem;
              background: var(--dark-yellow);
              border-radius: .5rem;
              margin: .3rem;
              color: #fff;
          }

          .teacher .box .share a:hover {
              background: var(--dark-blue);
          }

          .price {
              display: flex;
              flex-wrap: wrap;
              gap: 1.5rem;
          }

          .price .box {
              flex: 1 1 30rem;
              text-align: center;
              border: .1rem solid rgba(0, 0, 0, .1);
              border-radius: .5rem;
          }

          .price .box h3 {
              font-size: 2.5rem;
              color: #333;
              padding: 1.5rem 0;
          }

          .price .box .amount {
              font-size: 4.5rem;
              color: #fff;
              padding: 1rem 0;
              background: var(--gradient);
              font-weight: bold;
          }

          .price .box .amount span {
              font-size: 2rem;
          }

          .price .box ul {
              border-bottom: .1rem solid rgba(0, 0, 0, .1);
              padding: 1rem 0;
              list-style: none;
          }

          .price .box ul li {
              padding: .7rem 0;
              font-size: 1.7rem;
              color: #666;
          }

          .price .box .btn {
              margin: 2rem 0;
          }

          .review {
              display: flex;
              flex-wrap: wrap;
              gap: 1.5rem;
          }

          .review .box {
              border-radius: .5rem;
              border: .1rem solid rgba(0, 0, 0, .1);
              padding: 1rem;
              flex: 1 1 30rem;
          }

          .review .box .student {
              display: flex;
              align-items: center;
              justify-content: space-between;
          }

          .review .box .student .student-info {
              display: flex;
              align-items: center;
          }

          .review .box .student i {
              font-size: 6rem;
              color: var(--dark-yellow);
              opacity: .5;
          }

          .review .box .student .student-info img {
              border-radius: 50%;
              object-fit: cover;
              height: 7rem;
              width: 7rem;
              margin-right: 1.5rem;
          }

          .review .box .student .student-info h3 {
              font-size: 2rem;
              color: #333;
          }

          .review .box .student .student-info span {
              font-size: 1.5rem;
              color: var(--dark-yellow);
          }

          .review .box .text {
              padding: 1rem 0;
              font-size: 1.6rem;
              color: #666;
          }

          .contact {
              display: flex;
              flex-wrap: wrap;
              gap: 1.5rem;
          }

          .contact .image {
              flex: 1 1 35rem;
          }

          .contact .image img {
              width: 100%;
          }

          .contact form {
              flex: 1 1 50rem;
              border: .1rem solid rgba(0, 0, 0, .1);
              border-radius: .5rem;
              padding: 2rem;
          }

          .contact form .inputBox {
              display: flex;
              justify-content: space-between;
              flex-wrap: wrap;
          }

          .contact form .inputBox input,
          .contact form .box,
          .contact form textarea {
              width: 100%;
              padding: 1rem;
              margin: .7rem 0;
              font-size: 1.7rem;
              border: .1rem solid rgba(0, 0, 0, .1);
              border-radius: .5rem;
              text-transform: none;
              color: #333;
          }

          .contact form .inputBox input:focus,
          .contact form .box:focus,
          .contact form textarea:focus {
              border-color: var(--dark-yellow);
          }

          .contact form .inputBox input {
              width: 49%;
          }

          .contact form textarea {
              height: 20rem;
              resize: none;
          }






















          .footer .box-container {
              display: flex;
              flex-wrap: wrap;
              gap: 1.5rem;
          }

          .footer .box-container .box {
              flex: 1 1 20rem;
          }

          .footer .box-container .box h3 {
              font-size: 2.5rem;
              color: var(--dark-blue);
              padding: .7rem 0;
          }

          .footer .box-container .box p {
              font-size: 1.5rem;
              color: #666;
              padding: .7rem 0;
          }

          .footer .box-container .box a {
              display: block;
              font-size: 1.5rem;
              color: #666;
              padding: .7rem 0;
          }

          .footer .box-container .box a:hover {
              color: var(--dark-yellow);
          }

          .footer .box-container .box p i {
              padding-right: .5rem;
              color: var(--dark-yellow);
          }

          .footer .credit {
              font-size: 2rem;
              margin-top: 1rem;
              padding: 1rem;
              padding-top: 2rem;
              text-align: center;
              border-top: .1rem solid rgba(0, 0, 0, .1);
              color: #666;
          }

          .footer .credit span {
              color: var(--dark-yellow);
          }



          /* media queries  */

          @media (max-width:991px) {

              html {
                  font-size: 55%;
              }

              body {
                  padding: 1.5rem;
              }

              header {
                  padding: 2rem;
              }

              section {
                  padding: 2rem;
              }

          }

          @media (max-width:768px) {

              #menu {
                  display: initial;
              }

              header .navbar {
                  position: absolute;
                  top: 100%;
                  left: 0;
                  right: 0;
                  background: #fff;
                  border-top: .1rem solid rgba(0, 0, 0, .2);
                  border-bottom: .1rem solid rgba(0, 0, 0, .2);
                  clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
              }

              header .navbar.active {
                  clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
              }

              header .navbar a {
                  font-size: 2.5rem;
                  display: block;
                  margin: 2rem 0;
                  text-align: center;
              }

              .contact form .inputBox input {
                  width: 100%;
              }

          }

          .dropdown {
              position: relative;
              display: inline-block;
          }

          .dropdown-content {
              display: none;
              position: absolute;
              background-color: #f9f9f9;
              max-width: 200px;
              overflow-y: auto;
              max-height: 150px;
              box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
              z-index: 1;
          }

          .dropdown-content a {

              font-size: 15px;
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
          }

          .dropdown-content a:hover {
              background-color: #f1f1f1;
          }

          .dropdown:hover .dropdown-content {
              display: block;
          }

          .dropdown:hover .dropbtn {
              background-color: #3e8e41;
          }



          @media (max-width:400px) {

              html {
                  font-size: 50%;
              }

          }
      </style>
  </body>


  </html>