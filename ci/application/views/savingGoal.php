  <title> Financial Goals </title>



<style>
  input{
      border: 3px solid #E84A5F;
      border-radius: 5px;
      padding: 10px;
   }
 </style>

<body>
  <div id = "message">
    <h3> Got something you want to save for? Add it to your goals here! </h3>
    <br>
    <form action = "http://raptor.kent.ac.uk/~lc559/ci/index.php/Saving/addSavingTarget"  method = "post"> <!-- "http://localhost/ci/index.php/Income_controller/addSavingTarget"   -->
      Target Details: <input type = "text" name = "details" required>
      Target Amount: <input type = "number" name = "amount"  min = "0.01" step = "0.01" required>
      <input type = "submit" class="btn btn-danger">
    </form>
  </div>

  <br>

  <div id = "message">
    <h3> Made any progress towards your targets? Register them here! </h3>
    <br>
    <form action = "http://raptor.kent.ac.uk/~lc559/ci/index.php/Saving/loadAddSavingProgress" method = "post"> <!--  "http://localhost/ci/index.php/Income_controller/loadAddSavingProgress"  -->
      Target: <select name = "addToThisGoal">

        <?php
          foreach($results as $row) {
            echo "<option value = ";
            echo $row['savingID'],">";
            echo $row['description'];
            echo "</option>";
          }
        ?>
      </select>
      <input type = "submit" class="btn btn-danger">
    </form>
  </div>

  <br>
  <br>

  <div id = display>
    <!-- PHP loop here -->
  </div>
