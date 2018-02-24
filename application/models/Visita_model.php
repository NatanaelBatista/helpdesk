<?php

/**
 * visita_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Visita_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_visita
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_visita($id = NULL)
	{
		$this->db->join('empresa', 'visita_empresa = empresa_id');

		if($id == NULL)
		{
			$query = $this->db->get('visita');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('visita', array('visita_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * get_visita_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_visita_all($order, $limit, $offset)
	{
		$this->db->join('empresa', 'visita_empresa = empresa_id');

		$this->db->limit($limit, $offset);
		$this->db->order_by('visita_id', $order);
		
		$query = $this->db->get('visita');

		return $query->result();
	}

	/**
	 * set_num_visita_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_visita_all()
	{	
		$query = $this->db->get('visita');

		return $query->num_rows();
	}

	/**
	 * set_visita
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_visita($dados)
	{
		$dados = array(
			'visita_empresa' => $dados['visita_empresa'],
			'visita_data' => $dados['visita_data'],
			'visita_servico' => $dados['visita_servico']
		);

		if($this->db->insert( 'visita', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_visita
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_visita($dados, $id)
	{
		$dados = array(
			'visita_empresa' => $dados['visita_empresa'],
			'visita_data' => $dados['visita_data'],
			'visita_servico' => $dados['visita_servico']
		);
		
		$this->db->where('visita_id', $id);

		if($this->db->update( 'visita', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}