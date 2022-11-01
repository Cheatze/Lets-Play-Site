<nav id="mainNavbar" class="navbar navbar-dark bg-danger navbar-expand-md">
      <a href="#" class="navbar-brand"><i class="fas fa-users pr-2"></i>Lets Play</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navLinks" class="collapse navbar-collapse">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a href="index.php" class="nav-link active">HOME</a>
              </li>
              <?php
              if(isset($_SESSION['username'])){
                echo '
                <li class="nav-item">
                <a href="search.php" class="nav-link">Search</a>
                </li>
                <li class="nav-item">
                <a href="browse.php" class="nav-link">Browse Yours</a>
                </li>
                <li class="nav-item">
                <a href="insertGame.php" class="nav-link">Insert</a>
                </li>
                ';
            }
              ?>
<!--               <li class="nav-item">
                  <a href="Reset.php" class="nav-link">Reset</a>
              </li> -->
              <li class="nav-item">
                  <a href="info.php" class="nav-link">Info</a>
              </li>
              <li class="nav-item">
                 <a href="LPbrowse.php" class="nav-link">Club Games</a>
              </li>
               <li class="nav-item">
                  <a href="LetsPlayLogin.php" class="nav-link">Login</a>
              </li>
              <li class="nav-item">
                  <a href="SignUp.php" class="nav-link">Sign Up</a>
              </li>
              <?php 
                if(isset($_SESSION['username'])){
                    echo '
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">Logout</a>
                        </li>
                    ';
                }
              ?>
          </ul>
      </div>
  </nav>