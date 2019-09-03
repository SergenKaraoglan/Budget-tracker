  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <style>
    input{
        border: 3px solid #E84A5F;
        border-radius: 5px;
        padding: 10px;
   }
  </style>

  <h3 id = "message"> Spent anything today? </h3>
  <h4 id = "message"> Use the form below to add it! </h4>

  <br>
  <br>

  <div id="input">
    <form action="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/addOutgoing" method="post">
      Details:
      <input type="text" name="details" pattern=".{1,}" placeholder="Train Ticket" required> <!-- cite https://www.w3.org/TR/2009/WD-html5-20090825/forms.html#attr-input-pattern -->
      Amount:
      <input type="number" min="0.01" step="0.01" name="amount" placeholder="5.00" requried placeholder="5.99">
      Date:
      <input type="date" name="day" id="day" value="2019-01-01" required>
      Category:
      <select name="category">
        <option value="General"> General </option>
        <option value="Utilities"> Utilities </option>
        <option value="Groceries"> Groceries </option>
        <option value="Lifestyle"> Lifestyle </option>

      </select>
      <input type="submit" class="btn btn-danger">
    </form>
  </div>
<br>
<br>
  <div id="view"> <p>Want a more detailed look at what you've been spending? Click <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/viewMoreOutgoing">here</a> to see more!</p>
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
</form></tr>"; ?>
        </tr>
      <?php } ?>
                                                                        
	</table>
  </div>

  <script>

    document.getElementById('day').valueAsDate = new Date(); //cite valueAsDate

  </script>
