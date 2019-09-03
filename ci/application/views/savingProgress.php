<style>
  input{
      border: 3px solid #E84A5F;
      border-radius: 5px;
      padding: 10px;
 }
 </style>

<?php
foreach ($total as $row) { $total = (float)$row['amount'];  }
foreach ($target as $row) { $target = (float)$row['amount'];  }
foreach ($des as $row) { $name = $row['description'];  }

if(is_array($total) === true)
{
  $total2 = (float)0.00;
  $sum = $target - $total2;
  $percentage = ($total2/$target)*100;

}
else
{
  $sum = $target - $total;
  $percentage = ($total/$target)*100;
}
?>


  <br>
  <p id = 'message'><?php echo "".$name.": "."£".$target.""; ?></p>
  <br>
  <div class="progress" style="height: 20px; width: 700px;">
  <div class="progress-bar" role="progressbar" style='width:<?php echo "".round($percentage)."%;'"; ?> aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo "".round($percentage)."%"; ?></div> </div>

  <br>

  <div id = "addToGoal">
    <form id = 'input' action = "http://raptor.kent.ac.uk/~lc559/ci/index.php/Saving/addSavingProgress" method = "post"> <!--  "http://localhost/ci/index.php/Income_controller/addSavingProgress" -->
      Saved Amount: <input type = "number" name = "sAmount" min = "0.01" max = <?php echo "'".$sum."'" ?> ; step = "0.01" required>
	                <input type = "hidden" name = "iD" value = <?php echo "'".$iD."'" ?> />
      <input type = "submit" class="btn btn-danger">
    </form>
  </div>



<!--       Target: <select name = "addToThisGoal">
        <
          foreach($results as $row) {
            echo "<option id = 'message' value = ";
            echo $row['savingID'],">";
            echo $row['description'];
            echo "</option>";
          }
        ?>
      </select>
	  -->
