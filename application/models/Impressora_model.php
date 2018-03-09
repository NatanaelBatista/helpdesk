<?php

/**
 * Impressora_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Impressora_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_impressora
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_impressora($id = NULL)
	{
		//$this->db->join('grupo_impressora', 'impressora_grupo = grupo_impressora_id');

		if($id == NULL)
		{
			$query = $this->db->get('impressora');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('impressora', array('impressora_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * set_impressora
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_impressora($dados)
	{
		$dados = array(
			'impressora_nome' => $dados['impressora_nome'],
			'impressora_empresa' => $dados['impressora_empresa'],
			'impressora_modelo' => $dados['impressora_modelo'],
			'impressora_descricao' => $dados['impressora_descricao']
		);

		if(isset($_POST['impressora_ativo']))
		{
			$dados['impressora_ativo'] = 1;
		}
		else
		{
			$dados['impressora_ativo'] = 0;
		}

		if($this->db->insert( 'impressora', $dados))
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
	public function update_impressora($dados, $id)
	{
		$dados = array(
			'impressora_nome' => $dados['impressora_nome'],
			'impressora_empresa' => $dados['impressora_empresa'],
			'impressora_modelo' => $dados['impressora_modelo'],
			'impressora_descricao' => $dados['impressora_descricao']
		);

		if(isset($_POST['impressora_ativo']))
		{
			$dados['impressora_ativo'] = 1;
		}
		else
		{
			$dados['impressora_ativo'] = 0;
		}

		$this->db->where('impressora_id', $id);

		if($this->db->update( 'impressora', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_impressora_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_impressora_all($order, $limit, $offset)
	{
		$this->db->join('empresa', 'impressora_empresa = empresa_id');

		$this->db->limit($limit, $offset);
		$this->db->order_by('impressora_nome', $order);
		
		$query = $this->db->get('impressora');

		return $query->result();
	}

	/**
	 * set_num_impressora_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_impressora_all()
	{	
		$query = $this->db->get('impressora');

		return $query->num_rows();
	}

	/**
	 * get_impressora_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_impressora_nome_exists($nome, $id)
	{
		$this->db->select('impressora_nome');

		$this->db->where('impressora_nome', $nome);
		$this->db->where('impressora_id <>', $id);

		$query = $this->db->get('impressora');

		return $query->num_rows();
	}
}