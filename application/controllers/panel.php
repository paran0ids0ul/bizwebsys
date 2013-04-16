<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Horace
 * Date: 2/21/13
 * Time: 10:07 PM
 * To change this template use File | Settings | File Templates.
 */

class Panel extends MY_Controller {
	public function view($page='workspace'){	
	    $this->pageName = $page;
		$this->_render('panel/'.$page);
	}
	
}