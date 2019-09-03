  <h3 id="message"> Here's a more detailed look at your outgoings </h3>
  <h4 id="message"> Use the drop down to select a period of time to look at, then hit submit! </h4>

  <br>

  <form id = "selecter" action="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewOutgoingTime" method="post">
    <select name='category'>
      <option value="lastWeek"> Last Week </option>
      <option value="lastMonth"> Last Month </option>
      <option value="lastYear"> Last Year </option>
      <option value="allTime"> All Time </option>
    </select>

    <input class="btn btn-danger" type='submit'>

  </form>

  <br>

  <table>
  <tr>
    <th>Amount</th>
    <th>Description</th>
    <th>Date</th>
    <th>Category</th>
	<th>Delete Outgoing</th>
  </tr>

  <?php  foreach($results as $rows){ ?>
      <tr>
        <td> <?php echo $rows['amount']?> </td>
        <td> <?php echo $rows['description']?> </td>
        <td> <?php echo $rows['expdate']?> </td>
        <td> <?php echo $rows['category']?> </td>
		 <?php	echo "<td><form action = 'http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/deleteOutgoingRow' method='post'><input type = 'hidden' name = 'iD' value = ".$rows['expID']." /><input type= 'submit' value='Delete' class='btn btn-danger'>
</form></tr>";?>
      </tr>
    <?php } ?>

</table>
