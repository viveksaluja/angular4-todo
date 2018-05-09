<?php

function sendEmail($email) {
    $config = Array(
        'mailtype' => 'html',
        'wordwrap' => TRUE,
        'charset' => 'iso-8859-1',
    );
    $ci = & get_instance();
    $ci->load->library('email', $config);
    $ci->email->set_newline("\r\n");
    $ci->email->from('ravimutti.mutti@gmail.com', 'Ben Admin');
    $ci->email->to($email['To']);
    $ci->email->subject($email['Subject']);
    $ci->email->message($email['Message']);
    if ($ci->email->send()) {
        return TRUE;
    } else {
        //echo show_error($ci->email->print_debugger());die;
        return FALSE;
    }
    return true;
}

function getEmailTemplate($id = NULL) {
    $ci = & get_instance();
    $ci->db->select('*');
    $ci->db->where('id', $id);
    $query = $ci->db->get('email_template');
    $result = array();
    if ($query->num_rows() > 0) {
        $result = $query->row_array();
    }
    return $result;
}

?>
