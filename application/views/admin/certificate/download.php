<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF </title>
</head>
<body>
    <div class="table-responsive">
        <table id="search_table" class="table table-striped table-bordered" style="width:100%;">
            <thead style="background: #F9FAFB; height: 44px !important;">
                <tr>
                    <th>Name</th>
                    <th>Aadhar No</th>
                    <th>Date Of Submission</th>
                    <th>Email </th>
                    <th>Phone </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($tblRow as $certificate_id)
        		{
        			$datas = $this->db->query("SELECT enterprise.user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at,users.updated_at FROM enterprise LEFT JOIN option3 on enterprise.id = option3.enterprise_id LEFT JOIN users ON enterprise.user_id = users.id WHERE option3.id = '$certificate_id'")->row();
        			?>
        			<tr> <td><?php echo $datas->name; ?></td> <td><?php echo $datas->adhaar_no; ?></td> <td><?php echo date('M d Y', strtotime($datas->updated_at)); ?></td>  <td><?php echo $datas->email; ?> </td> <td><?php echo $datas->phone; ?> </td></tr>
        			
        		<?php }  ?>
            <tbody>
        </table>
    </div>
    <?php //$this->load->view('admin/footer'); ?>
</body>
</html>
