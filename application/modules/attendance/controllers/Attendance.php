<?php

class Attendance extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('attendance_model');
        $this->load->model('accountant/accountant_model');
        $this->load->model('laboratorist/laboratorist_model');
        $this->load->model('receptionist/receptionist_model');
        $this->load->model('pharmacist/pharmacist_model');
        $this->load->model('nurse/nurse_model');
        $this->load->model('doctor/doctor_model');
        
        // Check and update table structure
        $this->check_attendance_table();
    }

    // Function to check and update attendance table structure
    private function check_attendance_table() {
        $this->load->dbforge();
        
        try {
            // Check if hospital_id column exists
            $fields = $this->db->field_data('attendance');
            $hospital_id_exists = false;
            
            if ($fields) {
                foreach ($fields as $field) {
                    if ($field->name == 'hospital_id') {
                        $hospital_id_exists = true;
                        break;
                    }
                }
            }
            
            // Add hospital_id column if it doesn't exist
            if (!$hospital_id_exists) {
                $fields = array(
                    'hospital_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'default' => 0
                    )
                );
                $this->dbforge->add_column('attendance', $fields);
                
                // Update existing records to have the current hospital_id
                $hospital_id = $this->session->userdata('hospital_id');
                if (!empty($hospital_id)) {
                    $this->db->update('attendance', array('hospital_id' => $hospital_id));
                }
                
                log_message('info', 'Added hospital_id column to attendance table');
            }
        } catch (Exception $e) {
            log_message('error', 'Error checking attendance table: ' . $e->getMessage());
        }
    }

    public function index() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $this->createNewAttendance();
            $year = $this->db->get('attendance')->result();
            if (!empty($year)) {
                $start = $year[0]->year;
            } else {
                $start = date('Y');
            }

            $current_month = date('F');
            $current_year = date('Y');

            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $array6 = $this->db->get('doctor')->result_array();

            $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);
            $data['total_employees'] = count($allEmployees);
            $count = 0;

            foreach ($allEmployees as $employee) {
                $data['employee'][$count] = $employee['ion_user_id'];
                $index = 0;
                $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $current_month, 'year' => $current_year))->row();
                $data['details'][$count][$index] = $this->db->get_where('users', array('id' => $result->staff))->row()->username;
                $index++;
                $total = 0;
                $logs = explode('_', $result->log);

                $num_of_days = (int) date("t");

                if (!empty($result->log)) {
                    for ($i = 0; $i <= $num_of_days; $i++) {

                        if (count($logs) >= $i) {
                            if (!empty($logs[$i])) {
                                if ($logs[$i] == 'yes') {
                                    $total++;
                                    $data['details'][$count][$index] = $logs[$i];
                                } else {
                                    $data['details'][$count][$index] = $logs[$i];
                                }
                            } else {
                                $data['details'][$count][$index] = '';
                            }
                            $index++;
                        } else {
                            $data['details'][$count][$index] = '';
                            $index++;
                        }
                    }
                }
                $data['details'][$count][$index] = $total;
                $count++;
            }

            $data['years'] = [];
            $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            while ($start <= date('Y')) {
                array_push($data['years'], $start);
                $start += 1;
            }

            $this->load->view('home/dashboard');
            $this->load->view('attendance', $data);
            $this->load->view('home/footer');
        } else {
            $staff = $this->ion_auth->user()->row()->id;
            $this->createNewAttendance();
            $year = $this->db->get('attendance')->result();
            if (!empty($year)) {
                $start = $year[0]->year;
            } else {
                $start = date('Y');
            }

            $current_month = date('F');
            $current_year = date('Y');

            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array6 = $this->db->get('doctor')->result_array();

            $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);
            $data['total_employees'] = count($allEmployees);
            $count = 0;

            foreach ($allEmployees as $employee) {
                $data['employee'][$count] = $employee['ion_user_id'];
                $index = 0;
                $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $current_month, 'year' => $current_year))->row();
                $data['details'][$count][$index] = $this->db->get_where('users', array('id' => $result->staff))->row()->username;
                $index++;
                $total = 0;
                $logs = explode('_', $result->log);
                for ($i = 0; $i < date('t'); $i++) {
                    if (count($logs) >= $i) {
                        if (!empty($logs[$i])) {
                            if ($logs[$i] == 'yes') {
                                $total++;
                                $data['details'][$count][$index] = $logs[$i];
                            } else {
                                $data['details'][$count][$index] = $logs[$i];
                            }
                        }else{
                             $data['details'][$count][$index] = '';
                        }
                        $index++;
                    } else {
                        $data['details'][$count][$index] = '';
                        $index++;
                    }
                }
                $data['details'][$count][$index] = $total;
                $count++;
            }

            $data['years'] = [];
            $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            while ($start <= date('Y')) {
                array_push($data['years'], $start);
                $start += 1;
            }

            $this->load->view('home/dashboard');
            $this->load->view('attendance', $data);
            $this->load->view('home/footer');
        }
    }

    public function createNewAttendance() {
        $current_month = date('F');
        $current_year = date('Y');
        $hospital_id = $this->session->userdata('hospital_id');

        $this->db->select('*');
        $this->db->where('hospital_id', $hospital_id);
        $array1 = $this->db->get('accountant')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $hospital_id);
        $array2 = $this->db->get('laboratorist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $hospital_id);
        $array3 = $this->db->get('receptionist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $hospital_id);
        $array4 = $this->db->get('pharmacist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $hospital_id);
        $array5 = $this->db->get('nurse')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $hospital_id);
        $array6 = $this->db->get('doctor')->result_array();

        $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);

        foreach ($allEmployees as $employee) {
            $log = '';
            $details = '';
            $this->db->where('staff', $employee['ion_user_id']);
            $this->db->where('month', $current_month);
            $this->db->where('year', $current_year);
            $this->db->where('hospital_id', $hospital_id);
            $result = $this->db->get('attendance')->row();

            if (empty($result)) {
                for ($i = 1; $i <= date('d'); $i++) {
                    if ($i != date('d')) {
                        $log .= 'no_';
                        $details .= 'NONE_NONE_NONE_NONE_office#';
                    } else {
                        $log .= 'no';
                        $details .= 'NONE_NONE_NONE_NONE_office';
                    }
                }

                $data = array(
                    'staff' => $employee['ion_user_id'],
                    'month' => $current_month,
                    'year' => $current_year,
                    'log' => $log,
                    'details' => $details,
                    'hospital_id' => $hospital_id
                );

                $this->db->insert('attendance', $data);
            } else {
                $logs = explode('_', $result->log);
                if (count($logs) < date('d')) {
                    $newLog = $result->log;
                    $newDetails = $result->details;
                    $logCount = count($logs) + 1;
                    while ($logCount <= date('d')) {
                        $newLog .= '_no';
                        $newDetails .= '#NONE_NONE_NONE_NONE_office';
                        $logCount++;
                    }

                    $newData = array(
                        'log' => $newLog,
                        'details' => $newDetails,
                        'hospital_id' => $hospital_id
                    );

                    $this->db->where('id', $result->id);
                    $this->db->update('attendance', $newData);
                }
            }
        }
    }

    public function getAttendanceDetails() {
        $date = $this->input->get('date');
        $id = $this->input->get('id');
        $month = date('F', strtotime($date));
        $year = date('Y', strtotime($date));
        $day = explode('-', $date);

        $result = $this->db->get_where('attendance', array('staff' => $id, 'month' => $month, 'year' => $year))->row();

        $details = explode('#', $result->details);

        $detail = explode('_', $details[$day[0] - 1]);

        $data['clock_in'] = $detail[0] == 'NONE' ? '' : $detail[0];
        $data['clock_out'] = $detail[1] == 'NONE' ? '' : $detail[1];
        $data['late'] = $detail[2] == 'late' ? TRUE : FALSE;
        $data['halfday'] = $detail[3] == 'halfday' ? TRUE : FALSE;
        $data['office'] = $detail[4];
        $data['id'] = $result->id;

        echo json_encode($data);
    }

    public function updateAttendance() {
        $date = $this->input->post('date');
        $clock_in = $this->input->post('clock_in');
        $clock_out = $this->input->post('clock_out');
        $late = $this->input->post('late');
        $halfday = $this->input->post('halfday');
        $work_from = $this->input->post('work_from');
        $hospital_id = $this->session->userdata('hospital_id');

        $id = $this->input->post('id');
        $month = date('F', strtotime($date));
        $year = date('Y', strtotime($date));
        $day = explode('-', $date);

        $result = $this->db->get_where('attendance', array('id' => $id))->row();

        $details = explode('#', $result->details);

        $detail = explode('_', $details[$day[0] - 1]);

        $finalDetail = ($clock_in != '' ? $clock_in : 'NONE') . '_' . ($clock_out != '' ? $clock_out : 'NONE') . '_' . ($late == 'late' ? $late : 'NONE') . '_' . ($halfday == 'halfday' ? $halfday : 'NONE') . '_' . ($work_from == '' ? 'office' : $work_from);

        $details[$day[0] - 1] = $finalDetail;

        $detail = implode('#', $details);

        $logs = explode("_", $result->log);

        if ($clock_in != '') {
            $logs[$day[0] - 1] = 'yes';
        }

        $log = implode('_', $logs);

        $data = array(
            'log' => $log,
            'details' => $detail,
            'hospital_id' => $hospital_id
        );

        $this->attendance_model->updateAttendance($id, $data);

        redirect('attendance');
    }

    public function createAttendanceTable() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $month = $this->input->get('month');
            $year = $this->input->get('year');
            $id = $this->input->get('id');

            $totalDay = date('t', strtotime($month . '-' . $year));

            if ($id == 0) {
                $this->db->select('*');
                $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
                $array1 = $this->db->get('accountant')->result_array();
                $this->db->select('*');
                $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
                $array2 = $this->db->get('laboratorist')->result_array();
                $this->db->select('*');
                $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
                $array3 = $this->db->get('receptionist')->result_array();
                $this->db->select('*');
                $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
                $array4 = $this->db->get('pharmacist')->result_array();
                $this->db->select('*');
                $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
                $array5 = $this->db->get('nurse')->result_array();
                $this->db->select('*');
                $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
                $array6 = $this->db->get('doctor')->result_array();

                $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);

                $data = '<div class="col-md-12 attendanceDiv_col">
                        <table class="table table-bordered table-striped table-responsive">
                            <thead class="thead-dark">
                            <th>' . lang('staff') . '</th>';
                for ($i = 1; $i <= $totalDay; $i++) {
                    $data .= '<th class="text_center">' . $i . '</th>';
                }

                $data .= '<th>' . lang('total') . '</th>
                            </thead>
                            <tbody>';

                foreach ($allEmployees as $employee) {
                    $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $month, 'year' => $year))->row();

                    if (!empty($result)) {
                        $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();
                        $totalAttendance = 0;
                        $logs = explode('_', $result->log);
                        $data .= '<tr><td>' . $user->username . '</td>';

                        for ($i = 1; $i <= $totalDay; $i++) {
                            if ($i <= count($logs)) {
                                if ($logs[$i] == 'yes') {
                                    $totalAttendance++;
                                    $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-check" ></i></button></td>';
                                } else {
                                    $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-times" ></i></button></td>';
                                }
                            } else {
                                $data .= '<td></td>';
                            }
                        }


                        $data .= '<td>' . $totalAttendance . '</td></tr>';
                    } else {
                        
                    }
                }

                $data .= '</tbody>
                        </table>
                    </div>';
            } else {
                $result = $this->db->get_where('attendance', array('staff' => $id, 'month' => $month, 'year' => $year))->row();
                if (empty($result)) {
                    $data = '<div class="col-md-12 text-center"> <b>NO DATA FOUND</b> </div>';
                } else {
                    $user = $this->db->get_where('users', array('id' => $id))->row();
                    $totalAttendance = 0;
                    $logs = explode('_', $result->log);

                    $data = '<div class="col-md-12 attendanceDiv_col">
                        <table class="table table-bordered table-striped table-responsive">
                            <thead class="thead-dark">
                            <th>' . lang('staff') . '</th>';
                    for ($i = 1; $i <= $totalDay; $i++) {
                        $data .= '<th class="text_center">' . $i . '</th>';
                    }

                    $data .= '<th>' . lang('total') . '</th>
                            </thead>
                            <tbody>
                            <tr>
                            <td>' . $user->username . '</td>';

                    for ($i = 1; $i <= $totalDay; $i++) {
                        if ($i <= count($logs)) {
                            if ($logs[$i] == 'yes') {
                                $totalAttendance++;
                                $data .= '<td><button class="markAttandance markAttendance_css" data-employee="' . $id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-check"></i></button></td>';
                            } else {
                                $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-times"></i></button></td>';
                            }
                        } else {
                            $data .= '<td></td>';
                        }
                    }
                    $data .= '<td>' . $totalAttendance . '</td></tr>
                </tbody>
                        </table>
                    </div>';
                }
            }
        } else {
            $staff = $this->ion_auth->user()->row()->id;
            $month = $this->input->get('month');
            $year = $this->input->get('year');

            $totalDay = date('t', strtotime($month . '-' . $year));

            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array6 = $this->db->get('doctor')->result_array();

            $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);

            $data = '<div class="col-md-12 attendanceDiv_col">
                        <table class="table table-bordered table-striped table-responsive">
                            <thead class="thead-dark">
                            <th>' . lang('staff') . '</th>';
            for ($i = 1; $i <= $totalDay; $i++) {
                $data .= '<th class="text_center">' . $i . '</th>';
            }

            $data .= '<th>' . lang('total') . '</th>
                            </thead>
                            <tbody>';

            foreach ($allEmployees as $employee) {
                $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $month, 'year' => $year))->row();

                if (!empty($result)) {
                    $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();
                    $totalAttendance = 0;
                    $logs = explode('_', $result->log);
                    $data .= '<tr><td>' . $user->username . '</td>';

                    for ($i = 1; $i <= $totalDay; $i++) {
                        if ($i <= count($logs)) {
                            if ($logs[$i - 1] == 'yes') {
                                $totalAttendance++;
                                $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-check" ></i></button></td>';
                            } else {
                                if ($i >= date('d')) {
                                    $optionMark = "markAttandance";
                                } else {
                                    $optionMark = "";
                                }
                                $data .= '<td><button class="' . $optionMark . '  markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-times" ></i></button></td>';
                            }
                        } else {
                            $data .= '<td></td>';
                        }
                    }


                    $data .= '<td>' . $totalAttendance . '</td></tr>';
                } else {
                    
                }
            }

            $data .= '</tbody>
                        </table>
                    </div>';
        }

        echo json_encode($data);
    }
    function Report()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        // Check permissions properly
        $is_admin = $this->ion_auth->in_group('admin');
        $permissions = $this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Laboratorist', 'Accountant', 'Receptionist', 'Pharmacist'));
        
        // If not admin and not in authorized groups, show clear permissions error
        if (!$permissions) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect('home', 'refresh');
            return; // Exit the function entirely
        }
        
        // At this point, user has permission to continue
        $data['permissions'] = true;
        
        $year = $this->db->get('attendance')->result();
        if (!empty($year)) {
            $start = $year[0]->year;
        } else {
            $start = date('Y');
        }
        $data['years'] = [];
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        while ($start <= date('Y')) {
            array_push($data['years'], $start);
            $start += 1;
        }
        
        // Initialize all variables to avoid undefined errors
        $staff = $this->input->post('staff');
        $r_year = $this->input->post('r_year') ? $this->input->post('r_year') : date('Y');
        $r_month = $this->input->post('r_month') ? $this->input->post('r_month') : date('F');
        
        $data['staff_select'] = $staff;
        $data['year_select'] = $r_year;
        $data['month_select'] = $r_month;
        $data['attendances'] = array(); // Initialize with empty array to avoid errors
        $data['staff_info'] = null;
        $data['total_diff'] = array(); // Initialize to avoid undefined variable errors

        if (!empty($staff)) {
            $user_exists = $this->db->get_where('users', array('id' => $staff))->row();
            if ($user_exists) {
                $data['staff_info'] = $user_exists;
                
                if (!empty($r_month) && !empty($r_year)) {
                    $attendances = $this->attendance_model->getAttendanceByMonth($staff, $r_month, $r_year);
                    if (!empty($attendances)) {
                        $data['attendances'] = $attendances;
                    }
                }
            }
        }
        
        // Hospital ID filtering for staff lists
        $hospital_id = $this->session->userdata('hospital_id');
        
        // Load staff lists with hospital ID filter
        $this->db->where('hospital_id', $hospital_id);
        $data['accountants'] = $this->accountant_model->getAccountant();
        
        $this->db->where('hospital_id', $hospital_id);
        $data['laboratorists'] = $this->laboratorist_model->getLaboratorist();
        
        $this->db->where('hospital_id', $hospital_id);
        $data['receptionists'] = $this->receptionist_model->getReceptionist();
        
        $this->db->where('hospital_id', $hospital_id);
        $data['pharmacists'] = $this->pharmacist_model->getPharmacist();
        
        $this->db->where('hospital_id', $hospital_id);
        $data['nurses'] = $this->nurse_model->getNurse();
        
        $this->db->where('hospital_id', $hospital_id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        
        $this->load->view('home/dashboard');
        $this->load->view('attendance_report', $data);
        $this->load->view('home/footer');
    }
}
