<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Library_student
 */

class Library_student extends Base_Controller
{
	/**
	 * Book_issues Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('book_issue', 'mdl_book_issue');
		$this->load->model('book_category', 'mdl_book_category');
		$this->load->model('book', 'mdl_book');
		$this->load->model('accounting/fee_type', 'mdl_fee_type');
		$this->load->model('accounting/fee_group', 'mdl_fee_group');
		$this->load->model('students/student', 'mdl_student');
		$this->load->module('setting/semesters');
		
	}

	/**
	 * Fetch all Book_issues list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_student->get_branch_session();
		//$data['info'] = $this->mdl_student->get_all();
		$this->template->set('title', 'Issued Book List');
		$this->template->load('template', 'contents', 'library_student/library_student_list', $data);
	}

	/**
	 * Library Student Profile.
	 * @return void [load view page]
	 */
	public function profile($id)
	{
		$this->template->set('title', 'Library Student Profile');
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['book_lists'] = $this->mdl_book_issue->active_issued_book($id);
		$data['lists'] = $this->mdl_student->get($id);
		//$data['manual_return_list'] = $this->mdl_book_issue->get_issued_book_list($id);
		//print_r($data['book_lists']); exit;
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
		$this->template->load('template', 'contents', 'library_student/library_student_profile',$data);
	}

	public function book_info_model()
	{
		$bookIssueId = $_POST["bookIssueId"];
		$studentUniqueId = $_POST["studentUniqueId"];
		//print_r($bookIssueId);
		$data['result']= $this->mdl_book_issue->student_active_book($bookIssueId);
		//print_r($data);
		foreach ($data as  $obj) {
			$fine_amount = $this->mdl_fee_type->get($obj->fine_type_id)->fee_type_amount;
            $date1 = new DateTime($obj->return_date);
            $date2 = new DateTime("now");
            if($date1 > $date2){
                $date_over = $date2->diff($date2);
            }else{
                $date_over = $date1->diff($date2);
            }
            $fine_days = $date_over->format('%a');
            $fine =  $fine_days * $fine_amount;
            $total_fine = $fine-$obj->library_fine;

            if($obj->paid_status == "paid"){ 
                $library_fine_amount = $obj->library_fine;
            }elseif($obj->paid_status == "unpaid"){
                $library_fine_amount = $fine;
            } elseif($obj->paid_status == "partial"){
                $library_fine_amount = $total_fine;
            }



            if($obj->paid_status == "paid" && $obj->is_active == '1'){ 

            	$btn = anchor('library/library_student/book_return/'.$obj->student_id.'/'.$obj->acc_no.'/'.$obj->book_issue_p_id.'','<i class="fa fa-undo"></i>Return','class="btn btn-primary btn-xs"');

           	}elseif($obj->paid_status != "paid" && $obj->is_active == '1'){

           		if($fine > 0){
            		$btn = '<span class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Go To Account</span>';
        	}else{ 

        		$btn = '<div class="text-center">
								<button onclick="verify_student(1'.$studentUniqueId.')" class="badge student_verify badge-primary">Click To Verify</button>
								<br>
								<span id="successMessage" class="student_verify"> </span>
							</div>'.
							anchor('library/library_student/book_return/'.$obj->student_id.'/'.$obj->acc_no.'/'.$obj->book_issue_p_id.'','<i class="fa fa-undo"></i>Return','class="btn rtrn_btn btn-primary m-t btn-xs"');
        	 } 
        	}
			echo "<table class='table table-striped table-bordered table-hover'>
				<tbody>
					<tr>
						<td> <strong>Student Id</strong></td>
		 				<td><strong>".$studentUniqueId."</strong></td>
		 			</tr>
					<tr>
						<td> <strong>Accession No.</strong></td>
		 				<td><strong>".$obj->acc_no."</strong></td>
		 			</tr>
		 			<tr>
						<td><strong>Book Title </strong></td>
		 				<td><strong>".$obj->book_name."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Book Issue Date</strong> </td>
		 				<td><strong>".$obj->issue_date."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Return Date</strong></td>
		 				<td><strong>".$obj->return_date."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Fine Amount</strong></td>
		 				<td><strong>". $library_fine_amount ."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Paid Status </strong></td>
		 				<td><strong>". $obj->paid_status ."</strong></td>
		 			</tr>
		 			<tr>
		 				<td class='text-center' colspan='2'><strong>".$btn."</strong></td>
		 			</tr>

				</tbody>
			</table>";
		}
		
	}
	/**
	 * Issued book history of student.
	 * @return void [load view page]
	 */
	public function issue_history($id)
	{

		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['lists'] = $this->mdl_book_issue->get_issued_book_list($id);
		//print_r($data['lists']);
		// $data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
		$this->template->set('title', 'History Issued Book');
		$this->template->load('template', 'contents', 'library_student/issued_book_history', $data);
	}

	/**
	 * Issue a Book By Profile.
	 * @return void [load view page]
	 */
	public function book_issue($id)
	{
		$this->form_validation->set_rules('book-accession', 'Accession No.', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_student->get($id);
			//$data['lists'] = $this->mdl_book_issue->get_issued_book_list($id);
			// $data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);

			$this->template->set('title', 'Issue A Book');
			$this->template->load('template', 'contents', 'library_student/book_issue', $data);

		} else {

			$date = $this->input->post('issue-date');
			$return_date = date('Y-m-d', strtotime($date. '+ 6 days'));
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				
				'acc_no' => $cleanPost['book-accession'],
				'student_id' => $id,
				'issue_date' => date('Y-m-d'),
				'return_date' => $return_date,
				'fine_type_id' => '19',
				'issue_mode' => 'biometric',
				'created_by' => $this->session->userdata['roleID']
			);
			// print_r($formData);
			// exit;

			//check admission status 
			//

			$student_id = $formData['student_id'];
			if ($this->mdl_student->checkAdmissionStatus($student_id) == true){

				$this->session->set_flashdata('error', "Error, Can't issue a book. Your Admission Status is pending!");
				redirect('library/library_student/profile/'.$id, 'refresh');
			}

			//check limitation of book issue
			$student_id = $formData['student_id'];
			if ($this->mdl_book_issue->checkBookLimit($student_id) == true){

				$this->session->set_flashdata('error', "Error, Can't issue a book. You have already issue two books!");
				redirect('library/library_student/profile/'.$id, 'refresh');
			}

			//check book status return or not
			$book_id = $formData['acc_no'];
			if ($this->mdl_book_issue->check_status($book_id, $id) == true){

				$this->session->set_flashdata('error', "Error, Can't issue a book. Please submit this book first!");
				redirect('library/library_student/profile/'.$id, 'refresh');
			}

			//check book stock
			$book_id = $formData['acc_no'];
			if ($this->mdl_book->check_stock($book_id) == true){

				$this->session->set_flashdata('error', "Error, No book stock available for issue!");
				redirect('library/library_student/profile/'.$id, 'refresh');
			}
			
			// insert to database
			if($this->mdl_book_issue->insert($formData) == true) {
				//update book stock
				$bookID = $cleanPost['book-accession'];
				$formData1 = array(
					'stock' => $cleanPost['stock'] - '1',
				);
				$this->mdl_book->update($formData1, $bookID); 

				$this->session->set_flashdata('success', "Success, Issue a book successfully!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't issue a book!");
			}
			redirect('library/library_student/profile/'.$id, 'refresh');
		}
	}

	/**
	 * [Return a book from the student profile]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function book_return($student_id, $book_id, $book_issue_id)
	{
		$bookReturn = array(
				'is_active' => '0',
				'paid_status' => 'paid',
				'library_fine' => '0.00',
				'submit_date' => date('Y-m-d'),
		);
		//print_r($bookReturn); exit;
		$stock = $this->mdl_book->get($book_id)->stock;
		//print_r($stock);exit;
		$book = array(

			'stock' => $stock + '1',
		);

		if($this->mdl_book_issue->update($bookReturn, $book_issue_id) == true && $this->mdl_book->update($book, $book_id) == true) {
			
			$this->session->set_flashdata('success', "Success, Return successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't Return!");
		}
		redirect('library/library_student/profile/'.$student_id, 'refresh');
	}

	/**
	 * Issue a Book By Profile.
	 * @return void [load view page]
	 */
	public function mannual_issue($id)
	{
		$this->form_validation->set_rules('book-accession', 'Accession No.', 'required|trim');
		$this->form_validation->set_rules('book-title', 'Book Title', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_student->get($id);
			$data['lists'] = $this->mdl_book_issue->get_issued_book_list($id);
			// $data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);

			$this->template->set('title', 'Mannual Issue Book');
			$this->template->load('template', 'contents', 'library_student/mannual_book_issue', $data);

		} else {

			$date = date('Y-m-d');
			$return_date = date('Y-m-d', strtotime($date. '+ 7 days'));

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$bookID = $cleanPost['book-id'];
			$formData = array(
				
				'acc_no' => $cleanPost['book-accession'],
				'student_id' => $id,
				'issue_date' => $date,
				'return_date' => $return_date,
				'fine_type_id' => '19',
				'issue_mode' => 'mannual',
				'created_by' => $this->session->userdata['roleID']
			);
			//print_r($formData); exit;

			//check admission status 
			$student_id = $formData['student_id'];
			if ($this->mdl_student->checkAdmissionStatus($student_id) == true){

				$this->session->set_flashdata('error', "Error, Can't issue a book. Your Admission Status is pending!");
				redirect('library/library_student/mannual_issue/'.$id, 'refresh');
			}

			//check limitation of book issue
			$student_id = $formData['student_id'];
			if ($this->mdl_book_issue->checkBookLimit($student_id) == true){

				$this->session->set_flashdata('error', "Error, Can't issue a book. You have already issue two books!");
				redirect('library/library_student/mannual_issue/'.$id, 'refresh');
			}

			//check book status return or not
			
			if ($this->mdl_book_issue->check_status($bookID, $id) == true){

				$this->session->set_flashdata('error', "Error, Can't issue a book. Please submit this book first!");
				redirect('library/library_student/mannual_issue/'.$id, 'refresh');
			}

			//check book stock
			
			if ($this->mdl_book->check_stock($bookID) == true){

				$this->session->set_flashdata('error', "Error, No book stock available for issue!");
				redirect('library/library_student/mannual_issue/'.$id, 'refresh');
			}
			
			
			// insert to database
			if($this->mdl_book_issue->insert($formData) == true) {
				//update book stock
				
				//print_r($bookID); exit;
				$formData1 = array(
					'stock' => $cleanPost['stock'] - '1',
				);
				
				$this->mdl_book->update($formData1, $bookID); 
				$this->session->set_flashdata('success', "Success, Issue a book successfully!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't issue a book!");
			}
			redirect('library/library_student/mannual_issue/'.$id, 'refresh');
		}
	}

	/**
	 * Mannual Issued book history of student.
	 * @return void [load view page]
	 */
	public function mannual_book_history($id)
	{

		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['lists'] = $this->mdl_book_issue->get_mannual_book_history($id);
		// $data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
		$this->template->set('title', 'Mannual Book History');
		$this->template->load('template', 'contents', 'library_student/mannual_book_history', $data);
	}

	/**
	 * [Return a book from the student profile]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function mannual_book_return($student_id, $book_id, $book_issue_id)
	{
		//print_r($book_issue_id); exit;
		
		$this->form_validation->set_rules('book-title', 'Category name', 'required|trim');
		$this->form_validation->set_rules('issue-date', 'Category name', 'required|trim');
		$this->form_validation->set_rules('submit-date', 'Category name', 'required|trim');

		if($this->form_validation->run() == false) {
			
			$data['info'] = $this->mdl_student->get($student_id);
			$data['lists'] = $this->mdl_book_issue->bookReturn($book_issue_id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($student_id);
			$this->template->set('title', 'Mannual Return Book');
			$this->template->load('template', 'contents', 'library_student/mannual_book_return', $data);
			//print_r($data['lists']);exit;

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

				$bookReturn = array(
					'library_fine' => $cleanPost['fine'],
					'submit_date' => date('Y-m-d'),
					'is_active' => '0'
				);
				//print_r($bookReturn); exit;

			$book = array(

				'stock' => $cleanPost['stock'] + '1',
			);

			if($cleanPost['fine'] == 0){

				$paidStatus = array(
					'paid_status' => 'paid',
				);
			}else{
				$paidStatus = array(
					'paid_status' => 'unpaid',
				);
			}
			//print_r($paidStatus); exit;
			
			if($this->mdl_book_issue->update($bookReturn, $book_issue_id) == true && $this->mdl_book->update($book, $book_id) == true) {
				$this->mdl_book_issue->update($paidStatus, $book_issue_id);
				$this->session->set_flashdata('success', "Success, Return successfully!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't Return!");
			}
			redirect('library/library_student/mannual_issue/'.$student_id, 'refresh');
		}
	}

	/**
	 * [add library fine for student]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function add_fine($id)
	{	
		$this->form_validation->set_rules('fee-type', 'Fee Type', 'required|trim');
		$this->form_validation->set_rules('fee-group', 'Fee Group', 'required|trim');
		$this->form_validation->set_rules('amount', 'Fee Amount', 'required|trim');
		$this->form_validation->set_rules('due-on', 'Due On', 'required|trim');

		if($this->form_validation->run() == false) {

			$data['info'] = $this->mdl_student->get($id);
			$data['lists'] = $this->mdl_student->get_fine_list($id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
			$this->template->set('title', 'Library Fee/Fine');
			$this->template->load('template', 'contents', 'library_student/library_fee_fine_add',$data);

		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'fee_type_id' => 	$cleanPost['fee-type'],
				'student_id' => $id,
				'fine_amount' => $cleanPost['amount'],
				'due_date' => $cleanPost['due-on'],
				'remarks' => $cleanPost['remarks'] ? $cleanPost['remarks'] : null,
				'created_by' => $this->session->userdata['roleID'],
			);

			// insert to database
			if($this->db->insert('fee_allocates',$formData)) {
				$this->session->set_flashdata('success', "Success, New Fine has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new Fine!");
			}
			redirect('library/library_student/add_fine/'.$id, 'refresh');
		}
		
	}
}

/* End of file Library_student.php */
/* Location: ./application/modules/library/controllers/Library_student.php */
