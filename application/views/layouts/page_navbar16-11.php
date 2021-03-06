<!-- navbar -->
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<!-- menu -->
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<h3><strong style="color: #fff;">Ganga Memorial</strong></h3>
					<span>
						<?php  
						$this->load->model('setting/general_setting', 'mdl_general_setting');
						$instituteInfo = $this->mdl_general_setting->get('6'); ?>
				            <img class="img-md" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="    border-radius: 17%;">
					</span>
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="clear">
							<span class="block m-t-xs"> <strong class="font-bold"><?= $this->session->userdata['userFullName'] ?></strong></span>
							<span class="text-muted text-xs block"><?= $this->session->userdata['userName'] ?> <b class="caret"></b></span>
						</span>
					</a>
					<ul class="dropdown-menu m-t-xs">
						<li><a href="profile.html">Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?= site_url('main/logout') ?>">Logout</a></li>
					</ul>
				</div>
				<div class="logo-element"> GMCP </div>
			</li>

			<!--condition for dashboard to open on permission value-->

			<?php if($this->session->userdata['roleID'] == '1' || $this->session->userdata['roleID'] == '2'){?>

				<li><a href="<?= site_url('dashboards') ?>">DASHBOARD</a></li>

			<?php }elseif ($this->session->userdata['roleID'] == '1' || $this->session->userdata['roleID'] == '4'){ ?>

				<li><a href="<?= site_url('dashboards/library') ?>">DASHBOARD</a></li>

			<?php }elseif ($this->session->userdata['roleID'] == '1' || $this->session->userdata['roleID'] == '3'){ ?>

				<li><a href="<?= site_url('dashboards/hostel') ?>">DASHBOARD</a></li>

			<?php }elseif ($this->session->userdata['roleID'] == '1' || $this->session->userdata['roleID'] == '5'){ ?>

				<li><a href="<?= site_url('accountants') ?>">DASHBOARD</a></li>

			<?php }elseif($this->session->userdata['roleID'] == '1' || $this->session->userdata['roleID'] == '7'){ ?>

		 		<li><a href="<?= site_url('super_admin') ?>">DASHBOARD</a></li>
		 		<li>
					<a href="<?= site_url('super_admin/emp_leave_request') ?>"> LEAVE REQUEST</a>
				</li>
				<li>
					<a href="<?= site_url('super_admin/leave_status') ?>">LEAVE STATUS</a>
				</li>
				<!--li>
					<a href="<?= site_url('super_admin/extra_salary') ?>">EXTRA SALARY</a>
				</li> -->
				<li>
						<a href="<?= site_url('admin/users') ?>"> USERS</a>
				</li>
				<li>
						<a href="<?= site_url('super_admin/employees') ?>"> Employee List</a>
				</li>
				<li>
						<a href="<?= site_url('super_admin/subject_unit') ?>"> SUBJECT UNIT</a>
				</li>

				<li>
						<a href="<?= site_url('super_admin/active_semesters') ?>"> ACTIVE SEMESTER </a>
				</li>
				
				<li>
					<a href="#"><span class="nav-label">STUDENT ATTENDANCE</span><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level collapse">
						<li>
							<a href="<?= site_url('super_admin/student_subject_attandance') ?>"> Subject Wises</a>
						</li>
						<li>
							<a href="<?= site_url('super_admin/student_branch_attandance') ?>"> Branch Wise</a>
						</li>
						<li>
							<a href="<?= site_url('super_admin/student_attandance') ?>"> Date wise </a>
						</li>
					</ul>
				</li>

		    <?php }elseif($this->session->userdata['roleID'] == '1' || $this->session->userdata['roleID'] == '9'){ ?>
		    	<li><a href="<?= site_url('principal_desk') ?>">DASHBOARD</a></li>
		    	<li><a href="<?= site_url('attandance_bio') ?>">UPDATE ATTANDANCE</a></li>
				<li>
					<a href="#"><span class="nav-label">PRINCIPAL DESK</span><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level collapse">
						<li>
							<a href="<?= site_url('principal_desk') ?>"> Attendance List</a>
						</li>
						<li>
							<a href="<?= site_url('principal_desk/academic_progress') ?>"> Academic Progress</a>
						</li>
					</ul>
				</li>
		   <?php  } ?>
			
			<!--------------------------------------------->
			<!-- Super Admin -->
			

			<?php if($this->session->userdata['roleName']=="Developer" || $this->session->userdata['roleName']=="Admin"){ ?>
			<!-- students -->
			<li>
				<a href="#"><i class="fa fa-group"></i> <span class="nav-label">STUDENTS</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li>
						<a href="<?= site_url('students/add') ?>"> Add Student</a>
					</li>
					<li>
						<a href="<?= site_url('students') ?>"> Student List</a>
					</li>
				</ul>
			</li>

			<!-- master -->
			<li>
				<a href="#"><i class="fa fa-graduation-cap"></i><span class="nav-label">ACADEMIC</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<!-- Add subject master -->
					<li>
						<a href="#"> <span class="nav-label">Subject</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('academics/subjects/add') ?>"> Add subject</a>
							</li>
							<li>
								<a href="<?= site_url('academics/subjects') ?>"> Subject List</a>
							</li>
						</ul>
					</li>

					<!-- Add subject master -->
					<li>
						<a href="#"> <span class="nav-label">Subject Unit</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('academics/subject_units/add') ?>"> Add Unit</a>
							</li>
							<li>
								<a href="<?= site_url('academics/subject_units') ?>"> Unit List</a>
							</li>
						</ul>
					</li>
					<!-- Dates -->
					<li>
						<a href="#"><span class="nav-label">Form Notification</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('academics/form_notifications/add') ?>"> Add Notification</a>
							</li>
							<li>
								<a href="<?= site_url('academics/form_notifications') ?>"> Notification List</a>
							</li>
						</ul>
					</li>

					<!-- period -->
					<li>
						<a href="#"> <span class="nav-label">Period</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('academics/periods/add') ?>"> Add Period</a>
							</li>
							<li>
								<a href="<?= site_url('academics/periods') ?>"> Period List</a>
							</li>
						</ul>
					</li>
					<!-- <li>
						<a href="#"><span class="nav-label">Routine</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('routines/add') ?>">Routine Add</a>
							</li>
							<?php $_semesters = $this->mdl_semester->get_all();
							
								foreach($_semesters as $semester){
									?>
									<li>
										<a href="<?php echo site_url("routines/index/{$semester->semester_p_id}"); ?>"><?php echo $semester->semester_name; ?></a>
									</li>
							<?php } ?>
						</ul>
					</li> -->

					<!-- <li>
						<a href="#"><span class="nav-label">Lectures</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('academics/lectures/add') ?>">Lecture Add</a>
							</li>
							<li>
								<a href="<?= site_url('academics/lectures') ?>">Lecture List</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="<?= site_url('academics/temporary_lectures') ?>">Temporary Lecture</a>
					</li>
					 -->
					<!-- student promotion -->
					<li>
						<a href="<?= site_url('academics/student_promotions') ?>"> <span class="nav-label">Student Promotion</span></a>
					</li>
				</ul>
			</li>

			<!-- Accounting management system -->
			<li>
				<a href="#"><i class="fa fa-money"></i><span class="nav-label">FEE & FINES</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<!-- fee structure -->
					<!-- <li>
						<a href="#"><span class="nav-label">Fee Structure</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li>
								<a href="<?= site_url('accounting/fee_structures/add') ?>"> Add Fee Structure</a>
							</li>
							<li>
								<a href="<?= site_url('accounting/fee_structures') ?>"> Fee Structure List</a>
							</li>
						</ul>
					</li> -->

					<!-- Common Fine -->
					<li>
						<a href="#"> <span class="nav-label">Common Fine</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li>
								<a href="<?= site_url('accounting/common_fines/add') ?>"> Add Common Fine</a>
							</li>
							<li>
								<a href="<?= site_url('accounting/common_fines') ?>"> Student Fine List</a>
							</li>
						</ul>
					</li>
					<!-- fee type -->
					<li>
						<a href="#"><span class="nav-label">Fee Group</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('accounting/fee_groups/add') ?>"> Add Fee Group</a>
							</li>
							<li>
								<a href="<?= site_url('accounting/fee_groups') ?>"> Fee Group List</a>
							</li>
						</ul>
					</li>

					<!-- fee type category-->
					<li>
						<a href="#"><span class="nav-label">Fee Type</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('accounting/fee_types/add') ?>"> Add Fee</a>
							</li>
							<li>
								<a href="<?= site_url('accounting/fee_types') ?>"> Fee List</a>
							</li>
						</ul>
					</li>
					<!-- Invoice-->
					<li>
						<a href="#"><span class="nav-label">Invoice</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('accounting/invoices/college_fee') ?>"> Generate Invoice</a>
							</li>
							<li>
								<a href="<?= site_url('accounting/invoices') ?>"> Invoice List</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			
			<li>
				<a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">SETTINGS</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<!-- session -->
					<li>
						<a href="#"><span class="nav-label">SESSION</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/sessions/add') ?>"> Add Session</a>
							</li>
							<li>
								<a href="<?= site_url('setting/sessions') ?>"> Session List</a>
							</li>
						</ul>
					</li>
					<!-- branch -->
					<li>
						<a href="#"><span class="nav-label">BRANCH</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/branches/add') ?>"> Add Branch</a>
							</li>
							<li>
								<a href="<?= site_url('setting/branches') ?>"> Branch List</a>
							</li>
						</ul>
					</li>
					<!-- semester -->
					<li>
						<a href="#"><span class="nav-label">SEMESTER</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/semesters/add') ?>"> Add Semester</a>
							</li>
							<li>
								<a href="<?= site_url('setting/semesters') ?>"> Semester List</a>
							</li>
						</ul>
					</li>
					<!-- Course Year -->
					<li>
						<a href="#"><span class="nav-label">COURSE YEAR</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/course_years/add') ?>"> Add Course Year</a>
							</li>
							<li>
								<a href="<?= site_url('setting/course_years') ?>"> Course Year List</a>
							</li>
						</ul>
					</li>

					<!-- Block Master -->
					<li>
						<a href="#"> <span class="nav-label">BUILDING</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/buildings/add') ?>"> Add Building</a>
							</li>
							<li>
								<a href="<?= site_url('setting/buildings') ?>"> Building List</a>
							</li>
						</ul>
					</li>
					<!-- Block Master -->
					<li>
						<a href="#"> <span class="nav-label">BLOCK</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/blocks/add') ?>"> Add Block</a>
							</li>
							<li>
								<a href="<?= site_url('setting/blocks') ?>"> Block List</a>
							</li>
						</ul>
					</li>

					<!-- Floor master -->
					<li>
						<a href="#"> <span class="nav-label">FLOOR</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/floors/add') ?>"> Add Floor</a>
							</li>
							<li>
								<a href="<?= site_url('setting/floors') ?>"> Floor List</a>
							</li>
						</ul>
					</li>

					<!-- Payment Mode -->
					<li>
						<a href="#"> <span class="nav-label">PAYMENT MODE</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/payment_modes/add') ?>"> Add Payment mode</a>
							</li>
							<li>
								<a href="<?= site_url('setting/payment_modes') ?>"> Payment mode List</a>
							</li>
						</ul>
					</li>

					<!-- Payment Mode -->
					<li>
						<a href="#"> <span class="nav-label">DEBIT PURPOSE</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/debit_purposes/add') ?>"> Add Debit Purpose</a>
							</li>
							<li>
								<a href="<?= site_url('setting/debit_purposes') ?>"> Debit Purpose List</a>
							</li>
						</ul>
					</li>
					<!-- Cast Category -->
					<li>
						<a href="#"> <span class="nav-label">CAST CATEGORY</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('setting/cast_categories/add') ?>"> Add Cast Category</a>
							</li>
							<li>
								<a href="<?= site_url('setting/cast_categories') ?>"> Cast Category List</a>
							</li>
						</ul>
					</li>
					<!-- General Setting -->
					<li>
						<a href="<?= site_url('setting/general_settings') ?>"> <span class="nav-label">General Setting</span></a>
					</li>
					<li>
						<a href="<?= site_url('setting/sms_settings') ?>"> <span class="nav-label">SMS Setting</span></a>
					</li>

				</ul>
			</li>
			<?php 
				} elseif($this->session->userdata['roleID'] == '1' || $this->session->userdata['roleID'] == '11'){
			?>
			<li>
				<a href="#"><i class="fa fa-graduation-cap"></i><span class="nav-label">VISITOR & SMS</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">

					<li>
						<a href="#"> <span class="nav-label">SMS</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">

							<li>
								<a href="<?= site_url('sms') ?>"> SMS List</a>
							</li>
							<li>
								<a href="<?= site_url('sms/send_sms') ?>"> Send SMS</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"> <span class="nav-label">VISITOR</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">

							<li>
								<a href="<?= site_url('visitors') ?>"> Visitor List</a>
							</li>
							<li>
								<a href="<?= site_url('visitors/add') ?>"> Add Visitor</a>
							</li>
						</ul>
					</li>
					
				</ul>
			</li>

			<?php } ?>
			<?php if($this->session->userdata['roleName']=="Developer" || $this->session->userdata['roleName']=="Accountant"){ ?>
			<li>
				<a href="#"><i class="fa fa-graduation-cap"></i><span class="nav-label">ACCOUNT</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">

					<li>
						<a href="<?= site_url('accountants/student_list') ?>"> Student List</a>
					</li>
					<li>
						<a href="#"> <span class="nav-label">Dues Fee</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">

							<li>
								<a href="<?= site_url('accountants/hostel_room_due/17') ?>"> Due List Hostel</a>
							</li>
							<li>
								<a href="<?= site_url('accountants/hostel_fooding_due/18') ?>"> Due List Fooding</a>
							</li>
							<li>
								<a href="<?= site_url('accountants/academic_fee_due') ?>"> Academic Fee Dues</a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="<?= site_url('accountants/day_statement') ?>"> Day Statement</a>
					</li>
					<li>
						<a href="<?= site_url('accountants/debit') ?>"> Debit</a>
					</li>
					<li>
						<a href="<?= site_url('accountants/debit_statement') ?>"> Debit Statement</a>
					</li>
				</ul>
			</li>
			<?php } ?>
			
			<!-- Hostel Management -->
			<?php if($this->session->userdata['roleName']== "Hostel" || $this->session->userdata['roleName']=="Developer"){ ?>
			<li>
				<a href="#"><i class="glyphicon glyphicon-home"></i><span class="nav-label">HOSTEL</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					
					<!-- Add Room master -->
					<li>
						<a href="#"> <span class="nav-label">Room</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('hostel/rooms/add') ?>"> Add Room</a>
							</li>
							<li>
								<a href="<?= site_url('hostel/rooms') ?>"> Room List</a>
							</li>
						</ul>
					</li>
					<!-- Allotted Room -->
					<li>
						<a href="#"> <span class="nav-label">Allotted Room</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('hostel/allotted_rooms') ?>"> Allotted Room List</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="<?= site_url('hostel/hostel_student') ?>"> Student Hostel List</a>
					</li>
					<!-- Invoice-->
					<li>
						<a href="#"><span class="nav-label">Invoice</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('hostel/hostel_invoices/add') ?>"> Generate Invoice</a>
							</li>
							<li>
								<a href="<?= site_url('hostel/hostel_invoices') ?>"> Invoice List</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<?php }  ?>

			<!-- Library management system -->
			<?php if($this->session->userdata['roleName']== "Library" || $this->session->userdata['roleName']=="Developer"){ ?>
			<li>
				<a href="#"><i class="fa fa-university"></i><span class="nav-label">LIBRARY</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					
					<!-- Add Book category -->
					<li>
						<a href="#"> <span class="nav-label">Book Category</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('library/book_categories/add') ?>"> Category Add</a>
							</li>
							<li>
								<a href="<?= site_url('library/book_categories') ?>"> Category List</a>
							</li>
						</ul>
					</li>
					<!-- Add Book -->
					<li>
						<a href="#"> <span class="nav-label">Book</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('library/books/add') ?>"> Add Book</a>
							</li>
							<li>
								<a href="<?= site_url('library/books') ?>"> Book List</a>
							</li>
						</ul>
					</li>

					<!-- Add Book Type-->
					<li>
						<a href="#"> <span class="nav-label">Book Type</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('library/book_types/add') ?>">Book Type Add</a>
							</li>
							<li>
								<a href="<?= site_url('library/book_types') ?>"> Book Type List</a>
							</li>
						</ul>
					</li>

					<!-- Add Book Source-->
					<li>
						<a href="#"> <span class="nav-label">Book Source</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('library/book_sources/add') ?>">Book Source Add</a>
							</li>
							<li>
								<a href="<?= site_url('library/book_sources') ?>"> Book Source List</a>
							</li>
						</ul>
					</li>
					<!-- Book Issue-->
					<li>
						<a href="#"> <span class="nav-label">Issued Book</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('library/book_issues') ?>">Book List</a>
							</li>
							<li>
								<a href="<?= site_url('library/book_issues/guest_book_list') ?>">Guest Book List</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="<?= site_url('library/library_student') ?>"> Library Student List</a>
					</li>
					<!-- setting issued book date-->
					<li>
						<a href="<?= site_url('library/book_issues/setting') ?>"> Setting</a>
					</li>
				</ul>
			</li>
			<?php } ?>


			<?php if($this->session->userdata['roleName']== "Admin"|| $this->session->userdata['roleName']=="Developer" ){ ?>

			<li >
				<a href="#"><i class="fa fa-user"></i> <span class="nav-label">EMPLOYEE & STAFF</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li>
						<a href="#"> <span class="nav-label">Employee</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							
							<li>
								<a href="<?= site_url('employees') ?>">Employee List</a>
							</li>
						
							<li>
								<a href="<?= site_url('employees/add') ?>">Add Employee</a>
							</li>
						</ul>
					</li>
					<!--li>
						<a href="#"> <span class="nav-label">Attadance</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('attendance/set_attendance') ?>">Set Attadance</a>
							</li>
							<li>
								<a href="<?= site_url('attendance/attendance_report') ?>">Attendance Report</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"> <span class="nav-label">Payroll</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level collapse">
							<li>
								<a href="<?= site_url('payrolls') ?>">List Payment</a>
							</li>
							<li>
								<a href="<?= site_url('payrolls/make_payment') ?>">Make Payment</a>
							</li>
						</ul>
					</li -->
				</ul>
			</li >
			
			<!-- office -->
			<li>
				<a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">OFFICE SETTINGS</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li>
						<a href="<?= site_url('office/department') ?>">Department</a>
					</li>
					<li>
						<a href="<?= site_url('office/designation') ?>">Designation</a>
					</li>
					<!-- <li>
						<a href="<!?= site_url('office/pay_grade') ?>">Pay Grade</a>
					</li> -->
					<!-- <li>
						<a href="<?= site_url('office/salary_component') ?>">Salary Component</a>
					</li> -->
					<li>
						<a href="<?= site_url('office/employment_type') ?>">Employment Type</a>
					</li>
					<li>
						<a href="<?= site_url('office/employee_type') ?>">Employee Type</a>
					</li>
					<!-- <li>
						<a href="<?= site_url('office/work_shift') ?>">Work Shift</a>
					</li> -->
					<li>
						<a href="<?= site_url('office/leave_type') ?>">Leave Type</a>
					</li>
					<li>
						<a href="<?= site_url('office/holiday_list') ?>">Holiday List</a>
					</li>
					<!-- <li>
						<a href="<?= site_url('office/working_day') ?>">Working Days</a>
					</li> -->
					<!-- <li>
						<a href="<?= site_url('office/attributes') ?>">Attributes</a>
					</li> -->	
					<li>
						<a href="<?= site_url('office/bank') ?>">Company Account</a>
					</li>
					
				</ul>
			</li>

			<?php } ?>

			<?php if($this->session->userdata['roleID']=='1'){ ?>
			<li>
				<a href="#"><i class="fa fa-user"></i> <span class="nav-label">ADMIN</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li>
						<a href="<?= site_url('admin/users') ?>"> USERS</a>
					</li>
					<li>
						<a href="<?= site_url('admin/roles') ?>"> ROLES</a>
					</li>
					<li>
						<a href="<?= site_url('admin/permissions') ?>"> PERMISSIONS</a>
					</li>
					
				</ul>
			</li>
			<?php } ?>
			<!-- Users Master -->
		<?php if($this->session->userdata['roleID'] == '7'){ ?>
			<li><a href="<?= site_url('super_admin/appraisal') ?>" class="text-uppercase">Appraisal Lists</a></li>
		<?php }?>
		</ul>
		<!-- /sidemenu -->
	</div>
	<!-- /.sidebar-collapse -->
</nav>
<!-- /navigation
