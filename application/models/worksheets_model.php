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

   public function save_worksheets($input)
   {
   		var_dump($input);
   }
}