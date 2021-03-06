<?php  
	class ConsultationMobile extends CI_Controller{
		function __construct(){
	        parent::__construct();
	        $this->load->helper(array('form', 'url','security','date'));
	        $this->load->library("pagination");
	        //$this->is_logged_in();
	        $this->load->model('Topic_model',"topic_model");
	        $this->load->model('Patient_model',"patient_model");
	        $this->load->model('Doctor_model',"doctor_model");
	        $this->load->model('SRoom_model',"sroom_model");
			$this->load->model('Notification_model');
			$this->load->model('Login_model','login_model');
	    }

	    function topicList(){
	    	$userID = $this->input->post("userID");
	    	$topics = $this->topic_model->getTopicList();

	    	echo json_encode(array('data' => $topics));
	    }

	    function expertList($topicID){
	    	$userID = $this->input->post("userID");
	    	
	    	$experts = $this->topic_model->getExpertList($topicID);

	    	echo json_encode(array('data' => $experts));	
	    }

	    function patientList($expertUserID){
	    	$experts = $this->doctor_model->getDoctorIDByUserID($expertUserID);
	    	$expertID = $experts->doctorID;

	    	$patients = $this->sroom_model->getUserListByDoctorID($expertID);

	    	echo json_encode(array('data' => $patients));	
	    }

	    function generateRoomID(){
	    	$topicID = $this->input->post("topicID");
	    	$patientID = $this->input->post("patientID");
	    	$expertID = $this->input->post("expertID");
	    	$role = $this->input->post("role");

	    	if($role == "patient"){
	    		$patients = $this->patient_model->getPatientIDByUserID($patientID);
	    		$patientID = $patients->patientID;
	    	}
	    	else{
	    		$experts = $this->doctor_model->getDoctorIDByUserID($expertID);
	    		$expertID = $experts->doctorID;
	    	}

	    	$rooms = $this->sroom_model->getRoomID($topicID, $patientID, $expertID);

	    	if($rooms == null || $rooms == ""){

	    		$datetime = date('Y-m-d H:i:s', time());
		        $room_data=array(
		        	'topicID'=>$topicID,
		            'patientID'=>$patientID,
		            'doctorID'=>$expertID,
		            'recentChat'=>"* New *",
		            'isActive'=>1,
		            'created'=>$datetime,
		            "createdBy" => "patient",
					"lastUpdated"=>$datetime,
					"lastUpdatedBy"=>"patient"
		        );

		        $this->db->trans_begin();
	    		$roomID = $this->sroom_model->insertRoom($room_data);
	    		if ($this->db->trans_status() === FALSE) {
		            // Failed to save Data to DB
		            $this->db->trans_rollback();
		            $status = 'error';
					$msg = "Maaf, Terjadi kesalahan saat melakukan konsultasi";
		        }else{
		        	$this->db->trans_commit();
					$status = 'success';
					$msg = "Proses konsultasi berhasil";
		        }

	    	}else{
	    		$roomID = $rooms->sRoomID;
    			$status = 'success';
				$msg = "Proses konsultasi berhasil";
	    	}

	    	echo json_encode(array('status' => $status, 'msg' => $msg, 'roomID' => $roomID));
	    }

	    function updateRecentChat(){
	    	$userID = $this->input->post("userID");
	    	$sRoomID = $this->input->post("sRoomID");
	    	$recentChat = $this->input->post("recentChat");

    		$datetime = date('Y-m-d H:i:s', time());
	        $recent_chat_data=array(
	        	"recentChat"=> $recentChat,
				"lastUpdated"=>$datetime,
				"lastUpdatedBy"=>$userID
	        );

	        $this->db->trans_begin();
	        $query = $this->sroom_model->updateRoom($recent_chat_data, $sRoomID);

	        if ($this->db->trans_status() === FALSE) {
	            // Failed to save Data to DB
	            $this->db->trans_rollback();
	            $status = 'error';
				$msg = "Maaf, Terjadi kesalahan saat melakukan konsultasi";
	        }
	        else{
	        	$this->db->trans_commit();
    			$status = 'success';
				$msg = "Proses konsultasi berhasil";
				
				$this->sendNotificationToRespectiveUserInTheRoom($sRoomID, $userID, $recentChat);
	        }

	     	echo json_encode(array("status" => $status, "msg" => $msg));
	    }
		
		function deleteChatRoom(){
			$userID = $this->input->post("userID");
			$sRoomID = $this->input->post("sRoomID");
			$datetime = date('Y-m-d H:i:s', time());
			
			$chat_room_data = array(
				"isActive"=>0,
				"lastUpdated"=>$datetime,
				"lastUpdatedBy"=>$userID
			);
			
	        $this->db->trans_begin();
	        $query = $this->sroom_model->updateRoom($chat_room_data, $sRoomID);

	        if ($this->db->trans_status() === FALSE) {
	            // Failed to save Data to DB
	            $this->db->trans_rollback();
	            $status = 'error';
				$msg = "Maaf, Terjadi kesalahan saat menghapus chat";
	        }
	        else{
	        	$this->db->trans_commit();
    			$status = 'success';
				$msg = "Berhasil menghapus chat";

	        }

	     	echo json_encode(array("status" => $status, "msg" => $msg));
			
		}
		
		function reportChatRoom(){
			$userID = $this->input->post("userID");
			$sRoomID = $this->input->post("sRoomID");
			$datetime = date('Y-m-d H:i:s', time());
			
			$chat_room_data = array(
				"isReported"=>1,
				"lastUpdated"=>$datetime,
				"lastUpdatedBy"=>$userID
			);
			
	        $this->db->trans_begin();
	        $query = $this->sroom_model->updateRoom($chat_room_data, $sRoomID);

	        if ($this->db->trans_status() === FALSE) {
	            // Failed to save Data to DB
	            $this->db->trans_rollback();
	            $status = 'error';
				$msg = "Maaf, Terjadi kesalahan saat melaporkan chat";
	        }
	        else{
	        	$this->db->trans_commit();
    			$status = 'success';
				$msg = "Berhasil melaporkan chat";

	        }

	     	echo json_encode(array("status" => $status, "msg" => $msg));
			
		}

	    function archiveChat(){
			$archive = $this->input->post("archive");
			$userID = $this->input->post("userID");
			$sRoomID = $this->input->post("sRoomID");
			
			$userWrapper = $this->login_model->getUserDataByUserID($userID);
			$this->load->library('email');
			$config = Array(
                'protocol' => 'mail',
                'smtp_host' => 'cyberits.co.id',
                'smtp_port' => 25,
                'smtp_user' => 'no-reply@cyberits.co.id',
                'smtp_pass' => 'Pass@word1',
                'mailtype'  => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );
			
			$message =  "<p>Dear Mediagnosis Users,</p><p>Berikut lampiran transkrip chat pada ruangan ".$sRoomID."</p><p style='width:80&;word-wrap:break-word;width:80%;margin:auto;border: 1px solid black;padding-top:3%;padding-bottom:3%;text-align: center;'>".$archive."</p><p>Regards,</p><br/><br/><p>Mediagnosis Team</p>";
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('no-reply@cyberits.co.id', 'Mediagnosis Team');
			$this->email->to($userWrapper->email); 
			$this->email->subject('[MEDIAGNOSIS] Chat Archive');
			$this->email->message($message);
			
			if($this->email->send()){
				$status = 'success';
				//$msg = $message;
				$msg = 'Arsip telah dikirim. Silahkan cek email anda';
			}else{
				show_error($this->email->print_debugger());
				$status = 'error';
				$msg = 'Terjadi kesalahan. harap coba lagi dalam beberapa saat';
			}
			
			echo json_encode(array('status' => $status, 'msg' => $msg));
		}
		
		function recentExpertList($userID){
	    	$patients = $this->patient_model->getPatientIDByUserID($userID);
	    	$patientID = $patients->patientID;

	    	$experts = $this->sroom_model->getUserListByPatientID($patientID);

	    	echo json_encode(array('data' => $experts));		
	    }
		
		function sendNotificationToRespectiveUserInTheRoom($sRoomID, $userID, $recentChat){
			$datetime = date('Y-m-d H:i:s', time());
			$token_wrapper = $this->sroom_model->getTokenBySRoomID($sRoomID);
			$click_action = 'id.co.cyberits.minimediagnosis_CHAT_TARGET_NOTIFICATION';
			
			if($token_wrapper->doctorUserID == $userID){
				//$role = "doctor";
				$token = $token_wrapper->patientToken; // dokter kirim ke pasien, butuhnya token pasien
				$experts = $this->doctor_model->getDoctorByUserID($userID);
				$onlineStatus = $this->topic_model->getSpecificExpertOnlineStatus($userID);
				$data = array(
					'expertID'=>$experts->doctorID,
					'phoneNumber'=>$experts->phoneNumber,
					'isOnline'=>$onlineStatus->isOnline,
					'topicID'=>$token_wrapper->topicID,
					'oppositionName'=>$token_wrapper->doctorName
				);
				$this->sendNotificationToSpesificActivity("Dr.".$token_wrapper->doctorName,"Anda mendapat pesan baru", $token, $click_action, $data);
				/*$data = array(
					'userID'=>$token_wrapper->patientUserID,
					'header'=>"Dr.".$token_wrapper->doctorName,
					'message'=>$recentChat,
					'clickAction'=>$click_action,
					'extras'=>$data,
					'isActive'=>1,
					'created'=>$datetime,
					'createdBy'=>$userID,
					'lastUpdated'=>$datetime,
					'lastUpdatedBy'=>$userID
				);
				$this->Notification_model->createNotification($data);*/
			}
			else{
				//$role = "patient";
				$token = $token_wrapper->doctorToken; // vice versa
				$patients = $this->patient_model->getPatientIDByUserID($userID);
				$data = array(
					'patientID'=>$patients->patientID,
					'topicID'=>$token_wrapper->topicID,
					'oppositionName'=>$token_wrapper->patientName
				);
				$this->sendNotificationToSpesificActivity($token_wrapper->patientName,"Anda mendapat pesan baru", $token, $click_action, $data);
				/*$data = array(
					'userID'=>$token_wrapper->doctorUserID,
					'header'=>$token_wrapper->patientName,
					'message'=>$recentChat,
					'clickAction'=>$click_action,
					'extras'=>$data,
					'isActive'=>1,
					'created'=>$datetime,
					'createdBy'=>$userID,
					'lastUpdated'=>$datetime,
					'lastUpdatedBy'=>$userID
				);
				$this->Notification_model->createNotification($data);*/
			}
		}
		
		function sendNotification($title, $message, $token){
			$path = 'https://fcm.googleapis.com/fcm/send';
			$server_key = "AAAAa0DykfY:APA91bGVDIV31q6GpXzcbpo_Tlr_L1BkqtuVio_OwvV2Ov7zTzIXrkPaRpcgLNxZ7XEy33gX356Q9TeRstFxqQo5V-rImTvvrFEG7EvLTwecAWncZ72xQvy63Waux3Xu7Pcv07WsxTPY8t8_DbtyqohE06ZdV0RSug";
			
			$headers = array(
				'Authorization:key='.$server_key,
				'Content-Type:application/json'
			);
			
			$fields = array('to'=>$token,
							'notification'=>array('title'=>$title, 'body'=>$message)
			);
			
			$payload= json_encode($fields);
			
			$curl_session = curl_init();
			curl_setopt($curl_session, CURLOPT_URL, $path);
			curl_setopt($curl_session, CURLOPT_POST, true);
			curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
			
			$result = curl_exec($curl_session);
			curl_close($curl_session);
			
		}
		
		function sendNotificationToSpesificActivity($title, $message, $token, $click_action, $data){
			$path = 'https://fcm.googleapis.com/fcm/send';
			$server_key = "AAAAa0DykfY:APA91bGVDIV31q6GpXzcbpo_Tlr_L1BkqtuVio_OwvV2Ov7zTzIXrkPaRpcgLNxZ7XEy33gX356Q9TeRstFxqQo5V-rImTvvrFEG7EvLTwecAWncZ72xQvy63Waux3Xu7Pcv07WsxTPY8t8_DbtyqohE06ZdV0RSug";
			
			$headers = array(
				'Authorization:key='.$server_key,
				'Content-Type:application/json'
			);
			
			$notifArray = array('title'=>$title, 'body'=>$message, 'click_action'=>$click_action);
			$data = array_merge($notifArray, $data);
			
			$fields = array('to'=>$token,
							//'notification'=>array('title'=>$title, 'body'=>$message, 'click_action'=>$click_action),
							'data'=>$data
			);
			
			//echo json_encode($fields);
			$payload= json_encode($fields);
			
			$curl_session = curl_init();
			curl_setopt($curl_session, CURLOPT_URL, $path);
			curl_setopt($curl_session, CURLOPT_POST, true);
			curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
			
			$result = curl_exec($curl_session);
			curl_close($curl_session);
		}

	}
?>