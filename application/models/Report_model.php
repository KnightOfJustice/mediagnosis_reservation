<?php

class Report_model extends CI_Model {

    function getClinicList(){
        $this->db->select('clinicID, clinicName, isActive');
        $this->db->from('tbl_cyberits_m_clinics a');
        $this->db->where('a.createdBy',$this->session->userdata('superUserID'));

        $query = $this->db->get();
        return $query->result_array();
    }


    function getTest(){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_poli a');
        //$this->db->where('a.createdBy',$this->session->userdata('superUserID'));
        $query = $this->db->get();
        return $query->row();
    }

    function getReportClinicVisitType($userID, $startDate, $endDate){

        $sql = "call sp_clinic_visit_type(?,?,?)";
        $execute = $this->db->query($sql, array($userID,$startDate,$endDate));
        return $execute->result_array();
    }

    function getReportClinicPoliVisit($userID, $startDate, $endDate){

        $sql = "call sp_clinic_poli_visit(?,?,?)";
        $execute = $this->db->query($sql, array($userID,$startDate,$endDate));
        return $execute->result_array();
    }

    function getReportDoctorVisit($userID, $startDate, $endDate){

        $sql = "call sp_doctor_visit(?,?,?)";
        $execute = $this->db->query($sql, array($userID,$startDate,$endDate));
        return $execute->result_array();
    }

    function getReportDiseaseVisit($userID, $startDate, $endDate){

        $sql = "call sp_disease_visit(?,?,?)";
        $execute = $this->db->query($sql, array($userID,$startDate,$endDate));
        return $execute->result_array();
    }

    function getReportPatientType($userID, $startDate, $endDate){

        $sql = "call sp_patient_visit_type(?,?,?)";
        $execute = $this->db->query($sql, array($userID,$startDate,$endDate));
        return $execute->result_array();
    }

    function getReportClinicVisitTypeDetail($startDate, $endDate, $clinic){
        $this->db->select('a.clinicID, a.poliID, pl.poliName, b.patientID, b.doctorID, b.created as reserveDate, b.reservationID,
        b.detailReservationID, b.reservationType, c.medicalRecordID, d.visitType, d.treatment, d.statusDiagnose,
        TIMESTAMPDIFF(YEAR, e.dob, b.created) AS age,
        e.patientName, e.ktpID, e.bpjsID, e.phoneNumber, e.address, e.dob, e.gender');
        $this->db->from('tbl_cyberits_t_header_reservation a');
        $this->db->join('tbl_cyberits_m_poli pl','a.poliID=pl.poliID');
        $this->db->join('tbl_cyberits_t_detail_reservation b', 'a.reservationID = b.reservationID');
        $this->db->join('tbl_cyberits_t_medical_record c', 'b.detailReservationID = c.detailReservationID');
        $this->db->join('tbl_cyberits_t_detail_medical_record d', 'c.medicalRecordID = d.medicalRecordID');
        $this->db->join('tbl_cyberits_t_patient_profile e', 'c.tPatientProfileID = e.tPatientProfileID');
        $this->db->where('b.status','done');
        $this->db->where('a.clinicID',$clinic);

        if(!empty($startDate) && !empty($endDate)){
            $this->db->where('b.created >=',$startDate);
            $this->db->where('b.created <=',$endDate);
        }
        $this->db->order_by("b.created");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getReportClinicPoliVisitDetail($startDate, $endDate, $clinic, $poli){
        $this->db->select('a.clinicID, a.poliID, pl.poliName, b.patientID, b.doctorID, b.created as reserveDate, b.reservationID,
        b.detailReservationID,b.reservationType, c.medicalRecordID, d.visitType, d.treatment, d.statusDiagnose, dis.diseaseName,
        TIMESTAMPDIFF(YEAR, e.dob, b.created) AS age,
        e.patientName, e.ktpID, e.bpjsID, e.phoneNumber, e.address, e.dob, e.gender');
        $this->db->from('tbl_cyberits_t_header_reservation a');
        $this->db->join('tbl_cyberits_m_poli pl','a.poliID=pl.poliID');
        $this->db->join('tbl_cyberits_t_detail_reservation b', 'a.reservationID = b.reservationID');
        $this->db->join('tbl_cyberits_t_medical_record c', 'b.detailReservationID = c.detailReservationID');
        $this->db->join('tbl_cyberits_t_detail_medical_record d', 'c.medicalRecordID = d.medicalRecordID');
        $this->db->join('tbl_cyberits_m_diseases dis', 'd.workingDiagnose = dis.diseaseID');
        $this->db->join('tbl_cyberits_t_patient_profile e', 'c.tPatientProfileID = e.tPatientProfileID');
        $this->db->where('b.status','done');
        $this->db->where('a.clinicID',$clinic);
        $this->db->where('a.poliID',$poli);

        if(!empty($startDate) && !empty($endDate)){
            $this->db->where('b.created >=',$startDate);
            $this->db->where('b.created <=',$endDate);
        }
        $this->db->order_by("b.created");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getReportDoctorVisitDetail($startDate, $endDate, $doctor){
        $this->db->select('a.clinicID, a.poliID, pl.poliName, b.patientID, b.doctorID, b.created as reserveDate, b.reservationID,
        b.detailReservationID,b.reservationType, c.medicalRecordID, d.visitType, d.treatment, d.statusDiagnose, dis.diseaseName,
        TIMESTAMPDIFF(YEAR, e.dob, b.created) AS age,
        e.patientName, e.ktpID, e.bpjsID, e.phoneNumber, e.address, e.dob, e.gender');
        $this->db->from('tbl_cyberits_t_header_reservation a');
        $this->db->join('tbl_cyberits_m_poli pl','a.poliID=pl.poliID');
        $this->db->join('tbl_cyberits_t_detail_reservation b', 'a.reservationID = b.reservationID');
        $this->db->join('tbl_cyberits_t_medical_record c', 'b.detailReservationID = c.detailReservationID');
        $this->db->join('tbl_cyberits_t_detail_medical_record d', 'c.medicalRecordID = d.medicalRecordID');
        $this->db->join('tbl_cyberits_m_diseases dis', 'd.workingDiagnose = dis.diseaseID');
        $this->db->join('tbl_cyberits_t_patient_profile e', 'c.tPatientProfileID = e.tPatientProfileID');
        $this->db->where('b.status','done');
        $this->db->where('b.doctorID',$doctor);

        if(!empty($startDate) && !empty($endDate)){
            $this->db->where('b.created >=',$startDate);
            $this->db->where('b.created <=',$endDate);
        }
        $this->db->order_by("b.created");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getReportDiseaseVisitDetail($startDate, $endDate, $diseaseID){

        #Create where clause
        $this->db->select('doctorID');
        $this->db->from('tbl_cyberits_m_doctors');
        $this->db->where("createdBy",$this->session->userdata('superUserID'));
        $doctor_clause = $this->db->get_compiled_select();

        $this->db->select('a.clinicID, cl.clinicName, a.poliID, pl.poliName, b.patientID, b.doctorID, b.created as reserveDate, b.reservationID,
        b.detailReservationID,b.reservationType, c.medicalRecordID, d.visitType, d.treatment, d.statusDiagnose, dis.diseaseName,
        TIMESTAMPDIFF(YEAR, e.dob, b.created) AS age,
        e.patientName, e.ktpID, e.bpjsID, e.phoneNumber, e.address, e.dob, e.gender');
        $this->db->from('tbl_cyberits_t_header_reservation a');
        $this->db->join('tbl_cyberits_m_poli pl','a.poliID=pl.poliID');
        $this->db->join('tbl_cyberits_m_clinics cl','a.clinicID=cl.clinicID');
        $this->db->join('tbl_cyberits_t_detail_reservation b', 'a.reservationID = b.reservationID');
        $this->db->join('tbl_cyberits_t_medical_record c', 'b.detailReservationID = c.detailReservationID');
        $this->db->join('tbl_cyberits_t_detail_medical_record d', 'c.medicalRecordID = d.medicalRecordID');
        $this->db->join('tbl_cyberits_m_diseases dis', 'd.workingDiagnose = dis.diseaseID');
        $this->db->join('tbl_cyberits_t_patient_profile e', 'c.tPatientProfileID = e.tPatientProfileID');
        $this->db->where('b.status','done');
        $this->db->where("b.doctorID IN ($doctor_clause)", NULL, FALSE);
        $this->db->where('d.workingDiagnose',$diseaseID);

        if(!empty($startDate) && !empty($endDate)){
            $this->db->where('b.created >=',$startDate);
            $this->db->where('b.created <=',$endDate);
        }
        $this->db->order_by("b.created");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getPoliByName($name, $isEdit, $old_data){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_poli a');
        $this->db->where('poliName',$name);
        //$this->db->where('a.createdBy',$this->session->userdata('superUserID'));
        if($isEdit){
            $this->db->where('poliName != ', $old_data);
        }
        $query = $this->db->get();
        return $query->row();
    }

    function getPoliByID($id){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_poli a');
        $this->db->where('poliID',$id);
        //$this->db->where('a.createdBy',$this->session->userdata('superUserID'));
        $query = $this->db->get();
        return $query->row();
    }
}