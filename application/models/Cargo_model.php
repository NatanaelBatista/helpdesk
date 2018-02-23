<?php

/**
 * Cargo_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Cargo_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_cargo
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_cargo($id = NULL)
	{
		$this->db->join('setor', 'cargo_setor = setor_id');

		if($id == NULL)
		{
			$query = $this->db->get('cargo');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('cargo', array('cargo_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_cargo
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_cargo($dados)
	{
		$dados = array(
			'cargo_nome' => $dados['cargo_nome'],
			'cargo_setor' => $dados['cargo_setor'],
			'cargo_descricao' => $dados['cargo_descricao']
		);

		if(isset($_POST['cargo_ativo']))
		{
			$dados['cargo_ativo'] = 1;
		}
		else
		{
			$dados['cargo_ativo'] = 0;
		}

		if($this->db->insert( 'cargo', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_cargo
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_cargo($dados, $id)
	{
		$dados = array(
			'cargo_nome' => $dados['cargo_nome'],
			'cargo_setor' => $dados['cargo_setor'],
			'cargo_descricao' => $dados['cargo_descricao']
		);

		if(isset($_POST['cargo_ativo']))
		{
			$dados['cargo_ativo'] = 1;
		}
		else
		{
			$dados['cargo_ativo'] = 0;
		}

		$this->db->where('cargo_id', $id);

		if($this->db->update( 'cargo', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_cargo_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_cargo_nome_exists($nome, $id)
	{
		$this->db->select('cargo_nome');

		$this->db->where('cargo_nome', $nome);
		$this->db->where('cargo_id <>', $id);

		$query = $this->db->get('cargo');

		return $query->num_rows();
	}
}