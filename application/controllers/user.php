<?php 

require_once('main.php');

class User extends Main {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function logoff()
	{
		$this->session->sess_destroy();
		redirect("/");

	}

	public function register()
	{
		$this->load->view('register');
	}

	public function process_login()
	{
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors();
		}
		else
		{
			$user = $this->Users_model->login_user();
			if ($user==false)
			{
				$data['errors'] = "Wrong username or password.";
			}
			else
			{
				$this->session->set_userdata('user', $user);
				$data['logged_in'] = true;
			}		
		}
		echo json_encode($data);
	}

	public function process_registration()
	{
		$this->form_validation->set_rules('first_name', 'first name', 'required|alpha'); 
		$this->form_validation->set_rules('last_name', 'last name', 'required|alpha'); 
		$this->form_validation->set_rules('date_of_birth', 'date of birth', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'password confirmation', 'matches[password]');
		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors();
		}
		else
		{
			$this->Users_model->register_user();
			$data['errors'] = "You have successfully registered.";	
		}
		echo json_encode($data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/user.php */