<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 04 Feb 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $link_categories
 * @var $create_uri
 */
?><!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/_snippets/meta'); ?>
<?php $this->load->view('admin/_snippets/head_resources_datatables'); ?>
</head>
<body>
<div id="wrapper">
<?php $this->load->view('admin/_snippets/navbar'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="<?=site_url('admin/link_category/browse');?>">Home</a></li>
            <li class="active">Link Categories</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">
                <h1 class="page-header text-info"><i class="fa fa-file-text-o fa-fw"></i> Link Categories</h1>

                <?php $this->load->view('admin/_snippets/message_box');?>
                <?php if( ! $link_categories) $this->load->view('admin/_snippets/no_records_box'); ?>

                <div class="row">
                    <div class="col-md-12">

                        <table id="dataTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Project</th>
                                <th>Date Added</th>
                                <th>Last Updated</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($link_categories as $key=> $link_category): ?>
                                <tr>
                                    <td><?=$link_category['lc_name'];?></td>
                                    <td><?=$link_category['lc_description'];?></td>
                                    <td><a href="<?=site_url('admin/project/view/' . $link_category['project_id']);?>" target="_blank"><?=$link_category['project_name'];?></a></td>
                                    <td data-sort="<?=format_dd_mm_yyyy_hh_ii_ss($link_category['date_added']);?>"
                                    ><?=format_dd_mmm_yyyy($link_category['date_added']);?></td>
                                    <td data-sort="<?=format_dd_mm_yyyy_hh_ii_ss($link_category['last_updated']);?>"
                                    ><?=format_rfc($link_category['last_updated']);?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-default" href="<?=site_url('admin/link_category/edit/' . $link_category['lc_id']);?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                                            <button class="btn btn-default" onclick="save_delete_id(<?=$link_category['lc_id'];?>)"
                                                    data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash fa-fw" data-toggle="tooltip" title="Delete"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal start -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-danger" id="delete_modal_label"><i class="fa fa-exclamation-triangle"></i>&nbsp;Delete Link Category Record</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert"><strong>This action cannot be undone.</strong></div>
                        <p>Do you still want to delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button id="delete_btn" class="btn btn-danger" onclick="do_delete()">
                            <i class="fa fa-trash-o fa-fw"></i> Delete</button>
                        <button id="cancel_delete_btn" type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-ban fa-fw"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal end -->

        <?php $this->load->view('admin/_snippets/footer'); ?>
    </div>
</div>
</div>
<?php $this->load->view('admin/_snippets/body_resources_datatables'); ?>
<script>
    $(document).ready(function()
    {
        $('#dataTable').DataTable({
            "order": [[2, 'desc']],
            "responsive": true
        });
    });

    function goto_view(record_id)
    {
        location.href = '<?=site_url("admin/link_category/edit");?>/' + record_id;
    }

    var delete_lc_id = 0;
    function save_delete_id(delete_id)
    {
        delete_lc_id = delete_id;
    }

    function do_delete()
    {
        location.href = '<?=site_url("admin/link_category/delete");?>/' + delete_lc_id;
    }
</script>
</body>
</html>