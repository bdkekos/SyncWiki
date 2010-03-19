<?php

class System extends Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('tab');
		$this->load->vars('home_link', TRUE);
	}
	
	function index()
	{
		
	}
	
	function page_list()
	{
		$this->load->model('Page_model', 'page');
		$pages = $this->page->get_pages();
		
		$tabs = array(
			array(
				'selected' => false,
				'img' => 'img/system.png',
				'link' => site_url('System'),
				'name' => 'System'
			),
			array(
				'selected' => true,
				'img' => 'img/info.png',
				'link' => site_url('System/Page List'),
				'name' => 'Page List'
			)
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => 'Page List',
			'page_title' => 'Page list',
			'pages' => $pages
		);
		$this->load->vars($vars);
		$this->load->view('sw/system/page_list');
	}
}