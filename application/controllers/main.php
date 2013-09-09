<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	// protected $view_data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Worksheets_model');

	}
	// public function display_things()
	// {
	//     $things = "some things";
	//     $this->view_data['things'] = $hings;

	//     $this->load->view('some_view', $this->view_data);
	// }

	public function index()
	{
		$data['topics'] = $this->Worksheets_model->topics;
		$this->load->view('home', $data);
	}

	public function about()
	{
		$this->load->view('about');
	}

	public function logged_in()
	{
		if (isset($this->session->userdata('user')->id))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/welcome.php */