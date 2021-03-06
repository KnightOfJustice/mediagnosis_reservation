<?php

class User_model extends CI_Model {

    var $column_order = array('userID','userName','email','isActive',null); //set column field database for datatable orderable
    var $column_search = array('userName','email','isActive'); //set column field database for datatable searchable just firstname ,

    function getSuperAdminClinicListData ($searchText,$orderByColumnIndex,$orderDir, $start,$limit){
        $this->_dataSuperAdminClinicQuery($searchText,$orderByColumnIndex,$orderDir);

        // LIMIT
        if($limit!=null || $start!=null){
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        return $query->result_array();

    }

    function countSuperAdminClinicFiltered($searchText){
        $this->_dataSuperAdminClinicQuery($searchText,null,null);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countSuperAdminClinicAll(){
        $this->db->from("tbl_cyberits_m_users a");
        $this->db->where('a.userRole',"super_admin");
        return $this->db->count_all_results();
    }

    function _dataSuperAdminClinicQuery($searchText,$orderByColumnIndex,$orderDir){
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_users a');

        //WHERE
        $i = 0;
        if($searchText != null && $searchText != ""){
            //Search By Each Column that define in $column_search
            foreach ($this->column_search as $item){
                // first loop
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $searchText);
                }
                else {
                    $this->db->or_like($item, $searchText);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket

                $i++;
            }
        }
        $this->db->where('a.userRole',"super_admin");

        //Order by
        if($orderByColumnIndex != null && $orderDir != null ) {
            $this->db->order_by($this->column_order[$orderByColumnIndex], $orderDir);
        }
    }



}