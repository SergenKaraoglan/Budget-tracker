<?php

class Outgoing_model extends CI_Model
{

 public function __construct()
 {
   $this->load->database();
 }

 public function deleteOutgoings($expID)
 {
	 $this->db->where('expID', $expID);
	 $this->db->delete('Expenditure');
	 
	 
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
  $sql = "SELECT * FROM Expenditure WHERE username = '$username' ORDER BY expdate DESC LIMIT 5;"; //selects everything from expenditure where the username is the same as the current sessions'.
  $query = $this->db->query($sql); //runs the sql statement with the database.
  return $query->result_array(); //returns the result as an array.
 }


 public function previewExpenditure($username)
 {
   $sql = "SELECT * FROM Expenditure WHERE username = '$username' ORDER BY expdate DESC LIMIT 3;";
   $query = $this->db->query($sql); //runs the sql statement with the database.
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
 
 public function viewRecentCategoryData($username)
  {

   $sql = "SELECT category, SUM(amount) AS total FROM Expenditure WHERE username = '$username' AND (expdate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 7 DAY)) AND CURDATE()) GROUP BY category";
   $query = $this->db->query($sql);
   return $query->result_array(); //returns an array of the results to the controller.
  }


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


 public function viewCategories($username, $category)
 {
   $query = $this->db->select('description, amount, expdate') //selects the description, amount and date
   ->from('Expenditure')
   ->where('category', $category) //where the category is the same as the one passed through.
   ->where('username', $username) //and where the username is the same as the one passed through.
   ->order_by('expdate', 'DESC') //ordered by the expdate.
   ->limit(5)
   ->get(); //executes the sql.
   return $query->result_array(); //returns an array to the controller.
 }

 public function insertBillCalendar($amount, $description, $date, $category, $username) {

   $sql = "INSERT INTO Calander(amount, description, base_date, frequency, username) VALUES('$amount', '$description', '$date', '$category', '$username')";
   $query = $this->db->query($sql);

 }

 //method to get all records
 public function seeCalanderInput($username)
 {
   $query = $this->db->select('*')
   ->from('Calander')
   ->where('username', $username)
   ->get();
   return $query->result_array();
 }

}
