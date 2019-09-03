<?php

class Income_model extends CI_Model
{

 public function __construct()
 {
   $this->load->database();
 }
 
 public function deleteIncome($incID)
 {
	 $this->db->where('incID', $incID);
     $this->db->delete('Income');
	 
 }

 public function insertIncome($amount, $description, $date, $category, $username)
 {
   //Inserts variable data recieved from addIncome into the database table Income.
   $sql = "INSERT INTO Income (amount, description, incdate, category, username) VALUES('$amount', '$description', '$date', '$category', '$username')";
   $insert = $this->db->query($sql);

 }

 public function showIncome($username)
 {
   $sql = "SELECT * FROM Income WHERE username = '$username' ORDER BY incdate DESC LIMIT 5;"; //selects everything from the income table where the username is the user's, which is passed through from the controller by getting the session.
   $query = $this->db->query($sql); //runs the query and stores it in the variable of the same name.
   return $query->result_array(); //returns the sql result as an array.
 }

 public function previewIncome($username)
 {

   $sql = "SELECT * FROM Income WHERE username = '$username' ORDER BY incdate DESC LIMIT 3";
   $query = $this->db->query($sql); //runs the query and stores it in the variable of the same name.
   return $query->result_array();

 }


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


 //create a new savings goal, with the info from the controller.
 public function newTargetGoal($username, $amount, $details) {

   $savingsTarget = array(

     'amount' => $amount,
     'description' => $details,
     'username' => $username
   );

   $this->db->insert('saving_Target', $savingsTarget);

 }

 //gets the saving targets for a particular user.
 public function getTargetGoals($username) {

   $query = $this->db->select('*')
   ->from('saving_Target')
   ->where('username', $username)
   ->get();

   return $query->result_array();

 }

 public function getTargetGoal($username, $id)
 {
   $sql = "SELECT amount, description FROM saving_Target WHERE username = '$username' AND savingID = '$id'";
   $query = $this->db->query($sql);
   return $query->result_array();


 }


 //commentio
 public function addSavingProgress($username, $amount, $id) {

   $savingProgress = array(

     'input_amount' => $amount,
     'savingID' => $id,
     'username' => $username

   );

   $this->db->insert('saving_Progress', $savingProgress);

 }

 public function getTotalProgressValue($username, $id)
 {
	 $sql = "SELECT SUM(input_amount) AS amount FROM saving_Progress WHERE username = '$username' AND savingID = '$id' GROUP BY savingID";
   $query = $this->db->query($sql);
   return $query->result_array();

 }

}
