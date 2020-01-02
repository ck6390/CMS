<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* * *****************Backup.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Backup
 * @description     : Backup system database by system adminstrator.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */
class Backup extends Base_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
        
    }
    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load user interface for backup database and take backup database                
    *                    
    * @param           : null integer value
    * @return          : null 
    * ********************************************************** */
    public function index() {        
        
        if ($_POST) {             
            if (IS_LIVE == TRUE) {
              
                $this->load->dbutil();
                $conf = array(
                    'format' => 'zip',
                    'filename' => 'database-backup.sql'
                );
                $backup = & $this->dbutil->backup($conf);
                $this->load->helper('download');
                force_download('database-backup.zip', $backup);
                redirect('admin/backup');
            } else {
                error($this->lang->line('in_demo_db_backup'));
                redirect('admin/backup');
            }
        } else {
            $this->template->set('title', 'Database Backup');
            $this->template->load('template', 'contents', 'backup/index');
            //$this->layout->title($this->lang->line('backup'). ' ' . $this->lang->line('database'). ' | ' . SMS);
           // $this->layout->view('backup/index', $this->data);  
        }
    }
    
    
}
