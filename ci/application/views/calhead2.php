<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
-->
  <style>

  #graphDisplay1, #graphDisplay2, #graphDisplay{
      width: 55vw;
      height: 10vw;


      margin-left: auto;
      margin-right: auto;
	 margin-bottom:50px;
      top: 30%;
	  left: 50%;

    }
	#graphDisplay1{
		display: none;
	}

    #container {
      width: 50vw;
    }

    body {
      background-color: #E7E6E6;
      margin: 0;
    }

    .jumbotron {
      height: 15vh;
      background-color: #E84A5F;
      margin: 0;
      color: white;
      font: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .centerme  {
      position: relative;
      top: 45%;
      transform: translateY(-50%);
    }


    .navbar .navbar-center {
      position: fixed;
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

    #text {
      width: 40%;
      padding: 0.5em, 0.25em;
    }

    #loginInformation{
      border-radius: 5;
    }

    #message, #selecter, #pieChart {
      text-align: center;
      margin: 0 auto;
    }

    .center {
      text-align: center;
      margin: 0 auto;
    }

    p {
      text-align: center;
      margin: 0 auto;

    }

    #calendar {
      height: 60vh;
      width: 65vw;
    }

    .text-center {



    }

    .progress {
      text-align: center;
      margin: 0 auto;

    }
     #bottom{
		  position: relative;
		 bottom: 0;
	 }

	 .navbar .navbar-expand-sm .bg-light .navbar-light{

		 position: fixed;
	 }

  </style>

</head>

<body>

  <div class = "jumbotron">
    <div class = "centerme">
      <h1 class="text-center text display-1">Shillings and Billings</h1>
    </div>
  </div>

<nav class="navbar navbar-expand-sm bg-light navbar-light">

  <ul class="navbar-nav">
    <li class="nav-link"> <a class="nav-link" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/homepage">Home</a> </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" a href="#"> Outgoings </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/outgoings"> General Outgoings </a>
        <a class="dropdown-item" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewMoreOutgoing"> Organised Outgoings </a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" a href="#"> Income </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/income"> General Income </a>
        <a class="dropdown-item" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/viewMoreIncome"> Organised Income </a>
      </div>
    </li>

    <li class="nav-link"> <a class="nav-link" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewCatagories">Categories</a> </li>

    <li class="nav-link"> <a class="nav-link" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/viewGraph">Graph</a> </li>

    <li class="nav-link"> <a class="nav-link" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewCalendarPage">Calendar</a> </li>

    <li class="nav-link"> <a class="nav-link" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Saving/loadSavingGoal">Saving Target</a> </li>

    <li class="nav-link"> <a class="nav-link" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/userSettings"> Settings</a>

    <li class="nav-link"> <a class="nav-link" href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/logout"> Logout</a>

  </ul>
</nav>



<br>
