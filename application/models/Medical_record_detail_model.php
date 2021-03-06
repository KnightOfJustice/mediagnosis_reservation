<?php

class Medical_record_detail_model extends CI_Model {

    // GET MEDICAL RECORD DETAIL
    function getMedicalRecordDetailByID($medicalRecordID){
        $this->db->select('mainConditionText, conditionDate, diseaseName, reference, visitType, a.treatment, statusDiagnose');
        $this->db->from('tbl_cyberits_t_detail_medical_record a');
        $this->db->join('tbl_cyberits_m_main_condition  b', 'a.mainCondition = b.mainConditionID');
        $this->db->join('tbl_cyberits_m_diseases  c', 'a.workingDiagnose = c.diseaseID');
        $this->db->where('a.medicalRecordID', $medicalRecordID);
        $query = $this->db->get();
        return $query->row();
    }

    // GET ADDITIONAL CONDITION DETAIL
    function getAdditionalConditionByID($medicalRecordID){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_t_additional_condition a');
        $this->db->join('tbl_cyberits_m_additional_condition  b', 'a.additionalConditionID = b.additionalConditionID');
        $this->db->where('a.medicalRecordID', $medicalRecordID);
        $query = $this->db->get();
        return $query->result_array();
    }

    // GET SUPPORT EXAMINATION DETAIL
    function getSupportExaminationByID($medicalRecordID){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_t_support_examination a');
        $this->db->join('tbl_cyberits_m_support_examination_column  b', 'a.supportExaminationColumnID = b.supportExaminationColumnID');
        $this->db->where('a.medicalRecordID', $medicalRecordID);
        $query = $this->db->get();
        return $query->result_array();
    }

    // GET PHYSICAL EXAMINATION DETAIL
    function getPhysicalExaminationByID($medicalRecordID){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_t_physical_examination a');
        $this->db->where('a.medicalRecordID', $medicalRecordID);
        $query = $this->db->get();
        return $query->row();
    }

    // GET PHYSICAL EXAMINATION DETAIL by Detail Reservation
    function getPhysicalExaminationByDetailReservation($detailReservation){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_t_physical_examination a');
        $this->db->where('a.detailReservationID', $detailReservation);
        $query = $this->db->get();
        return $query->row();
    }

    // GET SUPPORT DIAGNOSE DETAIL
    function getSupportDiagnoseByID($medicalRecordID){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_t_support_diagnose a');
        $this->db->join('tbl_cyberits_m_diseases  c', 'a.diseaseID = c.diseaseID');
        $this->db->where('a.medicalRecordID', $medicalRecordID);
        $query = $this->db->get();
        return $query->result_array();
    }

    // GET MEDICATION DETAIL
    function getMedicationByID($medicalRecordID){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_t_medication a');
        $this->db->join('tbl_cyberits_m_medication  c', 'a.medicationID = c.medicationID');
        $this->db->where('a.medicalRecordID', $medicalRecordID);
        $query = $this->db->get();
        return $query->result_array();
    }


    // CREATE
    // MEDICAL RECORD DETAIL
    function createMedicalRecordDetail($data){
        $this->db->insert('tbl_cyberits_t_detail_medical_record',$data);
        $result=$this->db->insert_id();
        return $result;
    }

    // ADDITIONAL CONDITION
    function createMedicalRecordDetailAdditonalCondition($data){
        $this->db->insert('tbl_cyberits_t_additional_condition',$data);
        $result=$this->db->insert_id();
        return $result;
    }

    // SUPPORT DIAGNOSE
    function createMedicalRecordDetailSupportDiagnose($data){
        $this->db->insert('tbl_cyberits_t_support_diagnose',$data);
        $result=$this->db->insert_id();
        return $result;
    }

    // PHYSICAL EXAMINATION
    function createMedicalRecordDetailPhysicalExamination($data){
        $this->db->insert('tbl_cyberits_t_physical_examination',$data);
        $result=$this->db->insert_id();
        return $result;
    }

    // SUPPORT EXAMINATION
    function createMedicalRecordDetailSupportExamination($data){
        $this->db->insert('tbl_cyberits_t_support_examination',$data);
        $result=$this->db->insert_id();
        return $result;
    }

    // MEDICATION
    function createMedicalRecordDetailMedication($data){
        $this->db->insert('tbl_cyberits_t_medication',$data);
        $result=$this->db->insert_id();
        return $result;
    }

    // UPDATE PHYSICAL EXAMINATION
    function updateMedicalRecordDetailPhysicalExamination($data,$id){
        $this->db->where('detailReservationID',$id);
        $this->db->update('tbl_cyberits_t_physical_examination',$data);
        $result=$this->db->affected_rows();
        return $result;
    }

    // DELETE PHYSICAL EXAMINATION BY DETAIL RESERVATION
    function deletePhysicalExaminationByDetailReservation($id){
        $this->db->where('detailReservationID',$id);
        $this->db->delete('tbl_cyberits_t_physical_examination');
    }
}