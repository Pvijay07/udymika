<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="table-responsive">
        <table id="search_table" class="table table-striped table-bordered" style="width:100%;">
            <thead style="background: #F9FAFB; height: 44px !important;">
                <tr>
                    <th>Name</th>
                    <th>Aadhar</th>
                    <th>Date</th>
                    <th>Email </th>
                    <th>Phone </th>
                </tr>
            </thead>
            <tbody>
                <?php echo $tblRow; ?>
            <tbody>
        </table>
    </div>
    <?php $this->load->view('subAdmin/footer'); ?>
</body>
</html>
