<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout extends MX_Controller {

    function __construct() {
        parent::__construct();        
    }

    /**
     * function : render layout for website
     * @param type $data : data of view you want to include into layout
     */
    public function render($data) {
        // render view
        $this->load->helper('third_library');             
        $this->load->view('login/view_layout', $data);
    }
}

?>
