<?php
  include_once('import_init_sql.php'); 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brew for you</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    
  <main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="index.php" style="float:left" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="images/coffee-beans.png" style="width: 40px; margin-right: 10px">
        <span class="fs-4">Everything I brew, I brew for you...</span>
      </a>
      <div id="logged-out">
        <button type="button" class="btn btn-outline-dark" style="float:right" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button type="button" class="btn btn-outline-dark" style="float:right;margin-right:10px" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
      </div>
      <div id="logged-in" style="display: none">
        <button type="button" class="btn btn-outline-dark" style="float:right" id="logout">Logout</button>
      </div>
      <div style="clear:both"></div>
    </header>

    <div class="p-5 mb-4 bg-dark text-light rounded-3">
      <div class="container-fluid py-5">
        <img src="images/beans.png" style="width: 150px; margin-right: 50px; float: left">
        <h1 class="display-5 fw-bold">Welcome to brew for you!</h1>
        <p class="col-md-8 fs-4">We are on a mission to find your favourite coffee.</p>
        <a class="btn btn-light" href="catalogue.php" role="button">View our current stock</a>
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Order the best coffee</h2>
          <p>To order coffee, simply fill in the form, and we will handle the rest! We do our best to process orders within 24hours. All orders are shipped withing 5 working days.</p>
          <p>If you are a regular and never deviate from your coffee <del>addiction</del> habits, then a subscription is for you. Never again look down at an empty jar in terror.</p>
            <!-- start modal -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#orderModal" id="order-button">
            Order coffee
            </button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Track your order</h2>
          
          <p>We have a dedicated team, fueled by coffee and passion, working around the clock to get you what you need!</p>
          <p>Simply enter your order ID to view the current status update of your coffee.</p>

          <!-- start modal -->
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#subscribeModal">
            Track your order
          </button>
        </div>
      </div>
    </div>

    <!-- Track order modal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeCoffeeLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="subscribeCoffeeLabel">Track your order</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="tracking-modal">
              <div class="form-group">
                  <label for="inputTrack">Order ID</label>
                  <input type="text" class="form-control" id="inputTrack" placeholder="Enter order ID">
              </div>
              <div class="clear: both"></div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary" onclick="checkOrder()">Track order</button>
              <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Close</button>
          </div>
          </div>
      </div>
      </div>
      <!-- end modal -->

    <!-- Login modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="loginLabel">Login</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="login-modal">
              <div class="form-group">
                  <label for="inputLoginUsername">Username</label>
                  <input type="text" class="form-control" id="inputLoginUsername" placeholder="Enter your username">
              </div>
              <div class="form-group">
                  <label for="inputLoginPassword">Password</label>
                  <input type="password" class="form-control" id="inputLoginPassword" placeholder="Enter your password">
              </div>
              <div class="clear: both"></div>
          </div>
          <div class="modal-footer">
              <button type="submit" id="login-btn" class="btn btn-primary" onclick="login()">Login</button>
              <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Close</button>
          </div>
          </div>
      </div>
      </div>
      <!-- end modal -->

      <!-- Register modal -->
      <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="registerLabel">Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="register-modal">
                <div class="form-group">
                    <label for="inputTrack">Username</label>
                    <input type="text" class="form-control" id="inputRegisterUsername" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="inputTrack">Password</label>
                    <input type="password" class="form-control" id="inputRegisterPassword" placeholder="Enter password">
                </div>
                <div class="clear: both"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="register-btn" class="btn btn-primary" onclick="registerAccount()">Register</button>
                <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        <!-- end modal -->

      <!-- Place order modal -->
      <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderCoffeeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="orderCoffeeLabel">Place your order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-order">
                <!-- form -->
                <div class="form-group">
                    <label for="inputEmail1" hidden>Username</label>
                    <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Username" disabled hidden>
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="coffeeList1">Coffee</label>
                    <select class="form-control" id="coffeeList1">
                    </select>
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <p><label>Quantity (kg)</label></p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="3">
                        <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                </div>
                <div style="clear: both"></div>
                <!-- end form -->
            </div>
            <div class="modal-footer">
                <button type="submit" id="place-order-btn" class="btn btn-primary" onclick="orderCoffee()">Place order</button>
                <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        <!-- end modal -->

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022
    </footer>
  </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/functions.js"></script>
  </body>
</html>
