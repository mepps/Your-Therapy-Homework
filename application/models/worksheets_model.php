<?php

class Worksheets_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->topics = $this->get_topics();
    }

    private function get_topics()
    {
    	$query = $this->db->get('topics');
		return $query->result();
    }

   public function get_topic_by_id($id)
   {
   		$query = $this->db->get_where('topics', array('id' => $id));
   		return $query->result();
   }

    public function get_questions()
    { 

    	$query = $this->db->query('SELECT * FROM questions LEFT JOIN questions_has_topics on questions.id=questions_has_topics.question_id;');
		return $query->result();
    }

   public function get_questions_by_topic($topic_id)
   {
    	$query = $this->db->query('SELECT * FROM questions LEFT JOIN questions_has_topics on questions.id=questions_has_topics.question_id WHERE questions_has_topics.topic_id=' . $topic_id . ' ORDER BY questions_has_topics.order;');
   		return $query->result();
   }

   public function create_worksheet($mood, $topic_id)
   {
      if (isset($this->session->userdata('user')->id))
      {
        $user_id = $this->session->userdata('user')->id;
      }
      else
      {
        $user_id = 0;
      }
      $this->db->set('user_id', $user_id);
      $this->db->set('mood', $mood);
      $this->db->set('topic_id', $topic_id);
      $this->db->set('created_at', 'NOW()', FALSE);
      $this->db->insert('worksheets');
      $result = $this->db->query("SELECT id FROM worksheets ORDER BY created_at DESC;");
      $ids = $result->result();
      $response_id = $ids[0]->id;
      return $response_id;
   }
    public function save_worksheet($worksheet_id)
    {
      $this->db->query("UPDATE worksheets SET saved=1 WHERE id=".$worksheet_id.";");

    }

   public function save_response($response, $question_id, $worksheet_id)
   {
      $response_data = array(
        'content' => $response,
        'question_id' => $question_id,
        'worksheet_id' => $worksheet_id
        );
      $this->db->set($response_data);
      $this->db->set('created_at', 'NOW()', FALSE);
      $this->db->insert('answers');
      $result = $this->db->query("SELECT id FROM answers ORDER BY created_at DESC;");
      $ids = $result->result();
      $response_id = $ids[0]->id;
      return $response_id;
    }

	public function insert_topic_get_id()
	{
		$new_topic = $this->input->post();
		$topic_data = array(
			'name' => $new_topic['topic_name'],
			'definition' => $new_topic['definition'],
			'emergency' => $new_topic['emergency'],
			'resources' => $new_topic['resources'],
			);
		$this->db->set($topic_data);
		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->insert('topics');
    $result = $this->db->query("SELECT id FROM topics ORDER BY created_at DESC;");
    $ids = $result->result();
    return $ids[0]->id;

	}

  function insert_question()
  {
    $new_question = $this->input->post();
    $question_data = array(
      'question' => $new_question['question'],
      'keyword' => $new_question['keyword'],
      );
    $this->db->set($question_data);
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->insert('questions');
    $result = $this->db->query("SELECT id FROM questions ORDER BY created_at DESC;");
    $ids = $result->result();
    $question_id = $ids[0]->id;

    $question_topic_data = array(
        'question_id' => $question_id,
        'topic_id' => $new_question['topic_id'],
        'order' => $new_question['order']
      );
    $this->db->set($question_topic_data);
    $this->db->insert('questions_has_topics');
  }






  

}