<?php 
require_once('main.php');

class Admin extends Main {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Worksheets_model');
		$this->load->model('Users_model');
	}


	public function add_topic()
	{
		if (isset($this->session->userdata('user')->id) and $this->session->userdata('user')->admin_level==9)
		{
			$this->load->view('add_topic');
		}
		else
		{
			redirect("/");
		}
	}

	public function process_add_topic()
	{
		$this->form_validation->set_rules('topic_name', 'topic name', 'required');
		$this->form_validation->set_rules('definition', 'definition', 'required');
		$this->form_validation->set_rules('emergency', 'emergency information', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors();
		}
		else
		{
			$data['id'] = $this->Worksheets_model->insert_topic_get_id();
			$data['added'] = true;
			$data['errors'] = "You have added a new topic! Would you like to add a question to it?";
		}
		echo json_encode($data);
	}

	public function process_add_question()
	{
		$this->Worksheets_model->insert_question();
		echo json_encode("Saved!");
	}

}

/* End of file home.php */
/* Location: ./application/controllers/worksheets.php */