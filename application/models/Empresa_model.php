<?php

/**
 * Empresa_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Empresa_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_empresa
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_empresa($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('empresa');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('empresa', array('empresa_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_empresa
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_empresa($dados)
	{
		$dados = array(
			'empresa_nome' => $dados['empresa_nome'],
			'empresa_descricao' => $dados['empresa_descricao']
		);

		if(isset($_POST['empresa_ativo']))
		{
			$dados['empresa_ativo'] = 1;
		}
		else
		{
			$dados['empresa_ativo'] = 0;
		}

		if($this->db->insert( 'empresa', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Update_empresa
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_empresa($dados, $id)
	{
		$dados = array(
			'empresa_nome' => $dados['empresa_nome'],
			'empresa_descricao' => $dados['empresa_descricao']
		);

		if(isset($_POST['empresa_ativo']))
		{
			$dados['empresa_ativo'] = 1;
		}
		else
		{
			$dados['empresa_ativo'] = 0;
		}

		$this->db->where('empresa_id', $id);

		if($this->db->update( 'empresa', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_empresa_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_empresa_nome_exists($nome, $id)
	{
		$this->db->select('empresa_nome');

		$this->db->where('empresa_nome', $nome);
		$this->db->where('empresa_id <>', $id);

		$query = $this->db->get('empresa');

		return $query->num_rows();
	}
}