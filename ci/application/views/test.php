<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <style>

    body {
      background-color: #E7E6E6;
      margin: 0;
    }

    .jumbotron {
      height: 15vh;
      background-color: #E84A5F;
      margin: 0;
      color: white;
    }

    .centerme  {
      position: relative;
      top: 50%;
      transform: translateY(-75%);
    }

    .nav li {
      display: inline-block;
    }

    .navbar .navbar-center {
      position: absolute;
      left: 40%;
      transform: translate(-40%);
      white-space: nowrap;
    }

    .navbar .navbar-collapse {
      text-align: center;
    }

    .text{
      color: white;
    }

    #input {
      text-align: center;
      margin: 0 auto;
    }

    table {
      border-collapse: collapse;
      width: 60%;
      margin-left: auto;
      margin-right: auto;
    }

    th {
      padding: 3px;
      background-color: #bcbaba;
      color: white;
    }

    tr:nth-child(odd) {
      border-bottom: 1px solid black;
      background-color: #f2f2f2;
    }

    th, td{
      border-bottom: 1px solid black;
    }

    tr:hover{
      background-color: #e0e0e0;
    }


  </style>

</head>

<body>

  <div class = "jumbotron">
    <div class = "centerme">
      <h1 class="text-center text">Shillings and Billings</h1>
    </div>
  </div>

  <div class = "navbar navbar-default">
    <div class = "container-fluid text-center">
      <ul class = "nav navbar-nav navbar-center">

      <li><a href = "http://raptor.kent.ac.uk/~lc559/ci/index.php/user/homepage">Home</a></li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> Outgoings </a>
        <ul class="dropdown-menu">
          <li><a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/outgoings">General Outgoings</a></li>
          <li><a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewMoreOutgoing">Organised Outgoings</a></li>
        </ul>
      </li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> Income </span></a>
        <ul class="dropdown-menu">
          <li><a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/income">General Income</a></li>
          <li><a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/viewMoreIncome">Organised Income</a></li>
        </ul>
      </li>

      <li><a href = "http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewCatagories">Categories</a></li>

      <li><a href = "http://raptor.kent.ac.uk/~lc559/ci/index.php/user/viewGraph">Graph</a></li>

      <li><a href = "http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewCalendarPage">Calendar</a></li>

      <li><a href = "http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/loadSavingGoal">Saving Target</a></li>

      <li><a href = "http://http://raptor.kent.ac.uk/~lc559/ci/index.php/user/userSettings">Settings</a></li>

      <li><a href = "http://raptor.kent.ac.uk/~lc559/ci/index.php/user/logout">Logout</a></li>


    </div>
  </div>

<br>

</body>

</html>
