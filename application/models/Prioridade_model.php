<?php

/**
 * Prioridade_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Prioridade_model extends CI_Model {

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
	public function get_prioridade($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('prioridade');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('prioridade', array('prioridade_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_prioridade
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_prioridade($dados)
	{
		$dados = array(
			'prioridade_nome' => $dados['prioridade_nome'],
			'prioridade_descricao' => $dados['prioridade_descricao']
		);

		if(isset($_POST['prioridade_ativo']))
		{
			$dados['prioridade_ativo'] = 1;
		}
		else
		{
			$dados['prioridade_ativo'] = 0;
		}

		if($this->db->insert( 'prioridade', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_prioridade
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_prioridade($dados, $id)
	{
		$dados = array(
			'prioridade_nome' => $dados['prioridade_nome'],
			'prioridade_descricao' => $dados['prioridade_descricao']
		);

		if(isset($_POST['prioridade_ativo']))
		{
			$dados['prioridade_ativo'] = 1;
		}
		else
		{
			$dados['prioridade_ativo'] = 0;
		}

		$this->db->where('prioridade_id', $id);

		if($this->db->update( 'prioridade', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_prioridade_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_prioridade_nome_exists($nome, $id)
	{
		$this->db->select('prioridade_nome');

		$this->db->where('prioridade_nome', $nome);
		$this->db->where('prioridade_id <>', $id);

		$query = $this->db->get('prioridade');

		return $query->num_rows();
	}
}