<?php

/**
 * Modulo_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Modulo_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_modulo
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_modulo($id = NULL)
	{
		$this->db->join('grupo_modulo', 'modulo_grupo = grupo_modulo_id');

		if($id == NULL)
		{
			$query = $this->db->get('modulo');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('modulo', array('modulo_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_modulo
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_modulo($dados)
	{
		$dados = array(
			'modulo_nome' => $dados['modulo_nome'],
			'modulo_grupo' => $dados['modulo_grupo'],
			'modulo_tabela' => $dados['modulo_tabela'],
			'modulo_descricao' => $dados['modulo_descricao']
		);

		if(isset($_POST['modulo_ativo']))
		{
			$dados['modulo_ativo'] = 1;
		}
		else
		{
			$dados['modulo_ativo'] = 0;
		}

		if($this->db->insert( 'modulo', $dados))
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
	public function update_modulo($dados, $id)
	{
		$dados = array(
			'modulo_nome' => $dados['modulo_nome'],
			'modulo_grupo' => $dados['modulo_grupo'],
			'modulo_tabela' => $dados['modulo_tabela'],
			'modulo_descricao' => $dados['modulo_descricao']
		);

		if(isset($_POST['modulo_ativo']))
		{
			$dados['modulo_ativo'] = 1;
		}
		else
		{
			$dados['modulo_ativo'] = 0;
		}

		$this->db->where('modulo_id', $id);

		if($this->db->update( 'modulo', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_modulo_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_modulo_all($order, $limit, $offset)
	{
		$this->db->join('grupo_modulo', 'modulo_grupo = grupo_modulo_id');

		$this->db->limit($limit, $offset);
		$this->db->order_by('modulo_nome', $order);
		
		$query = $this->db->get('modulo');

		return $query->result();
	}

	/**
	 * set_num_modulo_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_modulo_all()
	{	
		$query = $this->db->get('modulo');

		return $query->num_rows();
	}

	/**
	 * get_modulo_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_modulo_nome_exists($nome, $id)
	{
		$this->db->select('modulo_nome');

		$this->db->where('modulo_nome', $nome);
		$this->db->where('modulo_id <>', $id);

		$query = $this->db->get('modulo');

		return $query->num_rows();
	}
}