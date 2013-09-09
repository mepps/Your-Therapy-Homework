<?php 
require_once('main.php');

class Worksheets extends Main {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Worksheets_model');
		$this->load->model('Users_model');
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

	public function view_all_saved($user_id)
	{
		$data['topics'] = $this->Worksheets_model->topics;
		$data['$user_id'] = $user_id;
		$data['worksheets'] = $this->Users_model->get_saved_worksheets($user_id);
		$this->load->view('saved_worksheets', $data);
	}

	public function view_saved($worksheet_id)
	{
		$data['worksheet_answers'] = $this->Users_model->get_saved_worksheet_by_id($worksheet_id);
		$this->load->view('view_saved_worksheet', $data);
	}

	public function new_worksheet()
	{
		$worksheet_data = $this->input->post();
		$data['id'] = $this->Worksheets_model->create_worksheet($worksheet_data['mood'], $worksheet_data['topic_id']);
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
					$this->view_data[]  = array($id_number => $response);
					$this->Worksheets_model->save_response($response, $id_number, $responses['worksheet_id']);				
				}
			}
		}
		echo json_encode($data);
	}

	public function user_save_worksheet()
	{
		
		$this->Worksheets_model->save_worksheet($this->input->post('worksheet_id'));

	}
}


/* End of file home.php */
/* Location: ./application/controllers/worksheets.php */