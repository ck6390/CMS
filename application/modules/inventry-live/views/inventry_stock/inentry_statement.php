<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory Statement'); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory'); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', 'Inventory Statement'); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
	</div>
</div>
		<style>
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
            border-top: 1px solid #000 !important;

        }
        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
            border: 1px solid #555 !important;

        }
        .custom-form{
        	width: 155px !important;
        }
	</style>
<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'form',
		'class' => 'form-horizontal'
	);
	echo form_open("inventry/{$this->misc->_getClassName()}/inentry_statement", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Inventory Statement Report</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">								
								<div class="col-sm-3">
									<div class=" <?php if(form_error('stock_id')) echo 'has-error'; ?>">
									<?php echo form_label('Stock Type<small class="text-danger">*</small>', 'stock_id', array('class' => ' control-label')); ?>
										<div class="input-group">
											<?php 
										$dropdown[null] = '== Please select one option ==';
										$dropdown['All'] = 'All';
										foreach ($stocks as $stock) {
                                           $dropdown[$stock->sid]=$stock->stock_name;
										}
										echo form_dropdown(array(
											'name' => 'stock_id',
											'class' => 'form-control',
											'required' => 'true'
										), $dropdown);

										echo form_error('stock_id'); ?>
										</div>
									</div>	
								</div>

								<div class="col-sm-3">
									<div class=" <?php if(form_error('start_date')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('From Date<small class="text-danger">*</small>', 'start_date', array('class' => 'control-label')); ?>
										<div class="input-group">
											<?php 
												echo form_input(array(
													'type' => 'date',
													'name' => 'start_date',
													'id' => 'month_from', 
													'class' => 'form-control',
													'required' => 'true',
													'value' => set_value('start_date')
												));
											?>
										</div>
										<?php echo form_error('start_date'); ?>
									</div>
								</div>
								<div class="col-sm-2">
									<div class=" <?php if(form_error('end_date')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('To Date<small class="text-danger">*</small>', 'end_date', array('class' => 'control-label')); ?>
										<div class="input-group ">
											<?php 
												echo form_input(array(
													'type' => 'date',
													'name' => 'end_date',
													'id' => 'month_to', 
													'class' => 'form-control custom-form',
													'required' => 'true',
													'value' => set_value('end_date')

												));
											?>
											
										</div>
										<?php echo form_error('end_date'); ?>
									</div>
								</div>
								<div class="col-sm-1 text-center">
									<div style="margin-top:10px;">
										<?php 
										echo form_submit('submit', 'Go', 'class="btn btn-sm m-t  btn-primary"'); ?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
	<?php if(!empty($infos)): ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
				<h5><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory Statement'); ?></span> </h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table id="inventry_statement" class="table table-striped table-bordered table-hover ">	
						  <thead>								
								<tr>
									<th>Stock Name</th>
									<th>Agency Name</th>
									<th>Bill Ref. No</th>
									<th>Payment Mode</th>
									<th>Payment Date</th>
									<th>Quantity</th>
									<th>Per Unit Price</th>
									<th>Paid Amount</th>
								</tr>
							</thead>
							<tfoot>
					            <tr>
					                <th colspan="7" style="text-align:right">Filter Total: - </th>
					                <th></th>
					            </tr>
					        </tfoot>
							<tbody>
							<?php foreach ($infos as $info) :?>
								
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td id="total1"><?php echo $info->stock_name; ?> </td>
									<td id="total1"><?php echo $info->agency_name; ?> </td>
									<td><?php echo $info->bill_ref_no; ?> </td>
									<td>
										<?= $this->mdl_pay_mode->get($info->pay_mode)->payment_mode_name; ?>
									</td>
									<td><?php echo $info->stock_on_date; ?> </td>
									<td><?php echo $info->quantity; ?> </td>
									<td><?php echo $info->purchase_price; ?> </td>
									<td><?php echo $info->total_amount; ?> </td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>

<script type="text/javascript">
	$(document).ready(function () {
	var from = $('#month_from').val();
	var to = $('#month_to').val();
	if(to == ""){
		to = new Date();
	}

    $('#inventry_statement').dataTable({
    	<?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
    	dom: 'Bfrtip',
	    buttons: [
	       
	        { 
	        	extend: 'print' ,
	         	footer:true, 
	         	title: '',
	         	 
	        message: '<table style="margin-top:0;padding-top:0;"class="table table-bordered"><tbody><tr><td><img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>"  style="float:left;border:0;padding:10px;width:100px;height:80px;"><div style="width:80%;float:left;text-align:center;display:table;"><h3 style="text-align:center;font-size:20px;margin-bottom:10px;padding-top:8px;"> Ganga Memorial College Of Polytechnic</h3><p >AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p></div></td></tr></tbody></table>',

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
	        }
	    ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;
                //console.log(data);

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            //Total over all pages
            // total = api.column(7)
            //     .data()
            //     .reduce(function (a, b) {
            //     return intVal(a) + intVal(b);
            // });

            //Total over this page
            pageTotal = api.column(7, {
                page: 'current'
            })
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            //Total over this page
            pageTotalFilter = api.column(7, {
                filter: 'applied'
            })
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            /*$(api.column(6).footer()).html(
                '' + pageTotal + ' <br/>' + total );*/
            $(api.column(7).footer()).html(
                '' + pageTotalFilter);
        }
    });

    $('#inventry_statement tbody').on('click', 'tr', function () {

        $(this).toggleClass('selected');
    });

});
</script>