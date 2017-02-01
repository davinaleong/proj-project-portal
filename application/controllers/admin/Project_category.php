<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Project_category.jpg
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 01 Feb 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Project_category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Project_category_model');
	}
	
	public function index()
	{
	    redirect('admin/project_category/browse');
	}

    public function browse()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'project_categories' => $this->Project_category_model->get_all(),
            'create_uri' => 'admin/project_category/create'
        );
        $this->load->view('admin/project_category/browse_page', $data);
    }

    public function create()
    {
        $this->User_log_model->validate_access();
        $this->_set_rules_create();
        if($this->form_validation->run())
        {
            if($pc_id = $this->Project_category_model->insert($this->_prepare_create_array()))
            {
                $this->User_log_model->log_message('Project Category created. | pc_id: ' . $pc_id);
                $this->session->set_userdata('message', 'Project Category created. <a href="' . site_url() . '/admin/project_category/create">Create another.</a>');
                redirect('admin/project_category/browse');
            }
            else
            {
                $this->User_log_model->log_message('Unable to create Project Category.');
                $this->session->set_userdata('Unable to create Project Category.');
            }
        }
        $this->load->view('admin/project_category/create_page');
    }

    private function _set_rules_create()
    {
        $this->form_validation->set_rules('pc_name', 'Name', 'trim|required|max_length[512]');
        $this->form_validation->set_rules('pc_description', 'Description'. 'trim|required|max_length[512]');
    }

    private function _prepare_create_array()
    {
        $project_category = array();
        $project_category['pc_name'] = $this->input->post('pc_name');
        $project_category['pc_description'] = $this->input->post('pc_description');
        return $project_category;
    }

    public function edit($pc_id)
    {
        $this->User_log_model->validate_access();
        $project_category = $this->Project_category_model->get_by_id($pc_id);
        if($project_category)
        {
            $this->_set_rules_edit();
            if($this->form_validation->run())
            {
                if($this->Project_category_model->update($this->_prepare_edit_array($project_category)))
                {
                    $this->User_log_model->log_message('Project Category updated. | pc_id: ' . $pc_id);
                    $this->session->set_userdata('message', 'Project Category updated.');
                    redirect('admin/project_category/browse');
                }
                else
                {
                    $this->User_log_model->log_message('Unable to update Project Category. | pc_id: ' . $pc_id);
                    $this->session->set_userdata('message', 'Unable to updated Project Category.');
                }
            }

            $data = array(
                'project_category' => $project_category
            );
            $this->load->view('admin/project_category/edit_page', $data);
        }
        else
        {
            $this->session->set_userdata('message', 'Project Category not found.');
            redirect('admin/project_category/browse');
        }
    }

    private function _set_rules_edit()
    {
        $this->form_validation->set_rules('pc_name', 'Name', 'trim|required|max_length[512]');
        $this->form_validation->set_rules('pc_description', 'Description', 'trim|required|max_length[512]');
    }

    private function _prepare_edit_array($project_category)
    {
        $project_category['pc_name'] = $this->input->post('pc_name');
        $project_category['pc_description'] = $this->input->post('pc_description');
        return $project_category;
    }

    public function delete($pc_id)
    {
        $this->User_log_model->validate_access();
        if($this->Project_category_model->get_by_id($pc_id))
        {
            if($this->Project_category_model->delete_by_id($pc_id))
            {
                $this->User_log_model->log_message('Project Category deleted. | pc_id: ' . $pc_id);
                $this->session->set_userdata('message', 'Project Category deleted.');
            }
            else
            {
                $this->User_log_model->log_message('Unable to delete Project Category. | pc_id: ' . $pc_id);
                $this->session->set_userdata('message', 'Unable to delete Project Category.');
            }
            redirect('admin/project_category/browse');
        }
        else
        {
            $this->session->set_userdata('message', 'Project Category record not found.');
            redirect('admin/project_category/browse');
        }
    }
	
} // end Project_category controller class