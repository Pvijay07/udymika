<?php
function upload_file($name,$dir)
{
    $CI                             = &get_instance();
    $config['upload_path']          = "uploads/$dir/";
    $config['allowed_types']        = 'jpeg|jpg|png|bmp|pdf|doc';
    $config['max_size']             =  99999999 ;
    $config['file_name']			= 'file_'.date('dMYHis');
    if (!file_exists($config['upload_path']))
    {
        mkdir($config['upload_path'], 0755, true);
    }
    $CI->load->library('upload', $config);
    
    if (!$CI->upload->do_upload($name))
    {
        $error = array('error' => $CI->upload->display_errors());
        $file ="";
    }
    else
    {
        $data = array('upload_data' => $CI->upload->data());
        $file = $config['upload_path'].$data['upload_data']['file_name'];
    }
    if(!empty($file))
    {
        return $file;
    }
    else
    {
        return false;
    }
}
 
function file_remove($file)
{
    if (file_exists($file))
    {
        if(unlink($file))
        {
            return true;
        }
        return false;
    }
    return false;
}