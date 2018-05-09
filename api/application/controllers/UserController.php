<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->Model('user_model');
        $this->load->Model('Comman_modal');
        $this->load->library('form_validation');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers:*");
    }

    public function login() {
        if ($this->input->post('data')) {
            $response = array();
            $data = json_decode($this->input->post('data'));
            $result = $this->user_model->login($data);
            if ($result['success'] == 'true') {
                $response['success'] = true;
                $response['message'] = $result['message'];
                $response['userRef'] = $result['data']->userRef;
            }
            if ($result['success'] == 'false') {
                $response['error'] = false;
                $response['error_message'] = $result['error_message'];
            }
            echo json_encode($response);
        }
    }


		public function changePassword()
		{
			$postData		= json_decode($_POST['data'], true);

			if(!empty($postData))
			{
				$user = $this->user_model->getrow("register", array( 'userRef' => $postData['ref'], 'password' => md5($postData['password'])));

        if(empty($user))
				{
					$result["success"] 	 = true;
					$result["error_msg"] = 'Password changed successfully.';
				}
				else
				{
						$password	  		=   md5($postData['newpassword']);
						$response	= $this->user_model->update(array('userRef'=>$postData['ref']),array('password' => $password),'register');
						if( $response == 0 )
						{
							$result["success"] 		= false;
							$result["error_msg"] 	= 'Data not saved. Please try again.';
						}
						else
						{
							$result["success"] 				= true;
							$result["success_msg"] 		= 'Password changed successfully.';
						}
				}
			}
			else
			{
				$result["success"] 	 = false;
				$result["error_msg"] = 'Parameters missing. Please try again.';
			}
			header('Content-Type: application/json');
			echo json_encode($result);exit;
		}

    public function forgot()
      {
        $postData	=	json_decode($_POST['data'], true);

        if( $postData['email'] != '' )
        {
          $response = $this->user_model->forgotPassword($postData['email']);
            print_r ($response);
          if( !$response['success'])
          {
            // if(isset($response['inactive']))
            // {
            //   $result["success"] 	 = false;
            //   $result["error_msg"] = 'Your account is currently inactive';
            // }
            // else
            // {
              $result["success"] 	 = false;
              $result["error_msg"] = 'The email you entered is not found in our database. Please enter correct email.';
            }

          else
          {
            $result["success"] 	 	= true;
            $result["success_msg"]	= 'Please check your email to get new password.';
          }
        }
        else
        {
          $result["success"] 	 = false;
          $result["error_msg"] = 'Parameters missing. Please try again.';
        }
        header('Content-Type: application/json');
        echo json_encode($result);exit;
      }

    public function forgotPassword() {
        $response = array();
        $data = json_decode($this->input->post('data'));
        $result = $this->user_model->forgot($data);
        // if ($result['success'] == 'true') {
        //
        //     // echo $check=$this->sendEmail($senddata);
        // }
        if ($result['success'] == 'true') {
            $senddata = array(
                'To' => $result['email'],
                'Subject' => 'Forget Password',
                'Message' => 'Your New Password is:' . $result['password']
            );
            $response['success'] = true;
            $response['message'] = 'Your New password send on your email.please check your email.';
        }
        if ($result['success'] == 'false') {
            $response['error'] = false;
            $response['error_message'] = 'Email not exist.';
        }
        echo json_encode($response);
    }

    function sendEmail($email) {
        $sendEmail = array(
            'Subject' => $email['Subject'],
            'Message' => utf8_decode($this->cleanString(html_entity_decode($msg, ENT_QUOTES, "UTF-8"))),
            'To' => $email['To'],
            'From' => CASHMAN_FROM_EMAIL_ADDRESS
        );

        // echo $msg;
        // die('Email controller 503');

        sendEmail($sendEmail);
    }

    function cleanString($text) {
        $utf8 = array(
            '/[Ã¡Ã Ã¢Ã£ÂªÃ¤]/u' => 'a',
            '/[Ã?Ã€Ã‚ÃƒÃ„]/u' => 'A',
            '/[Ã?ÃŒÃŽÃ?]/u' => 'I',
            '/[Ã­Ã¬Ã®Ã¯]/u' => 'i',
            '/[Ã©Ã¨ÃªÃ«]/u' => 'e',
            '/[Ã‰ÃˆÃŠÃ‹]/u' => 'E',
            '/[Ã³Ã²Ã´ÃµÂºÃ¶]/u' => 'o',
            '/[Ã“Ã’Ã”Ã•Ã–]/u' => 'O',
            '/[ÃºÃ¹Ã»Ã¼]/u' => 'u',
            '/[ÃšÃ™Ã›Ãœ]/u' => 'U',
            '/Ã§/' => 'c',
            '/Ã‡/' => 'C',
            '/Ã±/' => 'n',
            '/Ã‘/' => 'N',
            '/â€“/' => '-',
            '/[â€™â€˜â€¹â€ºâ€š]/u' => ' ',
            '/[â€œâ€?Â«Â»â€ž]/u' => ' ',
            '/ /' => ' ',
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }

    public function extractData() {
        $file = file_get_contents(FCPATH . 'files/5847625427017370.txt', true);
        $array = explode('	', $file);
        echo "<pre>";
        $splitArray = array_chunk($array, 31);
        if (!empty($splitArray)) {
            for ($i = 0; $i < count($splitArray); $i++) {
                // print_r($splitArray[$i]);
                if (!empty($splitArray[$i])) {
                    for ($j = 0; $j < count($splitArray[$i]); $j++) {
                        echo $splitArray[$i][$j] . '<br>';
                    }
                }
            }
        }
    }

    public function createUsers()
    {
        $json  = file_get_contents('php://input');
        $data  =json_decode($json,true);
        if (!empty($data))
        {
          $result = $this->Comman_modal->insert('task',$data);
          if($result[0] == 1)
          {
            $res['success'] = true;
          }
          else
          {
            $res['error'] = true;
          }
          echo json_encode($res);exit;
        }
    }

    public function seeResults()
    {
      $result = $this->Comman_modal->getTable('task');
      $res['success'] = true;
      $res['data'] = $result;
      echo json_encode($res);exit;
    }

    public function delete()
    {
        $json  = file_get_contents('php://input');
        $data  =json_decode($json,true);
        if (!empty($data))
        {
          $result = $this->Comman_modal->deleteMultiple('task','taskId',$data);
          if($result)
          {
            $res['success'] = true;
          }
          else
          {
            $res['error'] = true;
          }
          echo json_encode($res);exit;
        }
    }
}
