<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

  <style>
    #pieChart{
      width: 60vw;
      height: 10vh;
    }
  </style>

<?php

	$currentUser = $this->session->userdata('username');
	 //echos out a welcome message on load.
   foreach($firstLastName as $rows)
   {
     echo "<h3 id='message'> Hey there, ".$rows['firstname']." ".$rows['surname']."</h3>";
   }

?>

<br>

<h4 id = "message"> Let's see what's been happening recently </h4>
<br>
<div id="carouselHome" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <h6 id = "message"> This is what you've been spending recently </h6>

<br>

<table id = "genTable" style="width: 25%">
	<tr>
		<th>Amount</th>
		<th>Description</th>
	</tr>
<?php  foreach($exp as $rows){ ?>
		<tr>
			<td> <?php echo $rows['amount']?> </td>
			<td> <?php echo $rows['description']?> </td>
		</tr>
	<?php } ?>

</table>
<p> Need to make an update? Click <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/outgoings"> here </a> to do that! </p>


<br>
<br>


	<h6 id = "message"> This is what your income has been recently </h6>
<br>
	<table id = "genTable" style="width: 25%">
		<tr>
			<th>Amount</th>
			<th>Description</th>
		</tr>
	<?php  foreach($inc as $rows){ ?>
			<tr>
				<td> <?php echo $rows['amount']?> </td>
				<td> <?php echo $rows['description']?> </td>
			</tr>
		<?php } ?>

	</table>
	<p> Need to make an update? Click <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/income"> here </a> to do that! </p>
    </div>
    <div class="carousel-item">

	<?php
	if($notSet === false)
	{
	foreach ($recentprogress as $row) { $recentAmount = $row['input_amount']; }


	echo "<p> You have most recently saved £".$recentAmount." on:";   foreach ($targetSaving as $row) {echo ' '.$row['description']."<p>" ;};
	 foreach ($totalProgress as $row) { $total = (float)$row['amount'];  }
    foreach ($targetSaving as $row) { $target = (float)$row['amount'];  }
	  $percentage = ($total/$target)*100;

	   echo "<div class='progress' style='height: 20px; width: 700px;'>
        <div class='progress-bar' role='progressbar' style='width:".round($percentage)."%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".round($percentage)."% </div> </div><br>";
       echo "<p> Need to make an update? Click <a href='http://raptor.kent.ac.uk/~lc559/ci/index.php/Saving/loadSavingGoal'> here </a> to do that! </p>";
	}
	else{

		echo "<p>You have not made any savings!<p>";
		echo "<p> New to Shillings and Billings? Click <a href='http://raptor.kent.ac.uk/~lc559/ci/index.php/Saving/loadSavingGoal'> here </a> to add your first saving! </p>";
	}
	?>
    </div>
	<div class="carousel-item">
	<p>last weeks spendings by category<p>
    <!--  <div id = "pieChart"> -->
    <canvas id="categorisedSpending">
    </canvas>
      <script type="text/javascript">

      var ctx = document.getElementById("categorisedSpending");


      var categorisedSpending = new Chart(ctx, {
      	type: 'pie',

      	data: {
      	labels: [<?php foreach ($recentCat as $row) { echo "'".$row['category']."'," ; } ?> ],

      	datasets: [{
      			data: [<?php foreach ($recentCat as $row) { echo $row['total'].', '; } ?>],


      			backgroundColor: [ "rgba(255, 146, 137, 1)", "rgba(229, 185, 155, 1)", "rgba(235, 209, 171, 1)", "rgba(156, 175, 182, 1)", "purple", "pink" ],


      	}],

         }
         });


      </script>


  <!-- </div> -->
  <br>
  <p> Want to take a closer look? Click <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewCatagories"> here </a> to do that! </p>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
