<?php

/**
 * Situacao_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Situacao_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_situacao
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_situacao($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('situacao');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('situacao', array('situacao_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_situacao
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_situacao($dados)
	{
		$dados = array(
			'situacao_nome' => $dados['situacao_nome'],
			'situacao_cor' => $dados['situacao_cor'],
			'situacao_descricao' => $dados['situacao_descricao']
		);

		if(isset($_POST['situacao_ativo']))
		{
			$dados['situacao_ativo'] = 1;
		}
		else
		{
			$dados['situacao_ativo'] = 0;
		}

		if($this->db->insert( 'situacao', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_situacao
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_situacao($dados, $id)
	{
		$dados = array(
			'situacao_nome' => $dados['situacao_nome'],
			'situacao_cor' => $dados['situacao_cor'],
			'situacao_descricao' => $dados['situacao_descricao']
		);

		if(isset($_POST['situacao_ativo']))
		{
			$dados['situacao_ativo'] = 1;
		}
		else
		{
			$dados['situacao_ativo'] = 0;
		}

		$this->db->where('situacao_id', $id);

		if($this->db->update( 'situacao', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_situacao_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_situacao_nome_exists($nome, $id)
	{
		$this->db->select('situacao_nome');

		$this->db->where('situacao_nome', $nome);
		$this->db->where('situacao_id <>', $id);

		$query = $this->db->get('situacao');

		return $query->num_rows();
	}
}