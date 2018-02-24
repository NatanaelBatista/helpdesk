<?php

/**
 * Acesso_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Acesso_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Seleciona todos os dados na tabela
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_acesso($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('acesso');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('acesso', array('acesso_id' => $id));
			
			return $query->result();
		}
	}
}