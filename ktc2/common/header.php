<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CCH | <?php echo $pageTitle; ?>  </title>

    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

  </head>

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="brand" href="index.php">KTC Lookup</a>
          <div class="nav-collapse collapse">
            <!-- If the user is logged in Show some menu options -->
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="#">Admin</a></li>
            </ul>
            <!-- End the user Logged in Menu -->
            <form class="navbar-form pull-right">
              <input class="input-small" type="text" placeholder="email" />
              <input class="input-small" type="password" placeholder="password" />
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div>
        </div>
      </div>
    </div>