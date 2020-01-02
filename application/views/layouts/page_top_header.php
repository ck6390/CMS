<!-- top-header -->
<div id="page-wrapper" class="gray-bg">
	<div class="row border-bottom">
		<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			</div>
			<ul class="nav navbar-top-links navbar-right">
			<li style="margin-right: 50px;">
					<?php 
						if($this->session->userdata['roleID']==7 || $this->session->userdata['roleID']==2 || $this->session->userdata['roleID']==1){
							if($this->session->userdata['ex_date']){
				                $notification = "Your license will expire in ";
				                $days = "days";
				                $expiry = date_create($this->session->userdata['ex_date']);
				                $current_date = date_create(date('d-m-Y'));		
				                $diff = date_diff($current_date,$expiry);                
								$interval = $diff->format("%a");
				                if($interval <= $this->config->item('exp_days') )
				                {
				                     echo "<p class='btn btn-danger'><strong>".$notification." <span class='badge badge-info'>".$interval."</span> ".$days."</strong></p>";
				                }
				                   
							 }
						}
					?>
				
				</li>
				<li>
					<span class="m-r-sm text-muted welcome-message">Welcome to Ganga Memorial College Of Polytechnic.<strong class="text-success"><?= ($this->session->userdata['isDeveloper'] == '1') ? ' [DEVELOPER MODE] ' : '' ?></strong></span>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>index.php/main/logout">
						<i class="fa fa-sign-out"></i> Log out
					</a>
				</li>
			</ul>
		</nav>
	</div>
