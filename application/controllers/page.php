<?php

class Page extends Controller {
	
	function __construct()
	{	
		parent::__construct();
		
		$this->load->helper('tab');
	}
	
	function index()
	{
		// Return the index page
		$this->view('Main Page');
	}
	
	function view($page)
	{
		$this->load->model('Page_model', 'page');
		$this->load->library('parser');
		$page = urldecode($page);
		$page_title = str_replace(array(' '), array('_'), $page);
		$page = str_replace(array('_'), array(' '), $page);
		
		$query = $this->page->load_page($page_title);
		
		if($query === FALSE)
		{
			// The page doesn't exist
			$this->page->text = 'This page doesn\'t exist yet, press edit to create it';
		}
		
		$aText = $this->parser->parse($this->page->text);
		
		$tabs = array(
			array(
				'selected' => true,
				'img' => 'img/view.png',
				'link' => site_url($page_title),
				'name' => 'Read'
			),
			array(
				'selected' => false,
				'img' => 'img/edit.png',
				'link' => site_url($page_title.'/edit'),
				'name' => 'Edit'
			)
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => $page,
			'page_title' => $page,
			'text' => $aText
		);
		$this->load->vars($vars);
		$this->load->view('sw/page/view');
	}
	
	function edit($page, $section = '')
	{
		$this->load->model('Page_model', 'page');
		$this->load->helper('edit_page');
		$this->load->helper('form');
		$page = urldecode($page);
		$page_title = $this->_make_link($page);
		$page = str_replace(array('_'), array(' '), $page);
		
		$this->page->load_page($page_title);
		
		$tabs = array(
			array(
				'selected' => false,
				'img' => 'img/view.png',
				'link' => site_url($page_title),
				'name' => 'Read'
			),
			array(
				'selected' => true,
				'img' => 'img/edit.png',
				'link' => site_url($page_title.'/edit'),
				'name' => 'Edit'
			)
		);
		
		$show = array(
			'newpage_notice' => ($this->page->id == 0),
			// We need to add a permissions error
			'save_buttons' => (
									($this->page->id == 0 && $this->ion_auth->logged_in())
								OR 	
									(
										($this->page->locked == 0)
									OR
										($this->ion_auth->logged_in() && $this->page->locked == 1)
									OR
										($this->ion_auth->is_admin())
									)
								),
			'tools' => ($this->page->id != 0),
			'mod_tools' => ($this->ion_auth->is_admin()),
			'report' => ($this->ion_auth->logged_in())
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => $page,
			'page_title' => $page,		// This is confusing
			'page_link' => $page_title, // :p
			'headinclude' => $this->load->view('sw/page/edit_headinclude', '', TRUE),
			'bottom_script' => $this->load->view('sw/page/edit_bottom_script', '', TRUE),
			'editText' => $this->page->text,
			'locked_status' => $this->page->locked,
			'pageid' => $this->page->id,
			'protection_link' => site_url('ajax/page/update_protection'),
			'show' => $show
		);
		$this->load->vars($vars);
		$this->load->view('sw/page/edit');
	}
	
	function edit_submit($page)
	{
		if($this->input->post('pageid') === FALSE)
		{
			redirect($this->_make_link($page).'/edit');
			return;
		}
		$this->load->model('Page_model', 'page');
		if($this->input->post('pageid') != 0)
		{
			$this->page->load_id($this->input->post('pageid'));
			if($this->page->locked == 2 && !$this->ion_auth->is_admin())
			{
				redirect($this->_make_link($page).'/edit');
				return;
			}
			
			$this->page->edit($this->input->post('editbox'), $this->input->post('comment'));
		}
		else
		{
			$comment = ($this->input->post('comment') == '') ? 'Page created' : $this->input->post('comment');
			$this->page->create($this->_make_link($page), $this->input->post('editbox'),
								 $comment);
		}
		redirect($this->_make_link($page));
	}
	
	function history($page)
	{
		$this->load->model('Revision_model', 'revision');
		$this->load->model('Page_model', 'page');
		$page = urldecode($page);
		$page_title = $this->_make_link($page);
		$page = str_replace(array('_'), array(' '), $page);
		
		$this->page->load_page($page_title);
		if($this->page->id == 0)
		{
			die('Bad page');
		}
		$revs = $this->revision->get_latest_revisions($this->page->id, 20);
		
		$tabs = array(
			array(
				'selected' => false,
				'img' => 'img/view.png',
				'link' => site_url($page_title),
				'name' => 'Read'
			),
			array(
				'selected' => true,
				'img' => 'img/edit.png',
				'link' => site_url($page_title.'/edit'),
				'name' => 'Edit'
			)
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => $page,
			'page_title' => $page,		// This is confusing
			'page_link' => $page_title, // :p
			'revs' => $revs
		);
		$this->load->vars($vars);
		$this->load->view('sw/page/history');
	}
	
	function ajax_update_protection()
	{
		if(!$this->ion_auth->is_admin())
		{
			return;
		}
		if(!$this->input->post('pageid') || $this->input->post('newlevel') === FALSE)
		{
			print json_encode(array('error' => 'Missing pageid/newlevel'));
			return;
		}
		$this->load->model('Page_model', 'page');
		$this->page->load_id($this->input->post('pageid'));
		$this->page->update_protection($this->input->post('newlevel'));
		print json_encode(array('success' => 'Protection level changed'));
	}
	
	function _make_link($page)
	{
		return str_replace(array(' '), array('_'), $page);
	}
}