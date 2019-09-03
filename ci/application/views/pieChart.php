<title> Graphs </title>


<canvas id="categorisedSpending">

<script type="text/javascript">

var ctx = document.getElementById("categorisedSpending");


var categorisedSpending = new Chart(ctx, {
	type: 'pie',

	data: {
	labels: [<?php foreach ($graph as $row) { echo "'".$row['category']."'," ; } ?> ],

	datasets: [{
			data: [<?php foreach ($graph as $row) { echo $row['total'].', '; } ?>],


			backgroundColor: [ "red", "blue", "green", "yellow", "purple", "pink" ],
	}],

   }
   });


</script>

</canvas>

<br>
<br>
