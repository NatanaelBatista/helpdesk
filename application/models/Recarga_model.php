<?php

/**
 * Recarga_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Recarga_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_impressora_recarga
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_impressora_recarga($id = NULL)
	{
		$this->db->join('impressora', 'impressora_recarga_impressora = impressora_id');

		if($id == NULL)
		{
			$query = $this->db->get('impressora_recarga');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('impressora_recarga', array('impressora_recarga_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * get_impressora_recarga_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_impressora_recarga_all($order, $limit, $offset)
	{
		$this->db->join('impressora', 'impressora_recarga_impressora = impressora_id');

		$this->db->limit($limit, $offset);
		$this->db->order_by('impressora_recarga_id', $order);
		
		$query = $this->db->get('impressora_recarga');

		return $query->result();
	}

	/**
	 * set_num_impressora_recarga_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_impressora_recarga_all()
	{	
		$query = $this->db->get('impressora_recarga');

		return $query->num_rows();
	}

	/**
	 * set_impressora_recarga
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_impressora_recarga($dados)
	{
		$dados = array(
			'impressora_recarga_impressora' => $dados['impressora_recarga_impressora'],
			'impressora_recarga_data' => $dados['impressora_recarga_data'],
			'impressora_recarga_obs' => $dados['impressora_recarga_obs']
		);

		if($this->db->insert( 'impressora_recarga', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_impressora_recarga
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_impressora_recarga($dados, $id)
	{
		$dados = array(
			'impressora_recarga_impressora' => $dados['impressora_recarga_impressora'],
			'impressora_recarga_data' => $dados['impressora_recarga_data'],
			'impressora_recarga_obs' => $dados['impressora_recarga_obs']
		);
		
		$this->db->where('impressora_recarga_id', $id);

		if($this->db->update( 'impressora_recarga', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}