<?php

/**
 * Categoria_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Categoria_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_categoria
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_categoria($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('categoria');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('categoria', array('categoria_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_categoria
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_categoria($dados)
	{
		$dados = array(
			'categoria_nome' => $dados['categoria_nome'],
			'categoria_descricao' => $dados['categoria_descricao']
		);

		if(isset($_POST['categoria_ativo']))
		{
			$dados['categoria_ativo'] = 1;
		}
		else
		{
			$dados['categoria_ativo'] = 0;
		}

		if($this->db->insert( 'categoria', $dados))
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
	public function update_categoria($dados, $id)
	{
		$dados = array(
			'categoria_nome' => $dados['categoria_nome'],
			'categoria_descricao' => $dados['categoria_descricao']
		);

		if(isset($_POST['categoria_ativo']))
		{
			$dados['categoria_ativo'] = 1;
		}
		else
		{
			$dados['categoria_ativo'] = 0;
		}

		$this->db->where('categoria_id', $id);

		if($this->db->update( 'categoria', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_categoria_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_categoria_nome_exists($nome, $id)
	{
		$this->db->select('categoria_nome');

		$this->db->where('categoria_nome', $nome);
		$this->db->where('categoria_id <>', $id);

		$query = $this->db->get('categoria');

		return $query->num_rows();
	}
}