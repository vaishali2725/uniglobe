<?php
Class Notification extends CI_Model{
    public function __construct()
	{
                parent::__construct();
		            ob_start();
                $this->load->library('email');
       }
      
      public function sendMail($to,$message,$subject)
        { 
          $this->email->set_newline("\r\n");
          $this->email->from('ajaygawali321@gmail.com', 'CRM Team');
          $this->email->to($to);
          $this->email->subject($subject);
          $this->email->message($message);
          $this->email->send();
          return TRUE;
      }
    
      
  }