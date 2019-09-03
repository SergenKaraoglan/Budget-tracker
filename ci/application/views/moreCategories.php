  <form action= "http://raptor.kent.ac.uk/~lc559/ci/index.php/user/categoryByTime" id="message" method="post">
    <select name='time'>
      <option value="7"> Last Week </option>
      <option value="31"> Last Month </option>
      <option value="365"> Last Year </option>
      <option value="99999"> All Time </option>
    </select>

	<select name='category'>
      <option value="General"> General </option>
      <option value="Groceries"> Groceries </option>
      <option value="Utilities"> Utilities </option>
      <option value="Lifestyle"> Lifestyle </option>
    </select>

    <input type='submit' class="btn btn-danger">

  </form>

  <br>

  <table>
  <tr>
    <th>Amount</th>
    <th>Description</th>
    <th>Date</th>
  </tr>

  <?php  foreach($categoryTime as $rows){ ?>
      <tr>
        <td> <?php echo $rows['amount']?> </td>
        <td> <?php echo $rows['description']?> </td>
        <td> <?php echo $rows['expdate']?> </td>
      </tr>
    <?php } ?>

</table>

<br>
