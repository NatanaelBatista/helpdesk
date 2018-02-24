<?php

/**
 * Log_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Log_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_log_auditoria
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_log_auditoria()
	{
		$this->db->join('usuario', 'log_auditoria_usuario = usuario_id');
		$this->db->join('operacao', 'log_auditoria_operacao = operacao_id');

		$this->db->order_by('log_auditoria_id', 'desc');

		$query = $this->db->get('log_auditoria');
		
		return $query->result();
	}

	/**
	 * get_log_auditoria_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_log_auditoria_all($order, $limit, $offset)
	{
		$this->db->join('usuario', 'log_auditoria_usuario = usuario_id');
		$this->db->join('operacao', 'log_auditoria_operacao = operacao_id');

		$this->db->limit($limit, $offset);
		$this->db->order_by('log_auditoria_id', $order);
		
		$query = $this->db->get('log_auditoria');

		return $query->result();
	}

	/**
	 * set_num_log_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_log_auditoria_all()
	{	
		$query = $this->db->get('log_auditoria');

		return $query->num_rows();
	}

	/**
	 * set_log_auditoria
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_log_auditoria($dados)
	{
		$dados = array(
			'log_auditoria_data' => $dados['log_auditoria_data'],
			'log_auditoria_hora' => $dados['log_auditoria_hora'],
			'log_auditoria_usuario' => $dados['log_auditoria_usuario'],
			'log_auditoria_operacao' => $dados['log_auditoria_operacao'],
			'log_auditoria_historico' => $dados['log_auditoria_historico']
		);

		if($this->db->insert( 'log_auditoria', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}
}