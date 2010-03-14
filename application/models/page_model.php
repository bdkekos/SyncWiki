<?php

class Page_model extends Model {
	
	var $title = '';
	var $id = 0;
	var $views = 0;
	var $locked = 0;
	var $rev_id = 0;
	var $text_id = 0;
	var $text = '';
	
	function load_query()
	{
		$this->db->select('page.*, page_text.*, page_revision.pagerev_id');
		$this->db->from('page AS page');
		$this->db->join('page_revision AS page_revision', 'page.page_latest = page_revision.pagerev_id');
		$this->db->join('page_text AS page_text', 'page_revision.pagerev_text = page_text.pagetext_id', 'left');
		$this->db->limit(1);
	}
	
	/**
	 * Loads the page by title from the database
	 * 
	 * @access public
	 * @param str $page_title
	 * @return query
	 */
	function load_page($page_title)
	{
		$page_title = $this->db->escape_str($page_title);
		$this->load_query();
		$this->db->where('page_title', $page_title);
		$query = $this->db->get();
		return $this->load($query, $page_title);
	}
	
	function load_id($page_id)
	{
		$this->load_query();
		$this->db->where('page_id', $page_id);
		$query = $this->db->get();
		return $this->load($query);
	}
	
	function load(&$query, $title = '')
	{
		if( $query->num_rows() == 0 )
		{
			return false;
		}
		
		$row = $query->row();
		$this->title	= $row->page_title;
		$this->id		= $row->page_id;
		$this->views	= $row->page_views;
		$this->locked	= $row->page_locked;
		$this->rev_id	= $row->pagerev_id;
		$this->text_id	= $row->pagetext_id;
		$this->text		= $row->pagetext_text;
		
		return $query;
	}
	
	function edit($text, $comment = '', $create = false)
	{
		$page_text = array(
			'pagetext_text' => $text
		);
		$this->db->insert('page_text', $page_text);
		$this->text_id = $this->db->insert_id();
		
		$page_revision = array(
			'pagerev_page' => $this->id,
			'pagerev_text' => $this->text_id,
			'pagerev_comment' => $comment,
			'pagerev_userid' => (($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : '0' ),
			'pagerev_userip' => $this->input->ip_address(),
			'pagerev_timestamp' => time(),
			'pagerev_type' => ($create) ? 'create' : 'edit'
		);
		$this->db->insert('page_revision', $page_revision);
		$this->rev_id = $this->db->insert_id();
		
		$page = array(
			'page_latest' => $this->rev_id
		);
		$this->db->where('page_id', $this->id);
		$this->db->update('page', $page);
	}
	
	function create($title, $text, $comment = '')
	{
		$page = array(
			'page_title' => $title,
		);
		$this->db->insert('page', $page);
		$this->id = $this->db->insert_id();
		$this->edit($text, $comment, true);
	}
	
	function update_protection($level)
	{
		$page = array(
			'page_locked' => $level
		);
		$this->db->where('page_id', $this->id);
		$this->db->update('page', $page);
		
		$page_revision = array(
			'pagerev_page' => $this->id,
			'pagerev_text' => $this->text_id,
			'pagerev_comment' => 'Protection level changed (Level '.$this->locked.' -> '.$level.' )',
			'pagerev_userid' => (($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : '0' ),
			'pagerev_userip' => $this->input->ip_address(),
			'pagerev_timestamp' => time()
		);
		$this->db->insert('page_revision', $page_revision);
		$this->rev_id = $this->db->insert_id();
	}
}