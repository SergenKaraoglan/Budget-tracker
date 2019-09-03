<!-- All post data in this form is used to create a user account -->

<style>
input{
    border: 3px solid #E84A5F;
    border-radius: 5px;
    padding: 10px;
}
</style>

<form action="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/addUser"  id="message"   method="post">
<label for="username">Username: </label> <br> <input type="text" name="username" placeholder="johndoe" required><br><br>
<label for="password">Password: </label> <br> <input type="password" name="password" placeholder="Enter your password" required><br><br>
<label for="firstName">First name: </label> <br> <input type="text" name="firstName" placeholder="John" required><br><br>
<label for="secondName">Surname: </label> <br> <input type="text" name="secondName" placeholder="Doe" required><br>
<br>
<input type= "submit" value="Sign up" class="btn btn-danger">
</form>
<br>
<p class="text-muted"> By signing up, you agree to have your data anonymously used as an average to compare your spending habits with other users </p>
<br>
<p id="message"> Password is too short - it needs to be at least 6 characters long. </ p>
<br>
<p> Already have an account with us? Sign in <a href="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/loginpage"> here</a>

<?php
//was considering of printing error messages in this space but using the echo function for now

//if(isset($error)){
    // echo "<p>".$error."</p>";
  //}
?>

</body>
</html>
