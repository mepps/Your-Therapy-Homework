<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public $view_data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Worksheets_model');

	}

	public function index()
	{
		$data['topics'] = $this->Worksheets_model->topics;
		$this->load->view('home', $data);
	}

	public function about()
	{
		$this->load->view('about');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/welcome.php */