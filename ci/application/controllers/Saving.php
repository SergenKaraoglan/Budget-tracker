<?php

class Saving extends CI_Controller
{
   public function __construct()
    {

	   parent::__construct();
       //session_start();
	   $this->load->library('session'); //allows the creation of sessions.
	   $this->load->helper('url'); //allows the use of redirects.
    }

    //loads the savingGoal view.
      public function loadSavingGoal() {

        $username = $this->session->userdata('username');

        $this->load->model('Saving_model');
        $details['results'] = $this->Saving_model->getTargetGoals($username);

        $this->load->view('heading2');
        $this->load->view('savingGoal', $details);
        //$this->load->view('footer');

      }


      //adds a saving target to the database.
      public function addSavingTarget() {

        $username = $this->session->userdata('username');
        $amount = $this->input->post('amount');
        $details = $this->input->post('details');

        $this->load->model('Saving_model');
        $this->Saving_model->newTargetGoal($username, $amount, $details);

        redirect('/Saving/loadSavingGoal');

      }

      //gets all the informationr regarding stuff
      public function getAllSavingTargets() {

        $this->load->model('Saving_model');
        $details = $this->Saving_model->getTargetGoals();

      }

      public function loadAddSavingProgress()
      {

        $username = $this->session->userdata('username');
        $id = $this->input->post('addToThisGoal');
        $this->load->model('Saving_model');

        $data['iD'] =  $id;

        $data['target'] = $this->Saving_model->getTargetGoal($username, $id);
        $data['total'] = $this->Saving_model->getTotalProgressValue($username, $id);
        $data['des'] = $this->Saving_model->getTargetGoal($username, $id);

        $this->loadSavingGoal();
        //$this->load->view('heading2');
        $this->load->view('savingProgress', $data);
        //$this->load->view('footer');

      }


      //add saving progress
      public function addSavingProgress() {

        $username = $this->session->userdata('username');
        $amount = $this->input->post('sAmount');
        $id = $this->input->post('iD');

        $this->load->model('Saving_model');
        $details = $this->Saving_model->addSavingProgress($username, $amount, $id);

        redirect('/Saving/loadSavingGoal');

      }

      public function getLatestProgress($username)
  {
	  $username = $this->session->userdata('username');
	   $this->load->model('Saving_model');
	   $this->Saving_model->getLatestProgress($username);
  }
      //gets all information regarding

}
