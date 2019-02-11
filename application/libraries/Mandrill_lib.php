<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH.'assets/lib/mandrill/mandrill/src/Mandrill.php';

class Mandrill_lib {
    private $inst_mandrill = "";
    private $default_from_email = "";
    private $default_from_name = "";
    private $reply_to = "";
    private $CI;

    public function __construct() {
        require_once FCPATH.'assets/lib/mandrill/mandrill/src/Mandrill.php';

        $this->CI =& get_instance();
        $this->CI->load->config("mandrill");
        // $this->CI->load->model("Template_model");

        $this->default_from_email = $this->CI->config->item("default_from_email");
        $this->default_from_name = $this->CI->config->item("default_from_name");
        $this->reply_to = $this->CI->config->item("reply_to");

        $this->inst_mandrill = new Mandrill($this->CI->config->item("api_key_mandrill"));
    }

    /**
     * Use to check mandrill connection
     */
    function ping_mandrill() {
        try {
            $result = $this->inst_mandrill->users->ping();
            return ($result == "PONG!");
        } catch(Mandrill_Error $e) {
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            return FALSE;
            throw $e;
        }
    }

    /**
     * For sending direct html email message.
     *
     * @param html_msg:String, subject:String, $to:Multi-dimensional Array
     * @return Multi-dimensional Array
     */
    function direct_email($html_msg, $subject, $to = array(), $from_email = FALSE, $from_name = FALSE)
    {
        try {
            $message = array(
                'html' => $html_msg,
                'text' => '',
                'subject' => $subject,
                'from_email' => (!$from_email) ? $this->default_from_email : $from_email,
                'from_name' => (!$from_name) ? $this->default_from_name : $from_name,
                'to' => $to,
                // array(
                //     array(
                //         'email' => 'recipient.email@example.com',
                //         'name' => 'Recipient Name',
                //         'type' => 'to'
                //     )
                // ),
                'headers' => array('Reply-To' => $this->reply_to),
                'auto_text' => true,
            );
            $async = false;
            $ip_pool = '';
            $send_at = '';
            $result = $this->inst_mandrill->messages->send($message, $async);

            return $result;
            /* Sample Return
            Array
            (
                [0] => Array
                    (
                        [email] => recipient.email@example.com
                        [status] => sent
                        [reject_reason] => hard-bounce
                        [_id] => abc123abc123abc123abc123abc123
                    )
            
            ) */
        } catch(Mandrill_Error $e) {
            return FALSE;
            return 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            throw $e;
        }
    }

    /**
     * For sending message with template.
     *
     * @param template_name:String, template_content:Multi-dimensional Array, html_msg:String, $to:Multi-dimensional Array
     * @return Multi-dimensional Array
     */

    function mandrill_template_email($template_name, $template_content, $to, $subject, $from_email = FALSE, $from_name = FALSE)
    {
        try {
            if(!is_array($to)) {
                $to = array(array("email" => $to, "name" => "User"));
            }

            $template_name = $template_name;
            $template_content = $template_content;
            // array(
            //     array(
            //         'name' => 'example name',
            //         'content' => 'example content'
            //     )
            // );
            $message = array(
                'html' => '',
                'text' => '',
                'subject' => $subject,
                'from_email' => (!$from_email) ? $this->default_from_email : $from_email,
                'from_name' => (!$from_name) ? $this->default_from_name : $from_name,
                'to' => $to,
                'headers' => array('Reply-To' => $this->reply_to),
                'auto_text' => true,
            );
            $async = false;
            $ip_pool = ''; // 'Main Pool';
            $send_at = ''; // 'example send_at';
            $result = $this->inst_mandrill->messages->sendTemplate($template_name, $template_content, $message, $async);
            return $result;
            /* Sample Return
            Array
            (
                [0] => Array
                    (
                        [email] => recipient.email@example.com
                        [status] => sent
                        [reject_reason] => hard-bounce
                        [_id] => abc123abc123abc123abc123abc123
                    )
            
            ) */
        } catch(Mandrill_Error $e) {
            return $e->getMessage();
            return 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            throw $e;
        }
    }

    function get_mandril_templates() {
        try {
            $result = $this->inst_mandrill->templates->getList();
            return $result;
        } catch(Mandrill_Error $e) {
            return array();
        }
    }
}