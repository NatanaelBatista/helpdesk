<?php

/**
 * Item_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Item_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_item
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_item($id = NULL)
	{
		if($id == NULL)
		{
			$query = $this->db->get('item');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('item', array('item_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_item
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_item($dados)
	{
		$dados = array(
			'item_nome' => $dados['item_nome'],
			'item_descricao' => $dados['item_descricao']
		);

		if(isset($_POST['item_ativo']))
		{
			$dados['item_ativo'] = 1;
		}
		else
		{
			$dados['item_ativo'] = 0;
		}

		if($this->db->insert( 'item', $dados))
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
	public function update_item($dados, $id)
	{
		$dados = array(
			'item_nome' => $dados['item_nome'],
			'item_descricao' => $dados['item_descricao']
		);

		if(isset($_POST['item_ativo']))
		{
			$dados['item_ativo'] = 1;
		}
		else
		{
			$dados['item_ativo'] = 0;
		}

		$this->db->where('item_id', $id);

		if($this->db->update( 'item', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_item_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_item_all($order, $limit, $offset)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by('item_nome', $order);
		
		$query = $this->db->get('item');

		return $query->result();
	}

	/**
	 * set_num_item_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_item_all()
	{	
		$query = $this->db->get('item');

		return $query->num_rows();
	}

	/**
	 * get_item_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_item_nome_exists($nome, $id)
	{
		$this->db->select('item_nome');

		$this->db->where('item_nome', $nome);
		$this->db->where('item_id <>', $id);

		$query = $this->db->get('item');

		return $query->num_rows();
	}
}