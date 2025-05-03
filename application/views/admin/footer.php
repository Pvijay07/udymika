<div class="get-metting dash-board-popup" id="meetingPopup">
    <div class="container" style="width:auto;">
        <form action="<?= base_url("master_meeting_schedule") ?>" method="post" enctype="multipart/form-data">
            <div class="new-doc">
                <h2>Schedule Meeting <span class="closePopCls" id="closePopup">X</span></h2>
            </div>
            <div class="doc-sub">
                <div class="doc-sub-form">
                    <label>Meeting Type*</label>
                    <input name="meeting_type" id="meeting_type" type="text" placeholder="Type" />
                    <input name="meeting_user_id" id="meeting_user_id" type="hidden" value="" />
                    <input name="meeting_multi_user" id="meeting_multi_user" type="hidden" value="" />
                    <input name="meeting_page" id="meeting_page" type="hidden" value="" />
                    <input name="meeting_page_type" id="meeting_page_type" type="hidden" value="" />

                </div>
                <div class="doc-sub-form">
                    <label>Date*</label>
                    <input name="date_time" id="date_time" type="date" class="custom-input" data-validation="required" />
                </div>
                <div class="doc-sub-form col-lg-6">
                    <label>From*</label>
                    <input name="time_from" id="time_from" type="time" class="custom-input" data-validation="required" />
                </div>
                <div class="doc-sub-form col-lg-6">
                    <label>To*</label>
                    <input name="time_to" id="time_to" type="time" class="custom-input" data-validation="required" />
                </div>
                <div class="doc-sub-form col-lg-12">
                    <label>Get Link*</label>
                    <input name="get_link" id="get_link" type="text" class="custom-input" data-validation="required" />
                </div>

                <div class="row">

                    <div class="col-lg-4">
                        <input name="submit" id="meeting_submit" type="button" value="Submit" />
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="<?= base_url("assets/") ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= base_url("assets/") ?>slick/slick.min.js"></script>
<script src="<?= base_url("assets/") ?>js/main.js"></script>
<script src="<?= base_url("assets/") ?>js/jquery.form-validator.js"></script>
<!-- <script src="<?= base_url("assets/") ?>js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url('assets/js/notify.min.js'); ?>"></script>
<script>
    $(function() {
        // setup validate
        $.validate();
    });
</script>

<!-- <script>
    $(document).ready(function() {
        $(document).on('click', '#meeting_submit', function() {
            var meeting_type = $("#meeting_type").val();
            var meeting_user_id = $("#meeting_user_id").val();
            var date_time = $("#date_time").val();
            var time_from = $("#time_from").val();
            var time_to = $("#time_to").val();
            var get_link = $("#get_link").val();
            var meeting_multi_user = $('#meeting_multi_user').val();
            var meeting_page = $('#meeting_page').val();
            var meeting_page_type = $('#meeting_page_type').val();

            if (meeting_type == '') {
                $.notify('Meeting type', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            } else if (date_time == '') {
                $.notify('Select date', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            } else {
                $.ajax({
                    url: '<?php echo base_url('master_meeting_schedule'); ?>',
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        'meeting_type': meeting_type,
                        'meeting_user_id': meeting_user_id,
                        'date_time': date_time,
                        'time_from': time_from,
                        'time_to': time_to,
                        'get_link': get_link,
                        'meeting_multi_user': meeting_multi_user,
                        'meeting_page': meeting_page,
                        'meeting_page_type': meeting_page_type
                    },
                    success: function(data) {
                        let res = $.parseJSON(data);
                        if (res.response == '1') {
                            $("#meetingPopup").hide();
                            $.notify(res.message, {
                                'className': 'success',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                        } else {
                            $.notify(res.message, {
                                'className': 'danger',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                        }
                    }
                })
            }
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#meeting_submit', function() {
            var meeting_type = $("#meeting_type").val();
            var meeting_user_id = $("#meeting_user_id").val();
            var date_time = $("#date_time").val();
            var time_from = $("#time_from").val();
            var time_to = $("#time_to").val();
            var get_link = $("#get_link").val();
            var meeting_multi_user = $('#meeting_multi_user').val();
            var meeting_page = $('#meeting_page').val();
            var meeting_page_type = $('#meeting_page_type').val();

            // Check if any required field is empty
            if (meeting_type === '' || date_time === '' || time_from === '' || time_to === '' || get_link === '') {
                $.notify('All fields are required', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            }

            var selectedDateTime = new Date(date_time + ' ' + time_from);
            var currentDateTime = new Date();

            // Compare selected date and time with current date and time
            if (selectedDateTime <= currentDateTime) {
                $.notify('Selected date and time must be in the future', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            } else {

                var urlPattern = /^(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+(\/[\w\-_]+)*(\/?)(\?.*)?$/;
                if (!urlPattern.test(get_link)) {
                    $.notify('Invalid URL format for Get Link', {
                        'className': 'danger',
                        'position': 'top left',
                        'autoHideDelay': 1500
                    });
                    return false;
                }


                $.ajax({
                    url: '<?php echo base_url('master_meeting_schedule'); ?>',
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        'meeting_type': meeting_type,
                        'meeting_user_id': meeting_user_id,
                        'date_time': date_time,
                        'time_from': time_from,
                        'time_to': time_to,
                        'get_link': get_link,
                        'meeting_multi_user': meeting_multi_user,
                        'meeting_page': meeting_page,
                        'meeting_page_type': meeting_page_type
                    },
                    success: function(data) {
                        let res = $.parseJSON(data);
                        if (res.response == '1') {
                            $("#meetingPopup").hide();
                            $.notify(res.message, {
                                'className': 'success',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                        } else {
                            $.notify(res.message, {
                                'className': 'danger',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                        }
                    }
                });
            }
        });
    });
</script>