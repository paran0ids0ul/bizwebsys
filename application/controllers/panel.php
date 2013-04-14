<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Horace
 * Date: 2/21/13
 * Time: 10:07 PM
 * To change this template use File | Settings | File Templates.
 */

class Panel extends MY_Controller {
	public function view($page='home'){	
	    $this->pageName = $page;
		$username = $this->session->userdata('username');
		if($username == "")
			header('Location:'.site_url(''));
		else	
			$this->_render('panel/'.$page);
	}
	
}