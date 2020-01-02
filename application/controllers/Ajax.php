<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Ajax extends CI_Controller {
    /*     * **************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : this function load login view page            
     * @param           : null; 
     * @return          : null 
     * ********************************************************** */
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('academics/subject_unit','mdl_unit');
        $this->load->model('super_admin/Mdl_sub_units', 'mdl_sub_unit'); 
        $this->load->model('Mdl_ajax','mdl_ajax');  

    }

    public function index() {        
        
    
    }

    public function emp_subject_unit()
    {
        $subjectID = $_POST['subjectID'];
        //$empID = $_POST['empID'];
        $_all_unit = $this->mdl_ajax->get_all_unit();
        $unit_onSubject = $this->mdl_ajax->unit_onSubject($subjectID);
        
        
        //print_r($unit_onSubject);
        
        $_allunits = array(); 
        $_unitOnSubjects = array();
        foreach($_all_unit as $units){

            $_allunits[] = $units->subject_unit_p_id;
        }
       
        
        foreach($unit_onSubject as $subject_unit){

            $_unitOnSubjects[] = $subject_unit->unit_id;
        }
        //print_r($_unitOnSubjects);
        $results=array_diff($_allunits,$_unitOnSubjects);
        $result = array();
        foreach($results as $key => $value){

            $data = array(

                'subject_unit_p_id' => $value,
                'is_active' => '1'
            );
            $this->db->select('subject_unit_p_id,unit_number')->from('subject_units')->where($data);
            $query = $this->db->get();
            $result[] = $query->row();
        }
        //print_r($result);
        //$out = array_values($result);
        echo json_encode($result);
        //$dropdown = "<select name='unit-id'></select>";
    }


    public function unit_details()
    {

        $unitID = $_POST['unitID'];
        $empID = $_POST['empID'];
        $subjectID = $_POST['subjectID'];  

        $data = array(
            'fk_emp_id' => $empID,
            'fk_subject_id' => $subjectID,
            'unit_id' => $unitID
        );

        $details = $this->mdl_sub_unit->get_unit_details($data); 
        //echo json_encode($details);
        echo $details->start_date;
        //echo "<input type='text' readonly='true'>$details->start_date</input>";
    }

    public function subject_Att_record()
    {
        $studentId = $_POST['studentId'];
        $subjectId = $_POST['subjectId'];
            
        $data = array(
           
           'fk_subject_id' => $subjectId,
        );

        $lists = $this->mdl_ajax->subject_subAtt_record($data,$studentId);
        
            echo "<table class='table table-striped table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>ROLL NUMBER</th>
                                        <th>STUDENT ID</th>
                                        <th>STUDENT NAME</th>
                                        <th>ATTENDANCE</th>
                                    </tr>
                                </thead>
                                <tbody>";
                $i=0;
                foreach ($lists as $list){ $i++;
                    echo    "<tr>
                                        <td>".$i."</td>
                                        <td>".$list->lacture_date."</td>
                                    </tr>";
                }
                echo "</tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>ROLL NUMBER</th>
                                        <th>STUDENT ID</th>
                                        <th>STUDENT NAME</th>
                                        <th>ATTENDANCE</th>
                                    </tr>
                                </tfoot>
                            </table>";

    }


    public function subject_list()
    {

        $branchID = $_POST['branchID'];
        $semester = $_POST['semester'];

        $data = array(
            'fk_branch_id' => $branchID,
            'fk_semester_id' => $semester,
        );

        $details = $this->mdl_ajax->subject_lists($data); 
        echo json_encode($details);   
    }

    public function lecture_unit()
    {
        $branchID = $_POST['branchID'];
        $semester = $_POST['semester'];
        $subject = $_POST['subject'];

        $data = array(
            'fk_branch_id' => $branchID,
            'fk_semester_id' => $semester,
            'fk_subject_id' => $subject,
            
        );

        $details = $this->mdl_ajax->lecture_units($data); 
        echo json_encode($details);
    }

    public function lecture_unit_detail()
    {
        $branchID = $_POST['branchID'];
        $semester = $_POST['semester'];
        $subject = $_POST['subject'];
        $unit = $_POST['unitID'];

        $data = array(
            'fk_branch_id' => $branchID,
            'fk_semester_id' => $semester,
            'fk_subject_id' => $subject,
            'unit_id' => $unit
        );

        

        $details = $this->mdl_ajax->lecture_unit_details($data); 
        echo json_encode($details);

    }
}