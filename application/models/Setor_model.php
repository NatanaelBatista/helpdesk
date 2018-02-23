<?php

/**
 * Setor_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Setor_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_setor
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_setor($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('setor');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('setor', array('setor_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_setor
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_setor($dados)
	{
		$dados = array(
			'setor_nome' => $dados['setor_nome'],
			'setor_descricao' => $dados['setor_descricao']
		);

		if(isset($_POST['setor_ativo']))
		{
			$dados['setor_ativo'] = 1;
		}
		else
		{
			$dados['setor_ativo'] = 0;
		}

		if($this->db->insert( 'setor', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_setor
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_setor($dados, $id)
	{
		$dados = array(
			'setor_nome' => $dados['setor_nome'],
			'setor_descricao' => $dados['setor_descricao']
		);

		if(isset($_POST['setor_ativo']))
		{
			$dados['setor_ativo'] = 1;
		}
		else
		{
			$dados['setor_ativo'] = 0;
		}

		$this->db->where('setor_id', $id);

		if($this->db->update( 'setor', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_setor_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_setor_nome_exists($nome, $id)
	{
		$this->db->select('setor_nome');

		$this->db->where('setor_nome', $nome);
		$this->db->where('setor_id <>', $id);

		$query = $this->db->get('setor');

		return $query->num_rows();
	}
}