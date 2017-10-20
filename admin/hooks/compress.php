<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function compress()
{
    $CI =& get_instance();
    $html = $CI->output->get_output();
    $html = preg_replace(array('/,<!DOCTYPE html>/','/\n/', '/>\s+</'), array('<!DOCTYPE html>',' ', '><'), $html);
    $CI->output->set_output($html);
    $CI->output->_display();
}