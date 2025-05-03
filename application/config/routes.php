<?php
defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
date_default_timezone_set ( 'Asia/Kolkata' );
//$route['default_controller'] = 'home';
$default_controller          = 'home';
$route['default_controller'] = "$default_controller";

$controller_exceptions = array( "home", "test", "mandals", "villages", "login", "register", "forgot", "success", "logout" );

foreach ( $controller_exceptions as $v ) {
  $route[$v]           = "$default_controller/" . $v;
  $route[$v . "/(.*)"] = "$default_controller/" . $v . '/$1';
}


/**------------------------------------ User dashboard ---------------------------------**/
$route['user_forgot_otp']           = 'home/forgot_password';
$route['user_forgot_otp_verify']    = 'home/forgot_password_otp_verify';
$route['forgot_pass_success']       = 'home/forgot_password_sucess';
$route['login_by_otp']              = 'home/login_with_contact_number';
$route['login_otp_send']            = 'home/user_login_by_otp';
$route['login_otp_verify']          = 'home/user_otp_login_verify';
$route['user_register']             = 'home/register_otp_send';
$route['verify_register_otp']       = 'home/register_verify_otp';
$route['get_chat_list']             = 'User/get_chat_by_ticket';
$route['password_update']           = 'home/user_pass_update';
$route['password_submit']           = 'home/user_password_submited';
$route['user_grievance_sts_update'] = 'home/user_grievance_status_update';



/**------------------------------Mobile APIs routing start ----------------------------**/
$route['m_login']                  = 'User_account_api';
$route['m_register']               = 'User_account_api/register';
$route['m_verify_otp']             = 'User_account_api/register_otp_verify';
$route['m_forgot_otp']             = 'User_account_api/forgot_password';
$route['m_forgot_pass']            = 'User_account_api/forgot_pass_otp_verify';
$route['m_otp_login']              = 'User_account_api/login_with_mobile_number';
$route['m_otp_login_verify']       = 'User_account_api/login_verify_with_otp';
$route['m_otp_register']           = 'User_account_api/register_with_mobile_number';
$route['m_otp_register_verify']    = 'User_account_api/registeration_verify_with_otp';
$route['m_get_profile']            = 'User_profile_api/user_profile_details';
$route['m_mandal_list']            = 'User_profile_api/get_mandal_list';
$route['m_gram_panchayat']         = 'User_profile_api/get_gram_panchayat_list';
$route['m_district']               = 'User_profile_api/get_district_list';
$route['m_update_kyc']             = 'User_profile_api/update_kyc';
$route['m_have_an_idea']           = 'User_profile_api/enterprise_have_an_idea';
$route['m_develop_an_idea']        = 'User_profile_api/enterprise_develop_an_idea';
$route['m_have_existing_business'] = 'User_profile_api/enterprise_have_existing_business';
$route['m_my_profile_pic']         = 'User_profile_api/user_profile_pic_update';
$route['m_add_grievanace']         = 'User_grievanace_api/add_new_grievanace';
$route['m_grievanaces_list']       = 'User_grievanace_api/grievanaces_listing';
$route['m_add_chat_query']         = 'User_grievanace_api/new_chat_create';
$route['m_chat_by_grievanace']     = 'User_grievanace_api/chat_detil_by_grievance';
$route['m_add_documents']          = 'User_grievanace_api/add_new_documents';
$route['m_document_list']          = 'User_grievanace_api/document_list_by_users';
$route['m_meeting_list']           = 'User_grievanace_api/get_meeting_list';
$route['m_dashboard_count']        = 'User_grievanace_api/get_dashboar_counts';
$route['m_my_account_status']      = 'User_grievanace_api/get_dashboar_account_status';
/**------------------------------ Mobile Sub admin APIs routing end ----------------------**/









$route['m_subAdmin_login_otp']           = 'subAdmin/Sub_admin_account_api/admin_login_otp';
$route['m_subAdmin_login_verify_otp']    = 'subAdmin/Sub_admin_account_api/admin_login_verify_otp';
$route['m_subAdmin_pic_update']          = 'subAdmin/Sub_admin_account_api/admin_profile_pic_update';
$route['m_subAdmin_profile_detail']      = 'subAdmin/Sub_admin_account_api/admin_profile_details';
$route['m_subAdmin_assign_users']        = 'subAdmin/Sub_admin_other_api/admin_user_assign_list';
$route['m_subAdmin_assign_user_details'] = 'subAdmin/Sub_admin_other_api/admin_assigned_user_details';
$route['m_subAdmin_checklist']           = 'subAdmin/Sub_admin_other_api/admin_checklist';
$route['m_subAdmin_verify_users']        = 'subAdmin/Sub_admin_other_api/admin_user_verify_list';
$route['m_subAdmin_app_verify']          = 'subAdmin/Sub_admin_other_api/user_application_verify_details';
$route['m_subAdmin_app_dashboard']       = 'subAdmin/Sub_admin_other_api/admin_app_dashboard';
$route['m_subAdmin_verify_submit']       = 'subAdmin/Sub_admin_other_api/admin_verify_application_app';
$route['m_subAdmin_monthly_app']         = 'subAdmin/Sub_admin_other_api/admin_monthly_application_process';
$route['m_subAdmin_sector_wise']         = 'subAdmin/Sub_admin_other_api/admin_sector_wise_application';
$route['m_subAdmin_sector_report']       = 'subAdmin/Sub_admin_other_api/sector_wise_application';
$route['m_subAdmin_status_track']        = 'subAdmin/Sub_admin_other_api/admin_application_status_track';
$route['m_subAdmin_kyc_status']          = 'subAdmin/Sub_admin_other_api/admin_kyc_status_track';
$route['m_subAdmin_status_update']       = 'subAdmin/Sub_admin_other_api/admin_status_update_app';
$route['m_subAdmin_sector_wise_data']    = 'subAdmin/Sub_admin_other_api/admin_app_count_sector';
$route['m_subAdmin_district_wise_data']  = 'subAdmin/Sub_admin_other_api/admin_app_count_district';
$route['m_subAdmin_get_verify_data']     = 'subAdmin/Sub_admin_other_api/admin_verify_answer_datas';
/**----------------------------- Mobile Sub admin APIs routing start ----------------------------------**/
/**-------------------------------- Mobile APIs routing end ----------------------**/













/**------------------------------ Super admin routing start --------------------------------**/
$route['master_login']                                   = 'admin/Auth/login';
$route['master_logout']                                  = 'admin/Auth/logout';
$route['master_dashboard']                               = 'admin/AdminDashboard/index';
$route['master_kyc']                                     = 'admin/AdminKyc_ctr/index';
$route['master_kyc_verify']                              = 'admin/AdminKyc_ctr/kyc_verified';
$route['master_kyc_rejected']                            = 'admin/AdminKyc_ctr/kyc_rejects';
$route['master_kyc_details/(:num)']                      = 'admin/AdminKyc_ctr/kyc_details/$1';
$route['master_kyc_sts_update']                          = 'admin/AdminKyc_ctr/kyc_status_updates';
$route['master_kyc_downloada']                           = 'admin/AdminKyc_ctr/kyc_downloads';
$route['master_certificate']                             = 'admin/AdminCertificate_ctr/index';
$route['master_certificate_progess']                     = 'admin/AdminCertificate_ctr/progress_list';
$route['master_certificate_verify']                      = 'admin/AdminCertificate_ctr/field_verify_list';
$route['master_certificate_interview']                   = 'admin/AdminCertificate_ctr/interview_schedule_list';
$route['master_rest_certificate']                        = 'admin/AdminCertificate_ctr/rest_certificate_list';
$route['master_certificate_details/(:num)/(:num)']       = 'admin/AdminCertificate_ctr/certificates_details/$1/$2';
$route['master_certif_check_detail/(:num)/(:num)']       = 'admin/AdminCertificate_ctr/certificates_details_with_checklist/$1/$2';
$route['master_admin_assign_sts']                        = 'admin/AdminCertificate_ctr/certificates_assign_sub_admin';
$route['master_interview_schedule_upd']                  = 'admin/AdminCertificate_ctr/interview_schedule_status_upd';
$route['master_certificate_downloada']                   = 'admin/AdminCertificate_ctr/certificate_downloads';
$route['master_grievance']                               = 'admin/AdminGrievance_ctr/index';
$route['master_grievance_progress']                      = 'admin/AdminGrievance_ctr/gre_progress_list';
$route['master_grievance_closed']                        = 'admin/AdminGrievance_ctr/gre_closed_list';
$route['master_grievance_details/(:num)/(:num)']         = 'admin/AdminGrievance_ctr/grievance_details/$1/$2';
$route['master_grievance_progres_details/(:num)/(:num)'] = 'admin/AdminGrievance_ctr/grievance_progress_details/$1/$2';
$route['master_grievance_close_details/(:num)/(:num)']   = 'admin/AdminGrievance_ctr/grievance_closed_details/$1/$2';
$route['master_grivance_submit']                         = 'admin/AdminGrievance_ctr/grievance_admin_added';
$route['master_get_grivance']                            = 'admin/AdminGrievance_ctr/get_chat_by_ticket';
$route['master_chat_replay']                             = 'admin/AdminGrievance_ctr/grievance_admin_chat_replay';
$route['master_grievance_download']                      = 'admin/AdminGrievance_ctr/grievance_download';
$route['master_grievance_update']                        = 'admin/AdminGrievance_ctr/grievance_admin_update';
$route['master_checklist']                               = 'admin/AdminChecklist_ctr/check_listing';
$route['master_checklist_details/(:num)']                = 'admin/AdminChecklist_ctr/checklisting_details/$1';
$route['master_get_checklist']                           = 'admin/AdminChecklist_ctr/get_checklist_question';
$route['master_meeting_schedule']                        = 'admin/AdminMeeting_ctr/meeting_schedule';
$route['master_subadmin']                                = 'admin/AdminSub_ctr/sub_admin_listing';
$route['master_subadmin_details/(:num)']                 = 'admin/AdminSub_ctr/sub_admin_details/$1';
$route['master_add_subadmin']                            = 'admin/AdminSub_ctr/create_new_sub_admin';
$route['master_sub_deleted']                             = 'admin/AdminSub_ctr/sub_admin_deleted';
$route['master_sub_admin']                               = 'admin/AdminSub_ctr/get_sub_admin_details';
$route['update_sub_admin']                               = 'admin/AdminSub_ctr/sub_admin_updated';
$route['master_admin_download']                          = 'admin/AdminSub_ctr/sub_admin_download';
$route['master_password_update']                         = 'admin/AdminDashboard/super_admin_passwprd_updates';
$route['master_password_submit']                         = 'admin/AdminDashboard/super_admin_passwprd_submited';
$route['master_district_manage']                         = 'admin/AdminDistict_ctr/district_list';
$route['master_add_district']                            = 'admin/AdminDistict_ctr/add_district';
$route['master_manadal_manage']                          = 'admin/AdminDistict_ctr/manadal_list';
$route['master_add_mandal']                              = 'admin/AdminDistict_ctr/add_manadal';
$route['master_gram_manage']                             = 'admin/AdminDistict_ctr/grampanchayat_list';
$route['master_add_panchayat']                           = 'admin/AdminDistict_ctr/add_gram_panchayat';
$route['master_export_user']                             = 'admin/AdminExport_ctr/index';
$route['master_data_import']                             = 'admin/AdminExport_ctr/excell_data_imports';

$route['grievance_l1']                           = 'admin/AdminGrievance_ctr/grievance_l1';
$route['grievance_l1/(:num)']                = 'level-1/Grievence/grievance_l1';

$route['progress_list_l1']                       = 'admin/AdminGrievance_ctr/gre_progress_list_l1';
$route['closed_list_l1']                         = 'admin/AdminGrievance_ctr/gre_closed_list_l1';
$route['l1_lvl_grievance_details/(:num)/(:num)'] = 'admin/AdminGrievance_ctr/lvl_grievance_details/$1/$2';
$route['master_grievance_update_l1'] = 'admin/AdminGrievance_ctr/grievance_admin_update_l1';


$route['grievance_l2']                           = 'admin/AdminGrievance_ctr/grievance_l2';
$route['grievance_l2/(:num)']                = 'level-1/Grievence/grievance_l2';

$route['progress_list_l2']                       = 'admin/AdminGrievance_ctr/gre_progress_list_l2';
$route['closed_list_l2']                         = 'admin/AdminGrievance_ctr/gre_closed_list_l2';
$route['l2_lvl_grievance_details/(:num)/(:num)'] = 'admin/AdminGrievance_ctr/lvl_grievance_details_l2/$1/$2';
$route['master_grievance_update_l2']             = 'admin/AdminGrievance_ctr/grievance_admin_update_l2';



$route['grievance_l3']                           = 'admin/AdminGrievance_ctr/grievance_l3';
$route['grievance_l3/(:num)']                = 'level-1/Grievence/grievance_l3';

$route['progress_list_l3']                       = 'admin/AdminGrievance_ctr/gre_progress_list_l3';
$route['closed_list_l3']                         = 'admin/AdminGrievance_ctr/gre_closed_list_l3';
$route['l3_lvl_grievance_details/(:num)/(:num)'] = 'admin/AdminGrievance_ctr/lvl_grievance_details_l3/$1/$2';
$route['master_grievance_update_l3']             = 'admin/AdminGrievance_ctr/grievance_admin_update_l3';
$route['lvl_grievance']             = 'admin/AdminGrievance_ctr/lvl_grievance';

//$route['master_get_sub_admin']                              = 'admin/AdminSub_ctr/get_sub_admin_details';
/**------------------------------ Super admin routing end --------------------------------------**/
/**-------------------------------- Sub admin routing start --------------------------------**/
$route['admin_login']       = 'subAdmin/Auth/login';
$route['admin_logout']      = 'subAdmin/Auth/logout';
$route['admin_dashboard']   = 'subAdmin/AdminDashboard/index';
$route['subAdmin_password'] = 'subAdmin/AdminDashboard/subadmin_passwprd_updates';
//$route['admin_certificate']                                 = 'subAdmin/AdminCertificate_ctr/index';
$route['admin_certificate_progess'] = 'subAdmin/AdminCertificate_ctr/progress_list';
$route['admin_certificate_verify']  = 'subAdmin/AdminCertificate_ctr/field_verify_list';
//$route['admin_certificate_interview']                       = 'subAdmin/AdminCertificate_ctr/interview_schedule_list';
$route['admin_certificate_details/(:num)/(:num)']        = 'subAdmin/AdminCertificate_ctr/certificates_details/$1/$2';
$route['admin_certificate_verify_details/(:num)/(:num)'] = 'subAdmin/AdminCertificate_ctr/certificates_verify_details/$1/$2';
$route['admin_certificate_verify_upd']                   = 'subAdmin/AdminCertificate_ctr/subadmin_verify_status_upd';
$route['admin_verify_application']                       = 'subAdmin/AdminCertificate_ctr/subadmin_verify_app_status';
$route['admin_grivance_chat_replay']                     = 'subAdmin/AdminCertificate_ctr/ticket_query_replay';
$route['admin_get_chat_replay']                          = 'subAdmin/AdminCertificate_ctr/admin_get_chat_replay';
$route['get_certificate_download']                       = 'subAdmin/AdminCertificate_ctr/get_certificate_pdf_download';
$route['admin_grievance_update']                         = 'subAdmin/AdminCertificate_ctr/admin_grievance_sts_update';
/**---------------------------------- sub admin routing end -----------------------------------**/

$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;










/**---------------------------------- level1 routing -----------------------------------**/



$route['lvl_grievence']                       = 'level-1/Grievence/lvl_grievence';
$route['lvl_grievence/(:num)']                = 'level-1/Grievence/lvl_grievence';
$route['lvl_dashboard']                       = 'level-1/Grievence/dashboard';
$route['lvl_grievance_details/(:num)/(:num)'] = 'level-1/Grievence/lvl_grievance_details/$1/$2';
$route['grievence']                           = 'level-1/Grievence/index/';
$route['signin']                              = 'level-1/Auth/index';
$route['l1_logout']                           = 'level-1/Auth/logout';
$route['grievance_update']                    = 'level-1/Grievence/grievance_lvl_update';
$route['grievance_priorityupdate']            = 'level-1/Grievence/grievance_priority_update';
$route['get_received']                        = 'level-1/Grievence/lvl_grievence';
$route['get_process']                         = 'level-1/Grievence/progress_list';
$route['get_closed']                          = 'level-1/Grievence/closed_list';
$route['l1_signin']                           = 'level-1/Grievence/index';
$route['get_grivance']                        = 'level-1/Grievence/get_chat_by_ticket';
$route['chat_replay']                         = 'level-1/Grievence/grievance_chat_replay';
$route['level2']                              = 'level-1/Auth/assign_query_to_level2';

// $route['get_records_created_24_hours_ago_not_closed'] = 'level-1/Grievence/Auth/get_records_created_24_hours_ago_not_closed';
/**---------------------------------- level2 routing -----------------------------------**/


$route['lvl2_grievence']                       = 'level-2/Grievence2/lvl_grievence';
$route['lvl2_grievence/(:num)']                = 'level-2/Grievence2/lvl_grievence';
$route['lvl2_dashboard']                       = 'level-2/Grievence2/dashboard';
$route['lvl2_grievance_details/(:num)/(:num)'] = 'level-2/Grievence2/lvl_grievance_details/$1/$2';
// $route['grievence']              = 'level-2/Grievence2/index/';
$route['lvl2_signin']              = 'level-2/Auth/index';
$route['l2_logout']                = 'level-2/Auth/logout';
$route['l2_grievance_update']      = 'level-2/Grievence2/grievance_lvl_update';
$route['grievance_priorityupdate'] = 'level-2/Grievence2/grievance_priority_update';
$route['get_l2_received']          = 'level-2/Grievence2/lvl_grievence';
$route['get_l2_process']           = 'level-2/Grievence2/progress_list';
$route['get_l2_closed']            = 'level-2/Grievence2/closed_list';
$route['l2_signin']                = 'level-2/Grievence2/index';
$route['get_grivance']             = 'level-2/Grievence2/get_chat_by_ticket';
$route['chat_replay']              = 'level-2/Grievence2/grievance_chat_replay';
$route['level3']                   = 'level-1/Auth/assign_query_to_level3';


// $route['level2']                                  = 'level-1/Auth/assign_query_to_level2';

// $route['master_grievance_details/(:num)/(:num)']              = 'admin/AdminGrievance_ctr/grievance_details/$1/$2';
/**---------------------------------- level3 routing -----------------------------------**/



$route['lvl3_grievence']                       = 'level-3/Grievence3/lvl_grievence';
$route['lvl3_grievence/(:num)']                = 'level-3/Grievence3/lvl_grievence';
$route['lvl3_dashboard']                       = 'level-3/Grievence3/dashboard';
$route['lvl3_grievance_details/(:num)/(:num)'] = 'level-3/Grievence3/lvl_grievance_details/$1/$2';
// $route['grievence']              = 'level-2/Grievence2/index/';
$route['lvl3_signin']              = 'level-3/Auth/index';
$route['l3_logout']                = 'level-3/Auth/logout';
$route['l3_grievance_update']      = 'level-3/Grievence3/grievance_lvl_update';
$route['grievance_priorityupdate'] = 'level-3/Grievence3/grievance_priority_update';
$route['get_l3_received']          = 'level-3/Grievence3/lvl_grievence';
$route['get_l3_process']           = 'level-3/Grievence3/progress_list';
$route['get_l3_closed']            = 'level-3/Grievence3/closed_list';
$route['l3_signin']                = 'level-3/Grievence3/index';
$route['get_grivance']             = 'level-3/Grievence3/get_chat_by_ticket';
$route['chat_replay']              = 'level-3/Grievence3/grievance_chat_replay';

$route['assign_query_to_level2']              = 'level-1/Auth/assign_query_to_level2';
$route['assign_query_to_level3']              = 'level-1/Auth/assign_query_to_level3';

