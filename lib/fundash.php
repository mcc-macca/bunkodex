<?php

/**
 * SECTION FOR HTML
 */
/**
 * HEAD PRINT
 */
function print_head($title)
{
    echo "<!DOCTYPE html>
    <html lang='en'>
    
    <head>
      <meta charset='UTF-8' />
      <title>$title - BunkoDEX</title>
      <link rel='stylesheet' href='style.css' />
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' />
    </head>";
}

/**
 * SIDEBAR PRINT + TOP H1 TITLE
 */
function print_sidebar()
{
    echo "<body>
    <div class='container'>
      <nav>
        <ul>
          <li><a href='#' class='logo'>
              <img src='../img/bd_norm.svg' height='100px'>
              <span class='nav-item'>Welcome<br>back!</span>
            </a></li>
          <li><a href='index.php'>
              <i class='fas fa-sharp fa-solid fa-chart-line'></i>
              <span class='nav-item'>Dashboard</span>
            </a></li>
          <li><a href='cat.php'>
              <i class=' fas fa-sharp fa-solid fa-server'></i>
              <span class='nav-item'>Category</span>
            </a></li>
          <li><a href='scat.php'>
              <i class='fas fa-database'></i>
              <span class='nav-item'>Sub-category</span>
            </a></li>
          <li><a href='product.php'>
              <i class='fas fa-chart-bar'></i>
              <span class='nav-item'>Product</span>
            </a></li>
          <li><a href='admin.php'>
              <i class='fas fa-solid fa-users'></i>
              <span class='nav-item'>Admin</span>
            </a></li>
          <li><a href='settings.php'>
              <i class='fas fa-cog'></i>
              <span class='nav-item'>Settings</span>
            </a></li>
  
          <li><a href='../login/logout.php' class='logout'>
              <i class='fas fa-sign-out-alt'></i>
              <span class='nav-item'>Log out</span>
            </a></li>
        </ul>
      </nav>
  
  
      <section class='main'>
        <div class='main-top'>
          <h1>BunkoDEX Dashboard - " . NAME_DEX . "</h1>
          <h2 id='fullclock'></h2>
        </div>
        <div class='info'>";
}

/************************************************************************************************************************************
 * DIVISORIA ---------------------------------------------------------------------------------------------------------------------- *
 * **********************************************************************************************************************************
 */

/**
 * PRINT FOOT + CURRENT VERSION
 */
function print_foot()
{
    echo "<div class='footer'>
    <hr>
    <p>BunkoDEX Catalog System  &copy; Macca Computer 2018 - 2023</p>
  </div>
</section>
</div>
<script src='../lib/js/function.js'></script>
</body>

</html>";
}

function session_expired(){
  echo "<!DOCTYPE html>
  <html lang='en'>

  <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Session Expired!</title>
  </head>

  <body>
    <center>
      <br><br><br>
      <h1>BunkoDEX</h1>
      <h1>Session expired!</h1>
      <br>
      <h2>Re-<a href='../index.php'>login</a></h2>
    </center>
  </body>

  </html>";
}