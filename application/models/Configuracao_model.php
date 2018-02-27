<?php

/**
 * Configuracao_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Configuracao_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_usuario_senha
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_usuario_senha($id = NULL)
	{
		$this->db->select('usuario_senha');

		$query = $this->db->get_where('usuario', array('usuario_id' => $id));
		
		return $query->result();
	}

	/**
	 * update_senha
	 *
	 * @access public
	 * @param string $senha
	 * @param int $id
	 * @return boolean
	 */
	public function update_senha($senha, $id)
	{
		$this->db->where('usuario_id', $id);

		$dados['usuario_senha'] = $senha;

		if($this->db->update( 'usuario', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}