<?php

class User extends CI_Controller
{
   public function __construct()
    {

	   parent::__construct();
       //session_start();
	   $this->load->library('session'); //allows the creation of sessions.
	   $this->load->helper('url'); //allows the use of redirects.
    }

    public function loginChecker()
    {
      $username = $this->session->userdata('username');

      if($username == null){

        redirect("/user/loginpage");

      }

    }


	public function loginPage()
	{
    $this->load->view('signedouthead');
		$this->load->view('login'); //loads login page.
	}

	public function login()
	{
		$username = $this->input->post('username'); //stores the username found in login into this var
		$password = $this->input->post('password'); //stores the password found in login into this var

		$this->load->model('Users_model'); //loads the user model.
		$verify = $this->Users_model->loginCheck($username, $password); //runs the loginCheck and stores the result in verify.
		$data = array("results" => $verify); //stores the results in an array - was used for testing.

		if($verify == TRUE)
		{
			$userData = array('username' => $username); //stores the session into an array.
			$this->session->set_userdata($userData); //sets the session id as whatever the username of the user is.
			redirect('/user/homepage'); //loads the homepage.
		}
		else if($verify == FALSE)
        {
          redirect("/user/rejectLogin");
		}

	}

  public function rejectLogin()
  {
    $this->load->view('signedouthead');
    $this->load->view('loginReject');
    //$this->load->view('footer');
  }


public function homepage()
  {

  $username = $this->session->userdata('username'); //sets current user to the session.
  $this->loginChecker();

  $this->load->model('Income_model');
  $details['inc'] = $this->Income_model->previewIncome($username);

  $this->load->model('Outgoing_model');
  $details['exp'] = $this->Outgoing_model->previewExpenditure($username);

  $this->load->model('Saving_model');
  $details['recentprogress'] = $this->Saving_model->getLatestProgress($username);

  $this->load->model('Users_model');
  $details['firstLastName'] = $this->Users_model->getFirstLastName($username);

  foreach($details['recentprogress'] as $row) { $iD = $row['savingID']; }

  if(isset($iD) === true)
  {
  $details['targetSaving'] = $this->Saving_model->getTargetGoal($username, $iD);

  $details['totalProgress'] = $this->Saving_model->getTotalProgressValue($username, $iD);

  $details['notSet'] = false;
  }
  else{
	  $details['notSet'] = true;
  }
  $details['recentCat'] = $this->Outgoing_model->viewRecentCategoryData($username);

  $this->load->view('heading2', $details);
	$this->load->view('homepage'); //loads the homepage.
  //$this->load->view('footer');


  }

	public function logout()
	{
		$this->session->sess_destroy(); //destroys the current session.
		redirect('/user/loginpage'); //redirects the user back to the login page.
	}

//Loads the header along with the signup view. Header view adds css and a title to the page.
	public function signup()
	{
	  //$this->load->view('Heading')
    $this->load->view('signedouthead');
		$this->load->view('Signup');
    //$this->load->view('footer');
	}

  public function addUser()
	{
		$username = $_POST['username'];

		$this->load->model('users_model');


		$password = $_POST['password'];
		$firstName = $_POST['firstName'];
		$secondName = $_POST['secondName'];

        //checks if the username already exists in the database. If true the user will be redirected to signup with an error message notifying them.
		if($this->users_model->checkUsername($username) == true){
		    //$this->load->view('Heading');
			//$data['error'] = "Username exists";
			redirect("/User/rejectSignUp");
			//echo "Username exists.";
		}
		//If username does not exist the password entered is checked by the checkPassword function. If also true then the user will be succesfully registered, otherwise another error message will appear.
		  else{
			 if($this->checkPassword($password) == true){
			 $this->users_model->registerUser($username, $password, $firstName, $secondName);
			 redirect("/user/loginPage");
			 }
			   else{
				   //$this->load->view('Heading');
				   redirect("/user/rejectSignUpPassword");
				   //echo "password too short";
			   }
		 }
	}

  public function rejectSignUp()
  {
    $this->load->view('signedouthead');
    $this->load->view('rejectSignUp');
    //$this->load->view('footer');
  }

  public function rejectSignUpPassword()
  {

    $this->load->view('signedouthead');
    $this->load->view('SignUpRejectPass');
    //$this->load->view('footer');

  }

    public function userSettings()
	{
    $this->loginChecker();

    $this->load->view('heading2');
		$this->load->view("UserUpdate");
	}


  	public function changePassword()
  	{

      $this->loginChecker();
  		$this->load->model('users_model');

  		$username = $this->session->userdata('username');
  	  $oldPassword = $_POST['oldPassword'];
  		$newPassword = $_POST['newPassword'];
  		$verifyPassword = $_POST['newPassword2'];

  		//checks if the newly added password is correctly inputted twice. This is to add safety towards any user mistakes.
  		if($newPassword != $verifyPassword)
  		{
  			$this->updatePasswordCurrentWr();

  		}
  		  else{
  		      //checks if the password is at least six characters long
  			  if($this->checkPassword($newPassword) == true){

  			      $passwordEqual = $this->users_model->checkPassword($oldPassword, $username);

  			      //checks if the current password they input for their account is correct. This is to make sure the user making the password change is the owner of the account.
              if($passwordEqual == true){

             //password is sucessfully changed and user is redirected
  					 $this->users_model->updatePassword($newPassword, $username);
  					 $this->updatePasswordSuccess();
  					 //echo "Password has been successfully changed";
  				  }
  			        else{
  					     $this->updatePasswordNoMatch();
  					     //echo "Current password is incorrect";
  				     }
  		 	  }
  		   	 else{
   			 	 $this->updatePasswordShort();
  				 //echo "password too short";
  			 }
  		 }
  	}

  	public function checkPassword($password)
  	{
  	    //checks if the submitted password is six characters long or not. This is added to ensure a secure password is registered by the user.
  		if(strlen($password)<6){
  			return false;
  		}
  		else{
  			return true;
  		}
  	}

    public function updatePasswordSuccess()
    {
      $this->load->view('heading2');
      $this->load->view('UpdatePasswordSuccess');
    }

    public function updatePasswordCurrentWr()
    {
      $this->load->view('heading2');
      $this->load->view('UserUpdateNoMatch');
    }

    public function updatePasswordShort()
    {
      $this->load->view('heading2');
      $this->load->view('UserUpdatePassword');
    }

    public function updatePasswordNoMatch()
    {
      $this->load->view('heading2');
      $this->load->view('UserUpdatePasswordInc');
    }


    public function changeFirstName()
  {
    $this->loginChecker();
    $this->load->model('users_model');

    $username = $this->session->userdata('username');

    $firstname = $_POST['firstName'];

    $this->users_model->updateFirstName($firstname, $username);
    $this->userSettings();

  }

public function changeSurname()
{
  $this->loginChecker();
  $this->load->model('users_model');

  $username = $this->session->userdata('username');

  $surname = $_POST['Surname'];

  $this->users_model->updateSurname($surname, $username);
  $this->userSettings();

}

  public function viewGraph()
  {
    $this->loginChecker();
      $username = $this->session->userdata('username'); //comment
      $this->load->model('Users_model'); //comment
	  $details['incomeVsExpenditure'] = $this->Users_model->incomeVsExpenditureLineGraphData($username);
	  $details['avgSpending'] = $this->Users_model->getAverageSpending($username);

     //stores the results in the variable details.
     $this->load->view('heading2');
      $this->load->view('lineGraph', $details);
      //$this->load->view('footer');

  }

  public function viewPieGraph()
  {
    $this->loginChecker();
    	  $username = $this->session->userdata('username'); //sets username as the current session.
	      $this->load->model('Users_model'); //loads the users model
        $details['graph'] = $this->Users_model->expenditureCategoryData($username); //runs the expenditureCategoryData function and passes through username

        $this->load->view('categories', $details); //loads the categories view and passes it through.
  }


  public function viewOutgoingTime()
  {
    $this->loginChecker();

    $username = $this->session->userdata('username'); //recieves the username from the session data.
    $timePeriod = $this->input->post('category'); //recieves what dropdown item was selected when it was submitted.

    if($timePeriod == "lastWeek"){ //if the time period was set to last week, then.

      $this->load->model('Users_model'); //load the users model
      $details = $this->Users_model->outgoingsLastWeek($username); //run the outgoings from the last week., whilst passing the username through.
      $data = array("results" => $details); //wraps the returned data into an array.
      $this->load->view('moreOutgoings', $data); //loads the view and passes through the data needed.

    }
    elseif($timePeriod == "lastMonth"){ //if the time period was set to last month, then.

      $this->load->model('Users_model'); //load the users model
      $details = $this->Users_model->outgoingsLastMonth($username); //run the outgoings from the last month., whilst passing the username through.
      $data = array("results" => $details); //wraps the returned data into an array.
      $this->load->view('moreOutgoings', $data); //loads the view and passes through the data needed.

    }
    elseif($timePeriod == "lastYear"){ //if the time period was set to last year, then.

      $this->load->model('Users_model'); //load the users model
      $details = $this->Users_model->outgoingsLastYear($username); //run the outgoings from the last year., whilst passing the username through.
      $data = array("results" => $details); //wraps the returned data into an array.
      $this->load->view('moreOutgoings', $data); //loads the view and passes through the data needed.

    }
    elseif($timePeriod == "allTime"){ //if the time period was set to all time, then.

      $this->load->model('Users_model');
      $details = $this->Users_model->outgoingsAllTime($username);
      $data = array("results" => $details);
      $this->load->view('moreOutgoings', $data);

    }
  }


  // A method that takes the information and calls the Model method
  public function addPaymentFrequency()
  {
    $this->loginChecker();

    $amount = $this->input->post('amount');
	  $description = $this->input->post('details'); //info from form get passed to these variables.
	  $date = $this->input->post('day');
	  $category = $this->input->post('frequency');
	  $username = $this->session->userdata('username'); //gets the session username and sets that as the username.

    $this->load->model('Outgoing_model');
    $details = $this->Users_model->insertBillCalendar($amount, $description, $date, $category, $username);
    $this->load->view('calendar');

  }


public function categoryByTime()
{
  $this->loginChecker();

 $username = $this->session->userdata('username');
 $time = $this->input->post('time');//post data for time
 $category = $this->input->post('category');
 $this->load->model('Users_model');
 $data['categoryTime'] = $this->Users_model->getCategoryByTime($username, $time, $category);
 $this->load->view('heading2');
 $this->load->view('moreCategories', $data);
}

public function viewMoreGeneral()
{
  $this->loginChecker();

	$username = $this->session->userdata('username');
	$time = 7;
	$category = 'General';
	$this->load->model('Users_model');
	$data['categoryTime'] = $this->Users_model->getCategoryByTime($username, $time, $category);
  $this->load->view('heading2');
	$this->load->view('moreCategories', $data);
}

public function viewMoreGroceries()
{
  $this->loginChecker();
	$username = $this->session->userdata('username');
	$time = 7;
	$category = 'Groceries';
	$this->load->model('Users_model');
	$data['categoryTime'] = $this->Users_model->getCategoryByTime($username, $time, $category);
  $this->load->view('heading2');
	$this->load->view('moreCategories', $data);

}

public function viewMoreUtilities()
{
  $this->loginChecker();
	$username = $this->session->userdata('username');
	$time = '7';
	$category = 'Utilities';
	$this->load->model('Users_model');
	$data['categoryTime'] = $this->Users_model->getCategoryByTime($username, $time, $category);
  $this->load->view('heading2');
	$this->load->view('moreCategories', $data);

}

public function viewMoreLifestyle()
{
  $this->loginChecker();
	$username = $this->session->userdata('username');
	$time = 7;
	$category = 'Lifestyle';
	$this->load->model('Users_model');
	$data['categoryTime'] = $this->Users_model->getCategoryByTime($username, $time, $category);
  $this->load->view('heading2');
	$this->load->view('moreCategories', $data);

}

}
