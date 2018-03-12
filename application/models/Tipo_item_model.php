<?php

/**
 * Tipo_item_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Tipo_item_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_tipo_item
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_tipo_item($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('tipo_item');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('tipo_item', array('tipo_item_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_tipo_item
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_tipo_item($dados)
	{
		$dados = array(
			'tipo_item_nome' => $dados['tipo_item_nome'],
			'tipo_item_descricao' => $dados['tipo_item_descricao']
		);

		if(isset($_POST['tipo_item_ativo']))
		{
			$dados['tipo_item_ativo'] = 1;
		}
		else
		{
			$dados['tipo_item_ativo'] = 0;
		}

		if($this->db->insert( 'tipo_item', $dados))
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
	public function update_tipo_item($dados, $id)
	{
		$dados = array(
			'tipo_item_nome' => $dados['tipo_item_nome'],
			'tipo_item_descricao' => $dados['tipo_item_descricao']
		);

		if(isset($_POST['tipo_item_ativo']))
		{
			$dados['tipo_item_ativo'] = 1;
		}
		else
		{
			$dados['tipo_item_ativo'] = 0;
		}

		$this->db->where('tipo_item_id', $id);

		if($this->db->update( 'tipo_item', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_tipo_item_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_tipo_item_all($order, $limit, $offset)
	{

		$this->db->limit($limit, $offset);
		$this->db->order_by('tipo_item_nome', $order);
		
		$query = $this->db->get('tipo_item');

		return $query->result();
	}

	/**
	 * set_num_tipo_item_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_tipo_item_all()
	{	
		$query = $this->db->get('tipo_item');

		return $query->num_rows();
	}

	/**
	 * get_tipo_item_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_tipo_item_nome_exists($nome, $id)
	{
		$this->db->select('tipo_item_nome');

		$this->db->where('tipo_item_nome', $nome);
		$this->db->where('tipo_item_id <>', $id);

		$query = $this->db->get('tipo_item');

		return $query->num_rows();
	}
}