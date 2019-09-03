<?php

class Outgoings_controller extends CI_Controller
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

	public function deleteOutgoingRow()
	{

		$expID = $this->input->post('iD');
		$this->load->model('Outgoing_model');
		$this->Outgoing_model->deleteOutgoings($expID);
		redirect("/Outgoings_controller/outgoings");
	}


    public function outgoings()
    {
      $this->loginChecker();

      $this->load->model('Outgoing_model'); //loads the user model.
      $username = $this->session->userdata('username'); //sets the variable username with the current session.
      $details = $this->Outgoing_model->showExpenditure($username); //loads the showExpenditure method and passes the username through.
      $data = array("results" => $details); //stores the results in the variable data.
      $this->load->view('heading2');
      $this->load->view('outgoings', $data); //loads the view outgoins with the array so it can be loaded onto the page.
      //$this->load->view('footer');
    }


    public function addOutgoing()
    {
      $this->loginChecker();

      $this->load->model('Outgoing_model'); //loads the user model.
      $userInfo = $this->session->userdata('username'); //gets the username from the current session and stores it in a variable.
      $details = $this->input->post('details'); //gets the information from details from the outgoings view that are in the form.
      $amount = $this->input->post('amount'); //gets the information from amount from the outgoings view that are in the form.
      $date = $this->input->post('day'); //gets the information from date from the outgoings view that are in the form.
      $category = $this->input->post('category'); //gets the information from category from the outgoings view that are in the form.

      $this->Outgoing_model->addOutgoings($userInfo, $details, $amount, $date, $category); //passes through the variables to the method addOutgoings.
      redirect("/Outgoings_controller/outgoings"); //redirects back to the homepage. Although this will be altered in a later sprint.

    }


    public function viewMoreOutgoing()
    {

      $this->loginChecker();

      $username = $this->session->userdata('username'); //sets username as the current session.

      $this->load->model('Outgoing_model'); //loads the users model
      $details = $this->Outgoing_model->outgoingsLastWeek($username); //runs the outgoingsLastWeek and passes through the username. This is a defult.
      $data = array("results" => $details); //wraps the result into an array.
      $this->load->view('heading2');
      $this->load->view('moreOutgoings', $data); //sends the information to the moreOutgoings section.
      //$this->load->view('footer');

    }


    public function viewOutgoingTime()
    {

      $this->loginChecker();

      $username = $this->session->userdata('username'); //recieves the username from the session data.
      $timePeriod = $this->input->post('category'); //recieves what dropdown item was selected when it was submitted.

      if($timePeriod == "lastWeek"){ //if the time period was set to last week, then.

        $this->load->model('Outgoing_model'); //load the users model
        $details = $this->Outgoing_model->outgoingsLastWeek($username); //run the outgoings from the last week., whilst passing the username through.
        $data = array("results" => $details); //wraps the returned data into an array.
        $this->load->view('heading2');
        $this->load->view('moreOutgoings', $data); //loads the view and passes through the data needed.
        //$this->load->view('footer');

      }
      elseif($timePeriod == "lastMonth"){ //if the time period was set to last month, then.

        $this->load->model('Outgoing_model'); //load the users model
        $details = $this->Outgoing_model->outgoingsLastMonth($username); //run the outgoings from the last month., whilst passing the username through.
        $data = array("results" => $details); //wraps the returned data into an array.
        $this->load->view('heading2');
        $this->load->view('moreOutgoings', $data); //loads the view and passes through the data needed.
        //$this->load->view('footer');

      }
      elseif($timePeriod == "lastYear"){ //if the time period was set to last year, then.

        $this->load->model('Outgoing_model'); //load the users model
        $details = $this->Outgoing_model->outgoingsLastYear($username); //run the outgoings from the last year., whilst passing the username through.
        $data = array("results" => $details); //wraps the returned data into an array.
        $this->load->view('heading2');
        $this->load->view('moreOutgoings', $data); //loads the view and passes through the data needed.
        //$this->load->view('footer');

      }
      elseif($timePeriod == "allTime"){ //if the time period was set to all time, then.

        $this->load->model('Outgoing_model');
        $details = $this->Outgoing_model->outgoingsAllTime($username);
        $data = array("results" => $details);
        $this->load->view('heading2');
        $this->load->view('moreOutgoings', $data);
        //$this->load->view('footer');

      }
    }


    public function viewCatagories()
    {
      $this->loginChecker();

      $username = $this->session->userdata('username'); //gets the session data
      $cat1 = 'General'; //a set of variables containing the names of all of the categories the database has.
      $cat2 = "Groceries";
      $cat3 = "Utilities";
      $cat4 = "Lifestyle";

      $this->load->model('Outgoing_model'); //loads the user model
      $data['general'] = $this->Outgoing_model->viewCategories($username, $cat1); //runs the model function and passes through the username and category. It then stores it in the data array as a general item, meaning it can be accessed as $general AS $row in the view.
      $data['grocieries'] = $this->Outgoing_model->viewCategories($username, $cat2); //runs the model function and passes through the username and category. It then stores it in the data array as a grocieries item, meaning it can be accessed as $grocieries AS $row in the view.
      $data['bills'] = $this->Outgoing_model->viewCategories($username, $cat3); //runs the model function and passes through the username and category. It then stores it in the data array as a bills item, meaning it can be accessed as $bills AS $row in the view.
      $data['lifestyle'] = $this->Outgoing_model->viewCategories($username, $cat4); //runs the model function and passes through the username and category. It then stores it in the data array as a lifestyle item, meaning it can be accessed as $lifestyle AS $row in the view.
      $data['graph'] = $this->Outgoing_model->expenditureCategoryData($username); //runs the model so that it can get the information to form the pie chart through.

      $this->load->view('heading2');
      $this->load->view('categories', $data);
      //$this->load->view('footer');
      //$this->load->view('categories', $details);
    }

    // Shows the user the calander page
    public function viewCalendarPage()
    {
        $this->loginChecker();

        $username = $this->session->userdata('username'); //gets the session data
        $this->load->model('Outgoing_model');
        $data['results'] = $this->Outgoing_model->seeCalanderInput($username);

        $this->load->view('calhead2');
        $this->load->view('calendar',$data);
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
      $details = $this->Outgoing_model->insertBillCalendar($amount, $description, $date, $category, $username);

      redirect("/Outgoings_controller/viewCalendarPage");
    }
}
