<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>Academic Fee Dues</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize">Unpaid Fee</span></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table id="accademicFeeDue" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Session Year</th>
									<th>Student Id</th>
									<th>Student Name</th>
									<th>Fee Type</th>
									<th>Due Amount</th>
									<th>Payment status</th>
								
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="8"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) { $i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td><?= '<strong> '.htmlspecialchars($list->session_name ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->student_unique_id ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list->student_full_name ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list->fee_type_name ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									
									<td>
										
										<?php 

											if($list->paid_status == "unpaid"){
	                                            $academicDue = $list->fee_amount;
	                                        }else{
	                                        	 $academicDue = $list->fee_amount - 	$list->due_amount;
	                                        }

	                                        echo $academicDue;
										?>
									</td>

									<td><?= '<strong> '.htmlspecialchars($list->paid_status,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>									
									
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
					            <tr>
					                <th colspan="5" style="text-align:right">Filter Total: - <br/> All Total</th>
					                <th></th>
					                <th></th>
					            </tr>
					        </tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>    
</div>
<style type="text/css">
	.dt-buttons{
		float: right !important;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
	
    $('#accademicFeeDue').DataTable ( {
    	<?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
       	dom: 'Bfrtip',
	    buttons: [
	       
	        { 
	        	extend: 'print' ,
	         	footer:true, 
	         	title: '',
	         	 
	         	message: '<table style="margin-top:0;padding-top:0;"class="table table-bordered"><tbody><tr><td><img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>"  style="float:left;border:0;padding:0;width:100px; height:80px;"><div style="width:80%;float:left;text-align:center;display:table;"><h3 style="text-align:center;font-size:20px;margin-bottom:10px;padding-top:8px;"> Ganga Memorial College Of Polytechnic</h3><p >AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p></div></td></tr><tr class="text-center"><td> Hostel Room Due</td><tr></tr></tbody></table>',

	         customize: function ( win ) {
	                $(win.document.body)
	                    .css( 'font-size', '10px' )
	                    .css( 'margin-left', '80px' )
	                    .css( 'margin-top', '0px' )
	                $(win.document.body).find( 'table tbody tr td' )
	            	 .css( 'padding', '2px' )
	            	 .css( 'font-size', '12px')
	                $(win.document.body).find( 'table thead' )
	                	 .css( 'font-size', '12px' )
	                $(win.document.body).find( 'table tfoot' )
	                    .css( 'display','table-row-group');
	                $(win.document.body).find( 'table tfoot' )
	                     .css( 'font-size', '12px' )
	            }
	        },
	        { extend: 'csv',footer: true },
			{ extend: 'excel',footer: true},
	    ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over all pages
            total = api.column(5)
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            });

            // Total over this page
            pageTotal = api.column(5, {
                page: 'current'
            })
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            // Total over this page
            pageTotalFilter = api.column(5, {
                filter: 'applied'
            })
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            /*$(api.column(6).footer()).html(
                '' + pageTotal + ' <br/>' + total );*/
            $(api.column(5).footer()).html(
                '' + pageTotalFilter+'.00 <span class="hidden"> - </span>' + ' <br/>' + total + '.00');
        }
    } );
} );
</script>