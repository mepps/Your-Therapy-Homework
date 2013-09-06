<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Worksheets extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Worksheets_model');
		$this->view_data = array();
	}

	public function worksheet($topic_id)
	{
		$data['topics'] = $this->Worksheets_model->topics;
		$data['topic_selected'] = $this->Worksheets_model->get_topic_by_id($topic_id)[0];
		$data['questions'] = $this->Worksheets_model->get_questions_by_topic($topic_id); 
		$this->load->view('worksheet', $data);
	}

	public function all_topics()
	{
		$data['topics'] = $this->Worksheets_model->topics;
		$this->load->view('topics', $data);
	}

	public function view_saved($user_id)
	{
		$data['topics'] = $this->Worksheets_model->topics;
		$data['$user_id'] = $user_id;
		$this->load->view('saved_worksheets', $data);
	}

	public function process_worksheet()
	{
		unset($responses);
		$responses = $this->input->post();
		foreach ($responses as $keyword => $word)
		{
			foreach ($responses as $id_number => $response)
			{
				if ($keyword == "keyword_" . $id_number)
				{
					$data['answers'][] = "<strong>" . $word . "</strong>: " . $response;
					$this->view_data[]  = array($id_number => $response);
				}
			}
		}
		echo json_encode($data);
	}

	public function save_worksheet()
	{
		var_dump($this->view_data);
		$this->Worksheets_model->save_worksheets($this->view_data);

	}
}

/* End of file home.php */
/* Location: ./application/controllers/worksheets.php */