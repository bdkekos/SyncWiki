<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('top_user_bar') )
{
	function top_user_bar()
	{
		$CI =& get_instance();
		
		if($CI->ion_auth->logged_in() === FALSE)
		{
			return $CI->load->view('sw/top_guest', '', TRUE);
		}
		else
		{
			$CI->load->vars('username', $CI->session->userdata('username'));
			return $CI->load->view('sw/top_logged_in', '', TRUE);
		}
	}
}