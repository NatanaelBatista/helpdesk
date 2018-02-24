<?php

/**
 * Pessoa_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Pessoa_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_pessoa
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_pessoa($id = NULL)
	{
		$this->db->join('cargo', 'pessoa_cargo = cargo_id');
		$this->db->join('setor', 'cargo_setor = setor_id');
		$this->db->join('empresa', 'pessoa_empresa = empresa_id');

		if($id == NULL)
		{
			$this->db->order_by('pessoa_p_nome', 'asc');

			$query = $this->db->get('pessoa');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('pessoa', array('pessoa_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * get_usuario_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_pessoa_all($order, $limit, $offset)
	{
		$this->db->join('cargo', 'pessoa_cargo = cargo_id');
		$this->db->join('setor', 'cargo_setor = setor_id');
		$this->db->join('empresa', 'pessoa_empresa = empresa_id');

		$this->db->limit($limit, $offset);
		$this->db->order_by('pessoa_p_nome', $order);
		
		$query = $this->db->get('pessoa');

		return $query->result();
	}

	/**
	 * set_num_pessoa_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_pessoa_all()
	{	
		$query = $this->db->get('pessoa');

		return $query->num_rows();
	}

	/**
	 * set_pessoa
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_pessoa($dados)
	{
		$dados = array(
			'pessoa_p_nome' => $dados['pessoa_p_nome'],
			'pessoa_sobrenome' => $dados['pessoa_sobrenome'],
			'pessoa_cargo' => $dados['pessoa_cargo'],
			'pessoa_empresa' => $dados['pessoa_empresa']
		);

		if(isset($_POST['pessoa_ativo']))
		{
			$dados['pessoa_ativo'] = 1;
		}
		else
		{
			$dados['pessoa_ativo'] = 0;
		}

		if($this->db->insert( 'pessoa', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_pessoa
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_pessoa($dados, $id)
	{
		$dados = array(
			'pessoa_p_nome' => $dados['pessoa_p_nome'],
			'pessoa_sobrenome' => $dados['pessoa_sobrenome'],
			'pessoa_cargo' => $dados['pessoa_cargo'],
			'pessoa_empresa' => $dados['pessoa_empresa']
		);

		if(isset($_POST['pessoa_ativo']))
		{
			$dados['pessoa_ativo'] = 1;
		}
		else
		{
			$dados['pessoa_ativo'] = 0;
		}

		$this->db->where('pessoa_id', $id);

		if($this->db->update( 'pessoa', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_pessoa_nome_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_pessoa_nome_exists($nome, $id)
	{
		$this->db->select('pessoa_nome');

		$this->db->where('pessoa_nome', $nome);
		$this->db->where('pessoa_id <>', $id);

		$query = $this->db->get('pessoa');

		return $query->num_rows();
	}
}