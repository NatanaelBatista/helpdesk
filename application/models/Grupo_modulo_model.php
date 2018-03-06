<?php

/**
 * Grupo_Modulo_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Grupo_Modulo_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_grupo_modulo
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_grupo_modulo($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('grupo_modulo');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('grupo_modulo', array('grupo_modulo_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_grupo_modulo
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_grupo_modulo($dados)
	{
		$dados = array(
			'grupo_modulo_nome' => $dados['grupo_modulo_nome'],
			'grupo_modulo_descricao' => $dados['grupo_modulo_descricao']
		);

		if(isset($_POST['grupo_modulo_ativo']))
		{
			$dados['grupo_modulo_ativo'] = 1;
		}
		else
		{
			$dados['grupo_modulo_ativo'] = 0;
		}

		if($this->db->insert( 'grupo_modulo', $dados))
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
	public function update_grupo_modulo($dados, $id)
	{
		$dados = array(
			'grupo_modulo_nome' => $dados['grupo_modulo_nome'],
			'grupo_modulo_descricao' => $dados['grupo_modulo_descricao']
		);

		if(isset($_POST['grupo_modulo_ativo']))
		{
			$dados['grupo_modulo_ativo'] = 1;
		}
		else
		{
			$dados['grupo_modulo_ativo'] = 0;
		}

		$this->db->where('grupo_modulo_id', $id);

		if($this->db->update( 'grupo_modulo', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_grupo_modulo_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_grupo_modulo_all($order, $limit, $offset)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by('grupo_modulo_nome', $order);
		
		$query = $this->db->get('grupo_modulo');

		return $query->result();
	}

	/**
	 * set_num_grupo_modulo_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_grupo_modulo_all()
	{	
		$query = $this->db->get('grupo_modulo');

		return $query->num_rows();
	}

	/**
	 * get_grupo_modulo_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_grupo_modulo_nome_exists($nome, $id)
	{
		$this->db->select('grupo_modulo_nome');

		$this->db->where('grupo_modulo_nome', $nome);
		$this->db->where('grupo_modulo_id <>', $id);

		$query = $this->db->get('grupo_modulo');

		return $query->num_rows();
	}
}