<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Loader extends CI_Loader {

    public function __construct() {
        parent::__construct();
    }

    /**
     * System template
     */
    public function template($template_name, $vars = array(), $return = FALSE) {
        if($return) {
            $content  = $this->view('templates/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('templates/footer', $vars, $return);

            return $content;
        } else { 
            $this->view('templates/header', $vars);
            $this->view($template_name, $vars);
            $this->view('templates/footer', $vars);
        }
    }

    public function signup($template_name, $vars = array(), $return = FALSE) {
        if($return) {
            $content  = $this->view('templates/nd_clean_header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('templates/nd_clean_footer', $vars, $return);

            return $content;
        } else { 
            $this->view('templates/nd_clean_header', $vars);
            $this->view($template_name, $vars);
            $this->view('templates/nd_clean_footer', $vars);
        }
    }


    /**
     * Everything below are for design template
     */

    public function design($template_name, $vars = array(), $return = FALSE) {
        if($return) {
            $content  = $this->view('templates/design/incs/header', $vars, $return);
            $content .= $this->view('templates/design/'.$template_name, $vars, $return);
            $content .= $this->view('templates/design/incs/footer', $vars, $return);

            return $content;
        } else { 
            $this->view('templates/design/incs/header', $vars);
            $this->view('templates/design/'.$template_name, $vars);
            $this->view('templates/design/incs/footer', $vars);
        }
    }

    public function page($template_name, $vars = array(), $return = FALSE) {
        if($return) {
            $content  = $this->view('templates/design/incs/header_page', $vars, $return);
            $content .= $this->view('templates/design/'.$template_name, $vars, $return);
            $content .= $this->view('templates/design/incs/footer', $vars, $return);

            return $content;
        } else { 
            $this->view('templates/design/incs/header_page', $vars);
            $this->view('templates/design/'.$template_name, $vars);
            $this->view('templates/design/incs/footer', $vars);
        }
    }

    public function page2($template_name, $vars = array(), $return = FALSE) {
        if($return) {
            $content  = $this->view('templates/design/incs/clean_header', $vars, $return);
            $content .= $this->view('templates/design/'.$template_name, $vars, $return);
            $content .= $this->view('templates/design/incs/clean_footer', $vars, $return);

            return $content;
        } else { 
            $this->view('templates/design/incs/clean_header', $vars);
            $this->view('templates/design/'.$template_name, $vars);
            $this->view('templates/design/incs/clean_footer', $vars);
        }
    }

    public function design_for_users($template_name, $vars = array(), $return = FALSE) {
        if($return) {
            $content  = $this->view('templates/design/incs/header_for_users', $vars, $return);
            $content .= $this->view('templates/design/'.$template_name, $vars, $return);
            $content .= $this->view('templates/design/incs/footer', $vars, $return);

            return $content;
        } else { 
            $this->view('templates/design/incs/header_for_users', $vars);
            $this->view('templates/design/'.$template_name, $vars);
            $this->view('templates/design/incs/footer', $vars);
        }
    }

    public function header_less($template_name, $vars = array(), $return = FALSE) {
        if($return) {
            $content  = $this->view('templates/design/no_nav_header', $vars, $return);
            $content .= $this->view('design/'.$template_name, $vars, $return);
            $content .= $this->view('templates/design/incs/dash_footer', $vars, $return);

            return $content;
        } else { 
            $this->view('templates/design/no_nav_header', $vars);
            $this->view('templates/design/'.$template_name, $vars);
            $this->view('templates/design/incs/clean_footer', $vars);
        }
    }
}
?>