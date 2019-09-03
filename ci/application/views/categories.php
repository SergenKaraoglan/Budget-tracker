  <title> Categories </title>
  <style>
    #pieChart{
      width: 60vw;
      height: 10vh;
    }
  </style>

  <h3 id = "message"> Categories </h3>

  <br>

  <div id = "General">
    <h4 id = "message"> General Outgoings </h4>
    <br>
      <table id = "genTable">
        <tr>
          <th>Amount</th>
          <th>Description</th>
          <th>Date</th>
        </tr>
        <?php  foreach($general as $rows){ ?>
            <tr>
              <td> <?php echo $rows['amount']?> </td>
              <td> <?php echo $rows['description']?> </td>
              <td> <?php echo $rows['expdate']?> </td>
            </tr>
          <?php } ?>
      </table>

	  <p>Take a look at your general spending habits <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/viewMoreGeneral">here</a>!</p>
  </div>

  <br>
  <br>

  <div id = "Groceries">
    <h4 id = "message"> Groceries </h4>
    <br>
      <table id = "groTable">
        <tr>
          <th>Amount</th>
          <th>Description</th>
          <th>Date</th>
        </tr>
        <?php  foreach($grocieries as $rows){ ?>
            <tr>
              <td> <?php echo $rows['amount']?> </td>
              <td> <?php echo $rows['description']?> </td>
              <td> <?php echo $rows['expdate']?> </td>
            </tr>
          <?php } ?>
      </table>

	  <p>Take a look at how much you've been spending on groceries <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/viewMoreGroceries"> here</a>!</p>
  </div>

  <br>
  <br>

  <div id = "Utilities">
    <h4 id = "message"> Utilities </h4>
    <br>
      <table id = "billTable">
        <tr>
          <th>Amount</th>
          <th>Description</th>
          <th>Date</th>
        </tr>
        <?php  foreach($bills as $rows){ ?>
            <tr>
              <td> <?php echo $rows['amount']?> </td>
              <td> <?php echo $rows['description']?> </td>
              <td> <?php echo $rows['expdate']?> </td>
            </tr>
          <?php } ?>
    </table>

	<p>Have a look at how much your utilities have been costing you <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/viewMoreUtilities">here</a>!</p>
  </div>

  <br>
  <br>

  <div id = "Lifestyle">
  <h4 id = "message"> Lifestyle </h4>
    <br>
    <table id = "lifeTable">
      <tr>
        <th>Amount</th>
        <th>Description</th>
        <th>Date</th>
      </tr>
      <?php  foreach($lifestyle as $rows){ ?>
          <tr>
            <td> <?php echo $rows['amount']?> </td>
            <td> <?php echo $rows['description']?> </td>
            <td> <?php echo $rows['expdate']?> </td>
          </tr>
        <?php } ?>
  </table>

  <p>Have a look at how much you've spent on your lifestyle <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/viewMoreLifestyle">here</a>!</p>
  </div>

  <br>
  <br>
  <br>

  <h4 id = "message"> Here's a breakdown of your spending </h4>
  <div id = "pieChart">
    <canvas id="categorisedSpending">

      <script type="text/javascript">

      var ctx = document.getElementById("categorisedSpending");


      var categorisedSpending = new Chart(ctx, {
      	type: 'pie',

      	data: {
      	labels: [<?php foreach ($graph as $row) { echo "'".$row['category']."'," ; } ?> ],

      	datasets: [{
      			data: [<?php foreach ($graph as $row) { echo $row['total'].', '; } ?>],


      			backgroundColor: [ "rgba(255, 146, 137, 1)", "rgba(229, 185, 155, 1)", "rgba(235, 209, 171, 1)", "rgba(156, 175, 182, 1)", "purple", "pink" ],


      	}],

         }
         });


      </script>
    </canvas>
