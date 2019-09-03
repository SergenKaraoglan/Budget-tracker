<title> Graphs </title>


<div id = 'graphDisplay' >
<div id = 'graphDisplay1'>
    <h3 id="message">Here's a look at your comparitive spending</h3>
<canvas id="averageSpending">


 <script type="text/javascript">
var ctx = document.getElementById("averageSpending"); //says where the graph will be drawn stored in this var.

var averageSpending = new Chart(ctx, { //create a new instance of chart
	type: 'line', //declares what type of graph this could be, e.g. pie, line, doughnut, etc...
	data: { //the data that will populate the graph.
	labels: [ <?php foreach ($avgSpending as $row) { echo "new Date((".strtotime($row['expdate'])*1000.05 .")).toLocaleDateString() , "  ; } ?> ], //essentailly parses what's here into a timestamp, toLocaleDateString making it into the DD/MM/YYYY format.
	datasets: [{ 
		    label: 'My Expenditure', //creates a label that you'd normally see on a graph.
			data: [ <?php foreach ($avgSpending as $row) { echo $row['total'].' ,'; } ?> ], //collects the informaton passed from the controller, which is from the db.

		backgroundColor: ['rgba(68,137,235, 0.2)',
                'rgba(252, 173, 69, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'],

		borderColor: ['rgba(68,137,235,1)',
                'rgba(252, 173, 69, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'],

				borderWidth: 1

	},
	{
	   label: 'Average Expenditure by Other Users',
	   data: [<?php foreach ($avgSpending as $row) { echo $row['average'].' ,'; } ?>],
	   backgroundColor: '',
	   borderColor: 'red',
	   borderWidth: 1

	}]
	},

   });


</script>
</canvas>
</div>

<div id = 'graphDisplay2'>
<h3 id="message">Here's a look at your spending and average user spending</h3>
<br>

       <canvas id="incomeVsExpenditure">


 <script type="text/javascript">
var ctx = document.getElementById("incomeVsExpenditure");

var incomeVsExpenditure = new Chart(ctx, {
	type: 'line',
	data: {
	labels: [ <?php foreach ($incomeVsExpenditure as $row) { echo "new Date((".strtotime($row['incdate'])*1000.05 .")).toLocaleDateString() , "  ; } ?> ],
	datasets: [{
		    label: 'Expenditure',
			data: [ <?php foreach ($incomeVsExpenditure as $row) {if(empty($row['totalExpenditure']) == true) {echo '0 ,';} else{ echo $row['totalExpenditure'].' ,';} } ?> ],

		backgroundColor: ['rgba(68,137,235, 0.2)',
                'rgba(252, 173, 69, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'],

		borderColor: ['rgba(68,137,235, 1)',
                'rgba(252, 173, 69, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'],

				borderWidth: 1

	},
	{
	   label: 'Income',
	   data: [<?php foreach ($incomeVsExpenditure as $row) { if(empty($row['totalIncome']) == true) {echo '0 ,';} else {echo $row['totalIncome'].' ,'; } } ?>],
	   backgroundColor: '',
	   borderColor: 'red',
	   borderWidth: 1

	}]
	},

   });


</script>
</canvas>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
	$('#averageSpent').click( function() {
		$('#graphDisplay2').hide();
		$('#graphDisplay1').show();
	}
	)

	$('#expenditureVsIncome').click( function() {
		$('#graphDisplay1').hide();
		$('#graphDisplay2').show();
	}
	)

});
</script>

<form action="" id='bottom'>
  <input type='radio' name="graph" id = 'expenditureVsIncome' checked> Personal  Graph <br>
  <input type='radio' name="graph" id ='averageSpent'> Compare Spendig <br>
</form>






<style>

  #footer{

 position: absolute;
    bottom: 0;
	left: 0;
    background-color: #76797a;
    width: 100vw;
    height: 10vh;
	 margin-top:10000px;

  }

  #needsFloat{
    text-align: center;
    vertical-align: middle;
    color: #D1D2D4;

    transform-x
  }

  #bybLogo {

    height: 10vh;
    width: 10vw;
    float: left;
    bottom: auto;

    position: relative;
    margin-right: -100px;
    margin-top: -65px;

  }

</style>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
