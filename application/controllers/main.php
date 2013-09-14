<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('Worksheet_model');
		if (isset($this->session->userdata('user')->id))
		{
			$this->data['logged_in'] = true;
			if ($this->session->userdata('user')->admin_level==9)
			{
				$this->data['admin'] = true;
			}
			else
			{
				$this->data['admin'] = false;				
			}
		}
		else
		{
			$this->data['logged_in'] = false;
		}

	}

	public function index()
	{

		$this->data['topics'] = $this->Worksheet_model->topics;
		$this->load->view('home', $this->data);
	}

	public function about()
	{
		$this->load->view('about', $this->data);
	}

	
}

/* End of file home.php */
/* Location: ./application/controllers/welcome.php */