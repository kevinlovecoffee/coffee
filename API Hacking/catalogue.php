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
      <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="images/coffee-beans.png" style="width: 40px; margin-right: 10px">
        <span class="fs-4">Everything I brew, I brew for you...</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-dark text-light rounded-3">
      <div class="container-fluid py-5">
        <img src="images/beans.png" style="width: 150px; margin-right: 50px; float: left">
        <h1 class="display-5 fw-bold">Welcome to brew for you!</h1>
        <p class="col-md-8 fs-4">We are on a mission to find your favourite coffee.</p>
        <a class="btn btn-light" href="index.php" role="button">Place an order from the homepage</a>
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-12">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Currently available coffee</h2>
          <div id="myData"></div>
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022
    </footer>
  </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        const getCoffee = async () => {
        const response = await fetch('v1/coffee.php');
        const myJson = await response.json();
            // alert(myJson);
            // update page
            var mainContainer = document.getElementById("myData");
            for (var i = 0; i < myJson.length; i++) {
                var div = document.createElement("div");
                div.className = "h-100 p-5 bg-secondary text-light border rounded-3"
                div.innerHTML = '<img src="images/coffee-beans.png" style="width: 150px; margin-right: 20px; float: left">'
                 + '<h2>Coffee: ' + myJson[i].name + '</h2>'
                 + '<p>Region: ' + myJson[i].origin + '</p>'
                 + '<p>Roast level: ' + myJson[i].roast_level + '</p>'
                 + '</div>';
                mainContainer.appendChild(div);
            }
        }
        window.onload=getCoffee();
    </script>

  </body>
</html>
