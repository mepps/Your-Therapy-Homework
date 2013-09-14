<?php 
require_once('main.php');

class Worksheets extends Main {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Worksheet_model');
		$this->load->model('User_model');
	}

	public function worksheet($topic_id)
	{
		$this->data['topics'] = $this->Worksheet_model->topics;
		$this->data['topic_selected'] = $this->Worksheet_model->get_topic_by_id($topic_id)[0];
		$this->data['questions'] = $this->Worksheet_model->get_questions_by_topic($topic_id); 
		$this->load->view('worksheet', $this->data);
	}

	public function all_topics()
	{
		$this->data['topics'] = $this->Worksheet_model->topics;
		$this->load->view('topics', $this->data);
	}

	public function view_all_saved($user_id)
	{
		if ($this->data['logged_in'])
		{
			$this->data['topics'] = $this->Worksheet_model->topics;
			$this->data['$user_id'] = $user_id;
			$this->data['worksheets'] = $this->User_model->get_saved_worksheets($user_id);
			$this->load->view('saved_worksheets', $this->data);
		}
		else
		{
			redirect('/');
		}
	}

	public function view_saved($worksheet_id)
	{
		$this->data['worksheet_answers'] = $this->User_model->get_saved_worksheet_by_id($worksheet_id);
		$this->load->view('view_saved_worksheet', $this->data);
	}

	public function new_worksheet()
	{
		$worksheet_data = $this->input->post();
		$data['id'] = $this->Worksheet_model->create_worksheet($worksheet_data['mood'], $worksheet_data['topic_id']);
		echo json_encode($data);
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
					$data[]  = array($id_number => $response);
					$this->Worksheet_model->save_response($response, $id_number, $responses['worksheet_id']);				
				}
			}
		}
		echo json_encode($data);
	}

	public function user_save_worksheet()
	{
		
		$this->Worksheet_model->save_worksheet($this->input->post('worksheet_id'));

	}
}


/* End of file home.php */
/* Location: ./application/controllers/worksheets.php */