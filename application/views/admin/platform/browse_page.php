<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 31 Jan 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $platforms
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
            <li><a href="<?=site_url('admin/platform/browse');?>">Home</a></li>
            <li class="active"><i class="fa fa-desktop fa-fw"></i> Platforms</li>
        </ol>

        <div class="row">
            <div id="main" class="col-lg-12">
                <h1 class="page-header">Platforms</h1>

                <p class="lead">Click on a 'row' to view a Platform record.</p>
                <?php $this->load->view('admin/_snippets/message_box');?>
                <?php if( ! $platforms) $this->load->view('admin/_snippets/no_records_box'); ?>

                <div class="row">
                    <div class="col-md-12">

                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($platforms as $key=>$platform): ?>
                                <tr class="clickable" onclick="goto_view(<?=$platform['platform_id'];?>)">
                                    <td><?=$platform['platform_name'];?></td>
                                    <td><?=$platform['platform_description'];?></td>
                                    <td data-sort="<?=format_dd_mm_yyyy_hh_ii_ss($platform['last_updated']);?>"
                                        ><?=$platform['last_updated'];?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

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

    function goto_view(platform_id)
    {
        location.href = '<?=site_url("admin/platform/view");?>/' + platform_id;
    }
</script>
</body>
</html>