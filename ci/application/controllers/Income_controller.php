<?php

class Income_controller extends CI_Controller
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

	public function deleteIncomeRow()
	{
		$incID = $this->input->post('iD');
		$this->load->model('Income_model');
		$this->Income_model->deleteIncome($incID);
		redirect("/Income_controller/income");
	}

    //directs to the income page
    public function income()
    {
      $this->loginChecker();

  	  $username = $this->session->userdata('username');
  	  $this->load->model('Income_model');
  	  $data['incomeData'] = $this->Income_model->showIncome($username);
  	  $data['table'] = false;

  	  if(empty($data['incomeData'])){
          //$this->load->view("Heading");
          $this->load->view('heading2');
  	      $this->load->view("IncomePage", $data);
          //$this->load->view('footer');
  	  }
         else{
  		   $data['table'] = true;
             //$this->load->view("Heading");
          $this->load->view('heading2');
  	      $this->load->view("IncomePage", $data);
          //$this->load->view('footer');
  	   }
    }


    public function addIncome()
    {
      $this->loginChecker();

      //Stores all post data recieved from "IncomePage" into variables
      $amount = $this->input->post('income');
      $description = $this->input->post('description');
      $date = $this->input->post('date');
      $category = $this->input->post('category');
      $username = $this->session->userdata('username');

      //Calls the insertIncome function to store the post data to the income table
      $this->load->model('Income_model');
      $this->Income_model->insertIncome($amount, $description, $date, $category, $username);

      redirect("/Income_controller/income");
    }


    public function viewMoreIncome()
    {
      $this->loginChecker();

      $username = $this->session->userdata('username');

      $this->load->model('Income_model');
      $details = $this->Income_model->incomeLastWeek($username);
      $data = array("results" => $details);
      $this->load->view('heading2');
      $this->load->view('moreIncome', $data);
      //$this->load->view('footer');

    }


    public function viewIncomeTime()
    {

      $this->loginChecker();

      $username = $this->session->userdata('username');
      $timePeriod = $this->input->post('category');

      if($timePeriod == "lastWeek"){ //if the time period was set to last week, then.

        $this->load->model('Income_model'); //load the users model
        $details = $this->Income_model->incomeLastWeek($username); //run the income from the last week, whilst passing the username through.
        $data = array("results" => $details); //wraps the returned data into an array.
        $this->load->view('heading2');
        $this->load->view('moreIncome', $data); //loads the view and passes through the data needed.
        //$this->load->view('footer');

      }
      elseif($timePeriod == "lastMonth"){

        $this->load->model('Income_model');
        $details = $this->Income_model->incomeLastMonth($username); //run the income from the last month, whilst passing the username through.
        $data = array("results" => $details); //wraps the returned data into an array.
        $this->load->view('heading2');
        $this->load->view('moreIncome', $data); //loads the view and passes through the data needed.
        //$this->load->view('footer');

      }
      elseif($timePeriod == "lastYear"){

        $this->load->model('Income_model');
        $details = $this->Income_model->incomeLastYear($username); //run the income from the last year, whilst passing the username through.
        $data = array("results" => $details); //wraps the returned data into an array.
        $this->load->view('heading2');
        $this->load->view('moreIncome', $data); //loads the view and passes through the data needed.
        //$this->load->view('footer');

      }
      elseif($timePeriod == "allTime"){

        $this->load->model('Income_model');
        $details = $this->Income_model->incomeAllTime($username);
        $data = array("results" => $details);
        $this->load->view('heading2');
        $this->load->view('moreIncome', $data);
        //$this->load->view('footer');

      }
	}

  //loads the savingGoal view.
    public function loadSavingGoal()
    {

      $this->loginChecker();

      $username = $this->session->userdata('username');

      $this->load->model('Income_model');
      $details['results'] = $this->Income_model->getTargetGoals($username);

      $this->load->view('heading2');
      $this->load->view('savingGoal', $details);
      //$this->load->view('footer');

    }


    //adds a saving target to the database.
    public function addSavingTarget()
    {

      $this->loginChecker();

      $username = $this->session->userdata('username');
      $amount = $this->input->post('amount');
      $details = $this->input->post('details');

      $this->load->model('Income_model');
      $this->Income_model->newTargetGoal($username, $amount, $details);

      redirect('/income_controller/loadSavingGoal');

    }

    //gets all the informationr regarding stuff
    public function getAllSavingTargets()
    {

      $this->loginChecker();

      $this->load->model('Income_model');
      $details = $this->Income_model->getTargetGoals();

    }

    public function loadAddSavingProgress()
    {

      $this->loginChecker();

  	  $username = $this->session->userdata('username');
  	  $id = $this->input->post('addToThisGoal');
  	  $this->load->model('Income_model');

  	  $data['iD'] =  $id;

  	  $data['target'] = $this->Income_model->getTargetGoal($username, $id);
  	  $data['total'] = $this->Income_model->getTotalProgressValue($username, $id);
  	  $data['des'] = $this->Income_model->getTargetGoal($username, $id);

  	  $this->loadSavingGoal();
  	  $this->load->view('savingProgress', $data);
      //$this->load->view('footer');

    }


  //add saving progress
    public function addSavingProgress() {

      $this->loginChecker();

      $username = $this->session->userdata('username');
      $amount = $this->input->post('sAmount');
      $id = $this->input->post('iD');

      $this->load->model('Income_model');
      $details = $this->Income_model->addSavingProgress($username, $amount, $id);

      redirect('/income_controller/loadSavingGoal');

    }
    //gets all information regarding


  }
