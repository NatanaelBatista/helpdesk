<?php

/**
 * Acao_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Acao_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_acao
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_acao($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('acao');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('acao', array('acao_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_acao
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_acao($dados)
	{
		$dados = array(
			'acao_nome' => $dados['acao_nome'],
			'acao_descricao' => $dados['acao_descricao']
		);

		if(isset($_POST['acao_ativo']))
		{
			$dados['acao_ativo'] = 1;
		}
		else
		{
			$dados['acao_ativo'] = 0;
		}

		if($this->db->insert( 'acao', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_gategoria
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_acao($dados, $id)
	{
		$dados = array(
			'acao_nome' => $dados['acao_nome'],
			'acao_descricao' => $dados['acao_descricao']
		);

		if(isset($_POST['acao_ativo']))
		{
			$dados['acao_ativo'] = 1;
		}
		else
		{
			$dados['acao_ativo'] = 0;
		}

		$this->db->where('acao_id', $id);

		if($this->db->update( 'acao', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_acao_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_acao_nome_exists($nome, $id)
	{
		$this->db->select('acao_nome');

		$this->db->where('acao_nome', $nome);
		$this->db->where('acao_id <>', $id);

		$query = $this->db->get('acao');

		return $query->num_rows();
	}
}