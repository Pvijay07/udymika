<?php
 
$config['pagination']['page_query_string'] = TRUE;
$config['pagination']['uri_segment']     = 2;              
$config['pagination']['per_page']        = RECORDS_PER_PAGE;
$config['pagination']['prev_link']       = '<img src="assets/images/left-arrow.png"> Previous';
$config['pagination']['next_link']       = 'Next <img src="assets/images/right-arrow.png">';
$config['pagination']['first_link']      = '<img src="assets/images/left-arrow.png"> Previous';
$config['pagination']['last_link']       = 'Next <img src="assets/images/right-arrow.png">';
$config['pagination']['full_tag_open'] 	 = '<div class="table-paginations"><ul>';
$config['pagination']['full_tag_close']  = '</ul></div>';
$config['pagination']['num_tag_open'] 	 = '<li class="active">';
$config['pagination']['num_tag_close'] 	 = '</li>';
$config['pagination']['cur_tag_open'] 	 = '<li class="active2">';
$config['pagination']['cur_tag_close'] 	 = '</li>';
$config['pagination']['next_tag_open'] 	 = '<li class="cls1">';
$config['pagination']['next_tag_close']  = '</li>';
$config['pagination']['prev_tag_open'] 	 = '<li class="cls2">';
$config['pagination']['prev_tag_close']  = '</li>';
$config['pagination']['first_tag_open']  = '<li class="cls3">';
$config['pagination']['first_tag_close'] = '</li>';
$config['pagination']['last_tag_open'] 	 = '<li class="cls4">';
$config['pagination']['last_tag_close']  = '</li>';
?>