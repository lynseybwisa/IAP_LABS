<?php
    
    session_start();
    if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
        header('location:login.php');
        // exit();
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Orders</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="placeorder.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../Labs/css/orders.css" rel="stylesheet">
  </head>
  <body>
    <header>
  
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Orders</strong>
      </a>
      </button>
    </div>
  </div>
</header>

<main role="main">
<!-- 
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Album example</h1>
    </div>
  </section> -->

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
            <div class="card-body">
              <!-- <p class="card-text">Feature 1: Placing The Order</p> -->
              <h3 class="card-text">Feature One <br>Place The Order</h3>
              <div class="d-flex justify-content-between align-items-center">
                <form name="order_form" id="order_form" class="form-signin">
                    <input type="text" name="name_of_food" id="name_of_food" class="form-control" placeholder="Name of food" required autofocus>
                    <input type="number" name="number_of_units" id="number_of_units" class="form-control" placeholder="Number of units" required>
                    <input type="number" name="unit_price" id="unit_price" class="form-control" placeholder="Unit Price" required>
                    <input type="hidden" name="status" id="status" class="form-control" placeholder="Unit Price" required value="Order Placed">
                    <button id="btn-place-order" class="btn btn-lg btn-primary" style="margin: 20px;" type="submit">Place Order</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
            <div class="card-body">
              <!-- <p class="card-text">Feature 1: Placing The Order</p> -->
              <h3 class="card-text">Feature Two <br>Check Order Status</h3>
              <div class="d-flex justify-content-between align-items-center">
              <form name="order_status_form" id="order_status_form" class="form-signin">
                    <input id="order_id" name="order_id" type="number" class="form-control" placeholder="Order ID" required autofocus>
                    <button id="btn-check-order" class="btn btn-lg btn-warning" style="margin: 20px;" type="submit">Check Order Status</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>



</div>


</body>
   
</html>