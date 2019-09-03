<?php

class Users_model extends CI_Model
{
 public function __construct()
 {
   $this->load->database();
 }

 public function login($username, $password)
 {

 }

 public function loginCheck($username, $password)
 {
	 $pass = sha1($password); //password is hashed so that it can be found in the database.

	 $sql = "SELECT * FROM User WHERE username = '$username' AND password = '$pass'"; //selects everything from the user table where the name and password match the passed through variables.
	 $query = $this->db->query($sql, array($username, $pass)); //runs the query and wraps it into an array.
	 return $query->result_array(); //returns the result.

	 //$check = $query->result_array();

	 if(empty($query)){ //if the query here is empty.
		return false; //then return false.
	 }
	 else{
		return true; //otherwise return true.
	 }

 }

 public function getFirstLastName($username)
 {
   
   $sql="SELECT firstname, surname FROM User WHERE username = '$username'";
   $query = $this->db->query($sql); //runs the sql statement with the database.
   return $query->result_array();

 }

//Registers the user
 public function registerUser($username, $password, $firstName, $secondName)
 {

    //user data is inserted to the database
    $data = array(
    'username' => $username,
	  'password' => sha1($password), //hashes the password entered by the user data before it is submitted to the database to make the password secure.
	  'firstname' => $firstName,
	  'surname' => $secondName
	  );
    $this->db->insert('User', $data);
    
    $sql="INSERT INTO saving_Target(amount, description, username) VALUES('100', 'My first goal!', '$username')";
    $this->db->query($sql);

 }

//makes sure the username submitted by the user is unique to avoid duplicates
  public function checkUsername($username)
  {
      //searches the database to fetch any username results that are equal to the username submmitted
	 $query = $this->db->select('*')
    ->from('User')
	  ->where('username', $username)
	  ->get();



     //If the query does contain something that means a duplicate username was found and therefore returns false, otherwise true.
	  if(empty($query->result_array())){
		  return false;
	  }
	   else{
	    return true;
	    }
  }

  public function addOutgoings($amount, $details, $date, $category, $user)
  {
    $username = $user; //was used for troubleshooting where the SQL query would get muddled up from it's original order.
    $cat = $category; //was used for troubleshooting where the SQL query would get muddled up from it's original order.
    $dat = $date; //was used for troubleshooting where the SQL query would get muddled up from it's original order.
    $desc = $details; //was used for troubleshooting where the SQL query would get muddled up from it's original order.
    $money = $amount; //was used for troubleshooting where the SQL query would get muddled up from it's original order.

    $sql = "INSERT INTO Expenditure (username, category, description, amount, expdate) VALUES('$money', '$username', '$desc', '$dat', '$cat');"; //query that inserts the the variables into the database. It's muddled up here becuase of an issue we faced - whereby the sql query would swap the values around to other orders. Was fixed by changing the INSERT INTO order.
    $insert = $this->db->query($sql); //runs the sql statement and inserts into the database.
  }

  public function showExpenditure($username)
  {
	  $sql = "SELECT * FROM Expenditure WHERE username = '$username'"; //selects everything from expenditure where the username is the same as the current sessions'.
	  $query = $this->db->query($sql); //runs the sql statement with the database.
	  return $query->result_array(); //returns the result as an array.
  }

  //checks if the password entered by the user signed in is equal to the password they have in the database. It is an extra layer of security to avoid important data being changed by an unauthorised user
  public function checkPassword($password, $username)
  {

      //function works the same as checkUsername but searches the database to see if there is a matching password.

	  $pass = sha1($password);
	  $query = $this->db->select('*')
	  ->from('User')
	  ->where('password', $pass, 'username', $username)
	  ->get();

	  $passwordEqual = $query->result_array();

	  //If the result is empty then false is returned otherwise true
	  if(empty($passwordEqual)){
		  return false;
	  }
	   else{
		   return true;
	   }
  }

  public function updatePassword($password, $username)
  {
      //updates the password field for the user signed in to the newly set password.
	  $pass = sha1($password);
	  $this->db->set('password', $pass);
    $this->db->where('username', $username);
    $this->db->update('User');

  }

  public function updateFirstName($firstname, $username)
  {
    $this->db->set('firstname', $firstname);
    $this->db->where('username', $username);
    $this->db->update('User');
  }


  public function updateSurname($surname, $username)
  {
	 $this->db->set('surname', $surname);
    $this->db->where('username', $username);
    $this->db->update('User');

  }

  public function insertIncome($amount, $description, $date, $category, $username)
  {
	  //Inserts variable data recieved from addIncome into the database table Income.
	  $sql = "INSERT INTO Income (amount, description, incdate, category, username) VALUES('$amount', '$description', '$date', '$category', '$username')";
	  $insert = $this->db->query($sql);

  }

  public function showIncome($username)
  {
    $sql = "SELECT * FROM Income WHERE username = '$username'"; //selects everything from the income table where the username is the user's, which is passed through from the controller by getting the session.
    $query = $this->db->query($sql); //runs the query and stores it in the variable of the same name.
    return $query->result_array(); //returns the sql result as an array.
  }

 public function incomeVsExpenditureLineGraphData($username)
  {
	$sql = "SELECT inc.incdate, totalIncome, totalExpenditure FROM (SELECT incdate, SUM(Income.amount) AS totalIncome FROM Income WHERE username = '$username' Group By Incdate) inc
LEFT JOIN (SELECT expdate, SUM(Expenditure.amount) AS totalExpenditure FROM Expenditure WHERE username = '$username' Group By expdate) exp ON inc.incdate = exp.expdate UNION SELECT exp.expdate, totalIncome, totalExpenditure FROM (SELECT incdate, SUM(Income.amount) AS totalIncome FROM Income WHERE username = '$username' Group By Incdate) inc
RIGHT JOIN (SELECT expdate, SUM(Expenditure.amount) AS totalExpenditure FROM Expenditure WHERE username = '$username' Group By expdate) exp ON inc.incdate = exp.expdate ORDER BY incdate";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

 public function getAverageSpending($username)
 {
  $sql = "SELECT a.expdate, average, total FROM(SELECT expdate, CAST(AVG(amount) AS decimal(10,2)) as average FROM Expenditure WHERE username <> '$username' GROUP BY expdate)a
  INNER JOIN (SELECT expdate, SUM(amount) as total FROM Expenditure WHERE username = '$username' GROUP BY expdate)b ON a.expdate = b.expdate GROUP BY a.expdate ORDER BY a.expdate ASC " ;
  $query = $this->db->query($sql);
  return $query->result_array();
 }

  public function expenditureCategoryData($username)
  {
	  $query = $this->db->select('category, SUM(amount) AS total') //selects the categories and adds them up to a value called total.
		->from('Expenditure')
		->where('username', $username)
		->group_by('category') //groups these sums by category.
		->get();

		return $query->result_array(); //returns an array of the results to the controller.

  }




public function getCategoryByTime($username, $time, $category)
{
  $sql = "SELECT description, amount, expdate  FROM Expenditure WHERE (expdate BETWEEN (DATE_SUB(CURDATE(), INTERVAL '$time' DAY)) AND CURDATE()) AND username = '$username' AND category = '$category' ORDER BY expdate DESC";
  $query = $this->db->query($sql);
  return $query->result_array();
}


  //SQL needed for the drop down option on more outgoings.

  public function outgoingsLastWeek($username)
  {
    //$sql = "SELECT * FROM Expenditure WHERE expdate >= (CURDATE() + INTERVAL -1 WEEK) AND username = '$username' ORDER BY expdate DESC"; //the use of CURDATE gets the day from today, then using the Interval DAY, it gets the Day of the Month and takes 7 away. This is better than our previous use which done expdate BETWEEN CURDATE AND CURDATE-7, which on looking back a month on March 1st, would return the 73rd of February.
    $sql = "SELECT * FROM Expenditure WHERE (expdate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 7 DAY)) AND CURDATE()) AND username = '$username' ORDER BY expdate DESC"; //Selects everything from expenditure where the input date is the current date take away 7, as well as the current date.
    $query = $this->db->query($sql); //executes the sql command
    return $query->result_array(); //returns an array to the controller.
  }

  public function outgoingsLastMonth($username)
  {
  $sql = "SELECT * FROM Expenditure WHERE (MONTH(expdate) = MONTH(CURDATE())-1 AND DAY(expdate) >= DAY(CURDATE()) AND YEAR(expdate) = YEAR(CURDATE()) AND username = '$username')
           OR (MONTH(expdate) = MONTH(CURDATE()) AND DAY(expdate) <= DAY(CURDATE()) AND YEAR(expdate) = YEAR(CURDATE())  AND username = '$username') ORDER BY expdate DESC";
  $query = $this->db->query($sql); //executes the sql command
  return $query->result_array(); //returns an array to the controller.
  }

  public function outgoingsLastYear($username)
  {
    $sql = "SELECT * FROM Expenditure WHERE (expdate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 365 DAY)) AND CURDATE()) AND username = '$username' ORDER BY expdate"; //sub date is used here to find all of the expenditure from the current day, subtract the amount of days we want to look for them over, in this case it'll be the past 365 days.
    $query = $this->db->query($sql); //executes the sql command
    return $query->result_array(); //returns an array to the controller.
  }

  public function outgoingsAllTime($username)
  {
    $sql = "SELECT * FROM Expenditure WHERE username = '$username' ORDER BY expdate DESC";
    $query = $this->db->query($sql); //executes the sql command
    return $query->result_array(); //returns an array to the controller.
  }


//SQL needed for the drop down option on more income.

  public function incomeLastWeek($username)
  {
    $sql = "SELECT * FROM Income WHERE (incdate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 7 DAY)) AND CURDATE()) AND username = '$username' ORDER BY incdate DESC"; //Selects everything from income where the input date is the current date take away 7, as well as the current date.
    $query = $this->db->query($sql); //executes the sql command
    return $query->result_array(); //returns an array to the controller.
  }

  public function incomeLastMonth($username)
  {
     $sql = "SELECT * FROM Income WHERE (MONTH(incdate) = MONTH(CURDATE())-1 AND DAY(incdate) >= DAY(CURDATE()) AND YEAR(incdate) = YEAR(CURDATE()) AND username = '$username')
           OR (MONTH(incdate) = MONTH(CURDATE()) AND DAY(incdate) <= DAY(CURDATE()) AND YEAR(incdate) = YEAR(CURDATE())  AND username = '$username') ORDER BY incdate DESC";
           $query = $this->db->query($sql); //executes the sql command
           return $query->result_array(); //returns an array to the controller.

  }

  public function incomeLastYear($username)
  {
    $sql = "SELECT * FROM Income WHERE (incdate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 365 DAY)) AND CURDATE()) AND username = '$username' ORDER BY incdate"; //Selects everything from income where the input date is the current date take away 365, as well as the current date.
    $query = $this->db->query($sql); //executes the sql command
    return $query->result_array(); //returns an array to the controller.
  }

  public function incomeAllTime($username)
  {
    $sql = "SELECT * FROM Income WHERE username = '$username' ORDER BY incdate DESC";
    $query = $this->db->query($sql); //executes the sql command
    return $query->result_array(); //returns an array to the controller.
  }


  public function viewCategories($username, $category)
  {
    $query = $this->db->select('description, amount, expdate') //selects the description, amount and date
    ->from('Expenditure')
    ->where('category', $category) //where the category is the same as the one passed through.
    ->where('username', $username) //and where the username is the same as the one passed through.
    ->order_by('expdate', 'DESC') //ordered by the expdate.
    ->get(); //executes the sql.
    return $query->result_array(); //returns an array to the controller.
  }

 }
