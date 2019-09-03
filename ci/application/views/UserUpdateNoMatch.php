</script>

<!-- form which posts data to change user password. Has a verify field so user doesn't change password to something they mistyped -->

<style>
input{
    border: 3px solid #E84A5F;
    border-radius: 5px;
    padding: 10px;
}
</style>

<h3 id="message"> Got the urge to change your password? Do just that, here! </h3>
<br>
<br>

<form id="input" action="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/changePassword" method="post">
Current Password: <input type="password" name="oldPassword" required>
New password: <input type="password" name="newPassword" id="newPassword" required>
Verify New password: <input type="password" name="newPassword2" id="newPassword2" required>
<input type = "submit" value = "Change password" class="btn btn-danger">
</form>
<br>
<form id="input" action="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/changeFirstName" method="post">
Change first name: <input type="text" name="firstName" required>
<input type = "submit" value = "Change first name" class="btn btn-danger">
</form>
<br>
<form id="input" action="http://raptor.kent.ac.uk/~lc559/ci/index.php/user/changeSurname" method="post">
Change surname: <input type="text" name="Surname" required>
<input type = "submit" value = "Change surname" class="btn btn-danger">
</form>
<br>
<p id="message"> New passwords do not match </p>



</body>
</html>
