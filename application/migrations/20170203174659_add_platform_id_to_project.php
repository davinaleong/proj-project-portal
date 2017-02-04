<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20170203174659_add_platform_id_to_project.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 03 Feb 2017
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 03 Feb 2017, 05:46PM
 * 20170203174659
 */
class Migration_Add_platform_id_to_project extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
        $this->load->model('Migration_model');
        echo '<h1>Migration: Add \'project_icon\' Field</h1>';
        echo '<hr/>';
        echo '<p>Running Up Script...</p>';
        echo '<p style="text-align: center;">- start of script -</p>';
        echo '<div style="border: thin solid #ddd; border-radius: 2px; background: #eee; padding:5px;"><code>';
        echo $this->Migration_model->run_parsed_sql($this->_up_script())['output_str'];
        echo '</code></div>';
	}
	
	public function down()
	{
        $this->load->model('Migration_model');
        echo '<h1>Migration: Add \'project_icon\' Field</h1>';
        echo '<hr/>';
        echo '<p>Running Down Script...</p>';
        echo '<p style="text-align: center;">- start of script -</p>';
        echo '<div style="border: thin solid #ddd; border-radius: 2px; background: #eee; padding:5px;"><code>';
        echo $this->Migration_model->run_parsed_sql($this->_down_script())['output_str'];
        echo '</code></div>';
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$sql = "
			ALTER TABLE `project` ADD COLUMN `platform_id` INT(4) NOT NULL;
		";
		return $sql;
	}
	
	private function _down_script()
	{
		$sql = "
			ALTER TABLE `project` DROP COLUMN `platform_id`;
		";
		return $sql;
	}
	
} // end 20170203174659_add_platform_id_to_project class