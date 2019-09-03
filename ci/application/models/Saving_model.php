<?php

class Saving_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
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
  
  public function getLatestProgress($username)
  {
	  $sql = "SELECT * FROM saving_Progress WHERE (SELECT MAX(inputID) AS maxID FROM saving_Progress WHERE username = '$username') = inputID"; 
	  $query = $this->db->query($sql);
	  return $query->result_array();
  }
}
