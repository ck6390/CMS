
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <meta name="description" content="">
        <!-- tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <!-- jQuery -->
        <script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
        <!-- bootstrap -->
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
        <!-- style css -->
        <link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
         <script type="text/javascript">
        window.print();
    </script>
    </head>

<body class="white-bg">
    <div class="row">
            <div class="col-lg-12">
                <div class="col-sm-6">
                    <table class="table table-bordered m-b-none">
                        <tbody>
                            <tr>
                                <td>
                     <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                     <img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="width:100px;">
                       
                        <h3 style="text-align:center;margin-bottom:20px;margin-top:0px;"><span class="text-success" > <?php echo $instituteInfo->inst_name; ?></span>
                        </h3>
                        <p class="text-center">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110, Ph 0612-2237111, 9473000022</p>
                          </td>  
                        </tr>
                        <tr class="text-center">
                            <td>Student Copy</td>
                        </tr>
                    </tbody>
                    </table>
                    <table class="table table-bordered m-b-none">
                        <tbody>
                            <tr>
                               <td><strong>Invoice No.</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->invoice_id; ?></strong></h4></td>
                               <td><strong> Student Name</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $info->student_full_name; ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td><strong>Student Id</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4></td>
                               <td><strong> Father's Name</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $info->father_name; ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td><strong>Registration No.</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->registration_no; ?></strong></h4></td>
                               <td><strong> Date of admission</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $this->misc->reformatDate($info->admission_date); ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td colspan="3"><strong>Fee Type/Details</strong></td>
                               <td><strong>Amount(INR)</strong></td>
                            </tr>
                                    <tr>
                                        
                                        <td colspan="3"><div><strong><?php echo $info->fee_type_name ." For ".$info->hostel_charge_month; ?></strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->fee_amount; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3" class="text-right"><div><strong>SUB TOTAL </strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->fee_amount; ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <td colspan="3" class="text-right"><div><strong>DUE AMOUNT </strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->due_amount; ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <td colspan="3" class="text-right"><div><strong>PAYBLE AMOUNT </strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->due_amount; ?></td>
                                    </tr>
                        </tbody>
                    </table>
                    <div class="well">
                        <div class="row">
                        <div class="col-sm-8">
                            <strong> 
                           Subject to realization of cheque/DD <br>
                        T&C will be applicable as per admission form<br>
                         Computer generated receipt after final fee payment</strong>
                        </div>
                        <div class="col-sm-4">
                            <p>Authorised signature</p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <table class="table table-bordered m-b-none">
                        <tbody>
                            <tr>
                                <td>
                     <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                     <img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="width:100px;">
                       
                        <h3 style="text-align:center;margin-bottom:20px;margin-top:0px;"><span class="text-success" > <?php echo $instituteInfo->inst_name; ?></span>
                        </h3>
                        <p class="text-center">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110, Ph 0612-2237111, 9473000022</p>
                          </td>  
                        </tr>
                        <tr class="text-center">
                            <td>Office Copy</td>
                        </tr>
                    </tbody>
                    </table>
                    <table class="table table-bordered m-b-none">
                        <tbody>
                            <tr>
                               <td><strong>Invoice No.</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->invoice_id; ?></strong></h4></td>
                               <td><strong> Student Name</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $info->student_full_name; ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td><strong>Student Id</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4></td>
                               <td><strong> Father's Name</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $info->father_name; ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td><strong>Registration No.</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->registration_no; ?></strong></h4></td>
                               <td><strong> Date of admission</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $this->misc->reformatDate($info->admission_date); ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td colspan="3"><strong>Fee Type/Details</strong></td>
                               <td><strong>Amount(INR)</strong></td>
                            </tr>
                                    <tr>
                                        
                                        <td colspan="3"><div><strong><?php echo $info->fee_type_name ." For ".$info->hostel_charge_month; ?></strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->fee_amount; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"><div><strong>SUB TOTAL </strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->fee_amount; ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <td colspan="3" class="text-right"><div><strong>DUE AMOUNT </strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->due_amount; ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <td colspan="3" class="text-right"><div><strong>PAYBLE AMOUNT </strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i>  <?php echo $info->due_amount; ?></td>
                                    </tr>
                        </tbody>
                    </table>
                    <div class="well">
                        <div class="row">
                        <div class="col-sm-8">
                            <strong> 
                           Subject to realization of cheque/DD <br>
                        T&C will be applicable as per admission form <br>
                         Computer generated receipt after final fee payment</strong>
                        </div>
                        <div class="col-sm-4">
                            <p>Authorised signature</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>    
</body>

</html>