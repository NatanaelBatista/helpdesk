<?php

/**
 * Incidente_model
 *
 * @package helpdesk
 * @since 0.1
 */
class Incidente_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * get_incidente_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_incidente_all($order, $limit, $offset)
	{
		$this->db->join('usuario', 'incidente_usuario = usuario_id');
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');
		$this->db->join('categoria', 'incidente_categoria = categoria_id');
		$this->db->join('prioridade', 'incidente_prioridade = prioridade_id');
		$this->db->join('situacao', 'incidente_situacao = situacao_id');
		$this->db->join('empresa', 'incidente_empresa = empresa_id');

		if($_SESSION['usuario_acesso'] == 1)
		{
			$this->db->where('incidente_usuario', $_SESSION['usuario_id']);
		}

		$this->db->limit($limit, $offset);
		$this->db->order_by('incidente_id', $order);
		
		$query = $this->db->get('incidente');

		return $query->result();
	}

	/**
	 * set_num_incidente_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_incidente_all()
	{	
		if($_SESSION['usuario_acesso'] == 1)
		{
			$this->db->where('incidente_usuario', $_SESSION['usuario_id']);
		}

		$query = $this->db->get('incidente');

		return $query->num_rows();
	}

	/**
	 * get_usuario_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @param array $dados
	 * @return object
	 */
	public function get_search_incidente_all($order, $limit, $offset, $dados)
	{
		$this->db->join('usuario', 'incidente_usuario = usuario_id');
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');
		$this->db->join('categoria', 'incidente_categoria = categoria_id');
		$this->db->join('prioridade', 'incidente_prioridade = prioridade_id');
		$this->db->join('situacao', 'incidente_situacao = situacao_id');
		$this->db->join('empresa', 'incidente_empresa = empresa_id');

		if($_SESSION['usuario_acesso'] == 1)
		{
			$this->db->where('incidente_usuario', $_SESSION['usuario_id']);
		}

		if($dados['incidente_situacao'] != 0)
		{
			$this->db->where('incidente_situacao', $dados['incidente_situacao']);
		}
		if($dados['incidente_categoria'] != 0)
		{
			$this->db->where('incidente_categoria', $dados['incidente_categoria']);
		}
		if($dados['incidente_prioridade'] != 0)
		{
			$this->db->where('incidente_prioridade', $dados['incidente_prioridade']);
		}

		$this->db->where('incidente_data_a >=', $dados['incidente_data_a']);
		$this->db->where('incidente_data_a <=', $dados['incidente_data_c']);

		$this->db->limit($limit, $offset);
		$this->db->order_by('incidente_id', $order);
		
		$query = $this->db->get('incidente');

		return $query->result();
	}

	/**
	 * set_num_search_usuario_all
	 *
	 * @access public
	 * @param array $dados
	 * @return int
	 */
	public function get_num_search_incidente_all($dados)
	{	
		if($_SESSION['usuario_acesso'] == 1)
		{
			$this->db->where('incidente_usuario', $_SESSION['usuario_id']);
		}

		if($dados['incidente_situacao'] != 0)
		{
			$this->db->where('incidente_situacao', $dados['incidente_situacao']);
		}
		if($dados['incidente_categoria'] != 0)
		{
			$this->db->where('incidente_categoria', $dados['incidente_categoria']);
		}
		if($dados['incidente_prioridade'] != 0)
		{
			$this->db->where('incidente_prioridade', $dados['incidente_prioridade']);
		}

		$this->db->where('incidente_data_a >=', $dados['incidente_data_a']);
		$this->db->where('incidente_data_a <=', $dados['incidente_data_c']);

		$query = $this->db->get('incidente');

		return $query->num_rows();
	}

	/**
	 * get_incident_p_all
	 *
	 * @access public
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return object
	 */
	public function get_incidente_p_all($order, $limit, $offset)
	{
		$this->db->join('usuario', 'incidente_usuario = usuario_id');
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');
		$this->db->join('categoria', 'incidente_categoria = categoria_id');
		$this->db->join('prioridade', 'incidente_prioridade = prioridade_id');
		$this->db->join('situacao', 'incidente_situacao = situacao_id');
		$this->db->join('empresa', 'incidente_empresa = empresa_id');

		$this->db->where('incidente_situacao', 1);
		$this->db->or_where('incidente_situacao', 2);

		$this->db->limit($limit, $offset);
		$this->db->order_by('incidente_id', $order);
		
		$query = $this->db->get('incidente');

		return $query->result();
	}

	/**
	 * set_num_incidente_all
	 *
	 * @access public
	 * @return int
	 */
	public function get_num_incidente_p_all()
	{	
		$this->db->where('incidente_situacao', 1);
		$this->db->or_where('incidente_situacao', 2);

		$query = $this->db->get('incidente');

		return $query->num_rows();
	}

	/**
	 * get_incidente
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_incidente($id = NULL)
	{
		$this->db->join('usuario', 'incidente_usuario = usuario_id');
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');
		$this->db->join('categoria', 'incidente_categoria = categoria_id');
		$this->db->join('prioridade', 'incidente_prioridade = prioridade_id');
		$this->db->join('situacao', 'incidente_situacao = situacao_id');
		$this->db->join('empresa', 'incidente_empresa = empresa_id');

		$this->db->order_by('incidente_id', 'desc');

		if($_SESSION['usuario_acesso'] == 1)
		{
			$this->db->where('incidente_usuario', $_SESSION['usuario_id']);
		}

		if($id == NULL)
		{
			$query = $this->db->get('incidente');
			
			return $query->result();
		}
		else
		{
			$query = $this->db->get_where('incidente', array('incidente_id' => $id));
			
			return $query->result();
		}
	}

	/**
	 * get_incidente_nota
	 *
	 * @access public
	 * @param int $id
	 * @return object
	 */
	public function get_incidente_nota($id = NULL)
	{
		$this->db->join('usuario', 'incidente_nota_usuario = usuario_id');
		$this->db->join('pessoa', 'usuario_pessoa = pessoa_id');

		$this->db->where('incidente_nota_incidente', $id);

		$query = $this->db->get('incidente_nota');
		
		return $query->result();
	}

	/**
	 * set_incidente
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_incidente($dados)
	{
		$dados = array(
			'incidente_categoria' => $dados['incidente_categoria'],
			'incidente_prioridade' => $dados['incidente_prioridade'],
			'incidente_situacao' => 1,
			'incidente_empresa' => $dados['incidente_empresa'],
			//'incidente_anexo' => $dados['incidente_anexo'],
			'incidente_titulo' => $dados['incidente_titulo'],
			'incidente_descricao' => $dados['incidente_descricao'],
			'incidente_data_a' => $dados['incidente_data_a'],
			'incidente_hora_a' => $dados['incidente_hora_a'],
			'incidente_usuario' => $dados['incidente_usuario']
		);

		if($this->db->insert( 'incidente', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * set_incidente_nota
	 *
	 * @access public
	 * @param array $dados
	 * @return boolean
	 */
	public function set_incidente_nota($dados)
	{
		$dados = array(
			'incidente_nota_incidente' => $dados['incidente_nota_incidente'],
			'incidente_nota_usuario' => $dados['incidente_nota_usuario'],
			'incidente_nota_hora' => $dados['incidente_nota_hora'],
			'incidente_nota_descricao' => $dados['incidente_nota_descricao']
		);

		if($this->db->insert( 'incidente_nota', $dados))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_incidente
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_incidente($dados, $id)
	{
		$dados = array(
			'incidente_categoria' => $dados['incidente_categoria'],
			'incidente_prioridade' => $dados['incidente_prioridade'],
			'incidente_situacao' => $dados['incidente_situacao'],
			'incidente_empresa' => $dados['incidente_empresa'],
			'incidente_titulo' => $dados['incidente_titulo'],
			'incidente_descricao' => $dados['incidente_descricao']
		);

		if($dados['incidente_anexo'] != '')
		{
			//$dados['incidente_anexo'] = $dados['incidente_anexo'],
		}

		if(($dados['incidente_situacao'] == 2) || ($dados['incidente_situacao'] == 3))
        {
            date_default_timezone_set('America/Sao_Paulo');

            $dados['incidente_data_c'] = date('Y-m-d');
            $dados['incidente_hora_c'] = date('Y-m-d H:i:s');
        }

		$this->db->where('incidente_id', $id);

		if($this->db->update( 'incidente', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * update_incidente_situacao
	 *
	 * @access public
	 * @param array $dados
	 * @param int $id
	 * @return boolean
	 */
	public function update_incidente_situacao($situacao, $id)
	{
		$dados = array(
			'incidente_situacao' => $situacao
		);

		$this->db->where('incidente_id', $id);

		if($this->db->update( 'incidente', $dados))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_incidente_nome_exists
	 *
	 * @access public
	 * @param string $nome
	 * @param int $id
	 * @return int
	 */
	public function get_incidente_nome_exists($nome, $id)
	{
		$this->db->select('incidente_nome');

		$this->db->where('incidente_nome', $nome);
		$this->db->where('incidente_id <>', $id);

		$query = $this->db->get('incidente');

		return $query->num_rows();
	}
}