<style>
input{
    border: 3px solid #E84A5F;
    border-radius: 5px;
    padding: 10px;
}
</style>

<form id = "input" action="http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/addIncome"     method="post">

  <h3 id = "message"> Had any income come in today? </h3>
  <h4 id = "message"> Use the form below to add it! </h4>

  <br>
  <br>

Details: <input type="text" name="description" placeholder="Present" required>
Amount: <input type="number" name="income" step="0.01" min="0.01" placeholder="25.00" required>
Date: <input type="date" id = "date"name="date" required>
Category:
      <select name="category">
        <option value="Full-time Job"> Full-time Job </option>
        <option value="Present"> Present </option>
        <option value="Other"> Other </option>
      </select>
	  <input type= "submit" value="Submit" class="btn btn-danger">
</form>

<br>
<br>

<p>Want a more detailed look at your income? Click <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/viewMoreIncome">here</a> to see more!</p>

<br>

<?php

if($table == true)
{
 echo "<table>
		<tr>
			<th>Amount</th>
			<th>Description</th>
			<th>Date</th>
			<th>Category</th>
			<th>Delete income</th>
		</tr>";

 foreach ($incomeData as $row){
    echo "<tr><td>".$row['amount']."</td><td>".$row['description']."</td><td>".$row['incdate']."</td><td>".$row['category']."<td><form action = 'http://raptor.kent.ac.uk/~lc559/ci/index.php/Income_controller/deleteIncomeRow' method='post'><input type = 'hidden' name = 'iD' value = ".$row['incID']." /><input type= 'submit' value='Delete' class='btn btn-danger'> 
</form></tr>";
 }
  echo "</table>";
}


else{

echo "<p> no income data found </p>";
}
?>

<br>
<br>

</body>

<script>

  document.getElementById('date').valueAsDate = new Date(); //cite valueAsDate

</script>
