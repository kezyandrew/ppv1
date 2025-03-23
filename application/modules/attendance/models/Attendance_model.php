<?php

class Attendance_model extends CI_Model {
    public function updateAttendance($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('attendance', $data);
    }
    function getAttendance() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('attendance');
        return $query->result();
    }
    function getAttendanceByYear($staff, $r_year) {
        if (empty($staff) || empty($r_year)) {
            return array();
        }
        $this->db->where('staff', $staff);
        $this->db->where('year', $r_year);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('attendance');
        return $query->result();
    }
    function getAttendanceByMonth($staff, $r_month, $r_year) {
        if (empty($staff) || empty($r_month) || empty($r_year)) {
            return array();
        }
        try {
            $this->db->where('staff', $staff);
            $this->db->where('year', $r_year);
            $this->db->where('month', $r_month);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $query = $this->db->get('attendance');
            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching attendance: ' . $e->getMessage());
            return array();
        }
    }
}

