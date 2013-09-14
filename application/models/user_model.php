<?php

class User_model extends CI_Model {
	var $users;

    function __construct()
    {
        parent::__construct();
        $this->users = $this->get_users();
    }

    private function get_users()
    {
		$query = $this->db->get('users');
		return $query->result();
    }

	public function register_user()
	{
		if (count($this->get_users()) == 0)
		{
			$this->db->set('admin_level', 9);
		}
		else
		{
			$this->db->set('admin_level', 7);
		}
		$new_user = $this->input->post();
		$new_user['password'] = $this->encrypt->sha1($new_user['password']);
		$user_data = array(
			'first_name' => $new_user['first_name'],
			'last_name' => $new_user['last_name'],
			'email' => $new_user['email'],
			'date_of_birth' => $new_user['date_of_birth'],
			'password' => $new_user['password']
			);
		$this->db->set($user_data);
		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->insert('users');
	}

	function login_user()
	{
		$this->db->where(array('email' => $this->input->post('email')));
		$this->db->where(array('password' => $this->encrypt->sha1($this->input->post('password'))));
	
		$users = $this->db->get('users');
		if ($users->num_rows()>0)
		{
			$data = $users->first_row();
			return $data;
		}
		else
		{
			return false;
		}
	}
	// public function save_worksheet()
	// {
		
	// 	$this->Worksheets_model->save_worksheet($this->input->post('worksheet_id'));

	// }


	public function get_saved_worksheets($user_id)
	{
				
		$query = $this->db->query("SELECT worksheets.id, worksheets.topic_id, worksheets.user_id, worksheets.mood, DATE_FORMAT(worksheets.created_at, '%M %d, %Y') as created_at, topics.name as topic_name FROM worksheets INNER JOIN topics on worksheets.topic_id=topics.id WHERE user_id=".$user_id." AND saved=1 ORDER BY worksheets.created_at DESC;");
		return $query->result();
		
	}

	public function get_saved_worksheet_by_id($worksheet_id)
	{
		$query = $this->db->query("SELECT * from answers LEFT JOIN questions on answers.question_id=questions.id LEFT JOIN questions_has_topics on questions.id=questions_has_topics.question_id WHERE answers.worksheet_id=".$worksheet_id." GROUP BY answers.id ORDER BY questions_has_topics.order;");
		return $query->result();
	}



}