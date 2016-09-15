<?php

class ReservationDoctor extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url','security','date'));
        $this->load->library("pagination");
        $this->load->library("authentication");
        $this->is_logged_in();
        $this->load->model('clinic_model',"clinic_model");
        $this->load->model('doctor_model',"doctor_model");
        $this->load->model('poli_model',"poli_model");
        $this->load->model('sclinic_model',"sclinic_model");
        $this->load->model('sschedule_model',"sschedule_model");
        $this->load->model('test_model',"test_model");
    }

    function index(){
        $role = $this->session->userdata('role');
        if($this->authentication->isAuthorizeSuperAdmin($role)){
            $data['main_content'] = 'reservation/doctor/home_view';
            $this->load->view('template/template', $data);
        }else if($this->authentication->isAuthorizeDoctor($role)){

            $userID =  $this->session->userdata('userID');
            $doctor_data = $this->doctor_model->getClinicPoliDoctorByUserID($userID);

            // CREATE & CHECK RESERVATION CLINIC POLI
            $this->createHeaderReservation($doctor_data->clinicID,$doctor_data->poliID );

            $headerData = $this->test_model->getHeaderReservationDataByDoctor($doctor_data->clinicID,$doctor_data->poliID);
            $data['reversation_clinic_data']  = $headerData;
            $data['main_content'] = 'reservation/doctor/home_view';
            $this->load->view('template/template', $data);
        }
    }

    /*Create Header Reservasi untuk HARI INI*/
    function createHeaderReservation($clinicID, $poliID){
        $datetime = date('Y-m-d H:i:s', time());
        $userID = $this->session->userdata('userID');

        $verifyReservation = $this->test_model->checkReservationToday($clinicID,$poliID);
        if($verifyReservation == 0) {
            //insert baru
            $data_reservasi = array(
                'clinicID' => $clinicID,
                'poliID' => $poliID,
                'currentQueue' => 0,
                'totalQueue' => 0,
                'isActive' => 1,
                'created' => $datetime,
                'createdBy' => $userID,
                'lastUpdated' => $datetime,
                'lastUpdatedBy' => $userID
            );

            $query = $this->test_model->insertReservation($data_reservasi);

            if ($this->db->trans_status() === FALSE) {
                // Failed to save Data to DB
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
            }
        }
    }

    /* Get Antrian Sekarang, Per Clinic*/
    function getQueueCurrent(){
        $reservationID = $this->security->xss_clean($this->input->post('reservation'));
        $data = $this->test_model->getCurrentQueueDoctor($reservationID);

        $output="";
        $status="error";
        if(isset($data)){
            $output = array(
                "headerID"=>$data->reservationID,
                "detailID"=>$data->detailReservationID,
                "noQueue"=>$data->noQueue,
                "poliName" => strtoupper($data->poliName),
                "patientName" => strtoupper($data->patientName)
            );
            $status="success";
        }
        echo json_encode(array('status' => $status, 'output' => $output));
    }

    function saveCurrentQueue(){

        $datetime = date('Y-m-d H:i:s', time());
        $status_rev = $this->security->xss_clean($this->input->post('status'));
        $headerID = $this->security->xss_clean($this->input->post('headerID'));
        $detailID = $this->security->xss_clean($this->input->post('detailID'));

        if($status_rev =='check'){
            $checkReservation = $this->test_model->checkReservationDetail($detailID);
            if($checkReservation){
                $doctor = $this->doctor_model->getDoctorByUserID($this->session->userdata('userID'));
                $detail_data = $this->test_model->getReservationDetailByID($detailID);

                //UPDATE CURRENT QUEUE
                $data_header=array(
                    'currentQueue'=>$detail_data->noQueue,
                    "lastUpdated"=>$datetime,
                    "lastUpdatedBy"=>$this->session->userdata('userID')
                );
                $query_header = $this->test_model->updateReservationHeader($data_header,$headerID);

                //UPDATE DATA DETAIL
                $data=array(
                    'doctorID'=>$doctor->doctorID,
                    'status'=>'check',
                    "lastUpdated"=>$datetime,
                    "lastUpdatedBy"=>$this->session->userdata('userID')
                );

                $this->db->trans_begin();
                $query_detail = $this->test_model->updateReservationDetail($data,$detailID);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $status = "error";
                    $msg = "Cannot save to Database !";
                } else {
                    if ($query_detail && $query_header) {
                        $this->db->trans_commit();
                        $status = "success";
                        $msg = "Save data successfully !";
                    } else {
                        $this->db->trans_rollback();
                        $status = "error";
                        $msg = "Failed to save data !";
                    }
                }
            }else{
                $status = "taken";
                $msg = "This Patient has been taken by Other Doctor!";
            }
        }else{
            $status = "taken";
            $msg = "";
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function goToMedicalRecord(){
        $this->load->view('reservation/doctor/medical_record_view');
    }

    function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true) {
            $url_login = site_url("Login");
            redirect($url_login, 'refresh');
        }
    }
}