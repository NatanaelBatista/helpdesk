<?php

/**
 * Usuario_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Usuario_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_usuario
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_usuario($id = NULL)
	{
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');
		$this->db->join('acesso', 'usuario_acesso = acesso_id');

		if($id == NULL)
		{	
			$this->db->order_by('pessoa_p_nome', 'asc');

			$query = $this->db->get('usuario');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('usuario', array('usuario_id' => $id));
			
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
	public function get_usuario_all($order, $limit, $offset)
	{
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');
		$this->db->join('acesso', 'usuario_acesso = acesso_id');

		$this->db->limit($limit, $offset);
		$this->db->order_by('pessoa_p_nome', $order);
		
		$query = $this->db->get('usuario');

		return $query->result();
	}

	/**
	 * get_num_usuario_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_usuario_all()
	{	
		$query = $this->db->get('usuario');

		return $query->num_rows();
	}

	/**
	 * set_usuario
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_usuario($dados)
	{
		$dados = array(
			'usuario_pessoa' => $dados['usuario_pessoa'],
			'usuario_acesso' => $dados['usuario_acesso'],
			'usuario_email' => $dados['usuario_email'],
			'usuario_senha' => $dados['usuario_senha']
		);

		if(isset($_POST['usuario_ativo']))
		{
			$dados['usuario_ativo'] = 1;
		}
		else
		{
			$dados['usuario_ativo'] = 0;
		}

		if($this->db->insert( 'usuario', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_usuario
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_usuario($dados, $id)
	{
		$dados = array(
			'usuario_pessoa' => $dados['usuario_pessoa'],
			'usuario_acesso' => $dados['usuario_acesso'],
			'usuario_email' => $dados['usuario_email']
		);

		if(isset($_POST['usuario_ativo']))
		{
			$dados['usuario_ativo'] = 1;
		}
		else
		{
			$dados['usuario_ativo'] = 0;
		}

		$this->db->where('usuario_id', $id);

		if($this->db->update( 'usuario', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_usuario_email_exists
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $email
	 * @param int $id
	 * @return int
	 */
	public function get_usuario_email_exists($email, $id)
	{
		$this->db->select('usuario_email');

		$this->db->where('usuario_email', $email);
		$this->db->where('usuario_id <>', $id);

		$query = $this->db->get('usuario');

		return $query->num_rows();
	}

	/**
	 * get_usuario_email
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $email
	 * @return object
	 */
	public function get_usuario_email($email)
	{
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');

		$this->db->select('usuario_id');
		$this->db->select('usuario_senha');
		$this->db->select('usuario_acesso');
		$this->db->select('pessoa_p_nome');
		$this->db->select('pessoa_empresa');

		$query = $this->db->get_where('usuario', array('usuario_email' => $email));

		return $query->result();
	}

	/**
	 * redefinir_senha
	 *
	 * Verifica se existe uma ocorrência com o valor especificado
	 *
	 * @access public
	 * @param string $email
	 * @param int $id
	 * @return int
	 */
	public function redefinir_senha($senha, $id)
	{
		$dados = array(
			'usuario_senha' => $senha
		);

		$this->db->where('usuario_id', $id);

		if($this->db->update( 'usuario', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}