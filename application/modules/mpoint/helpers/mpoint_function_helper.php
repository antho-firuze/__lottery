<?php

if ( ! function_exists('mpoint_period_default'))
{
	function mpoint_period_default() {
		$ci = get_instance();
		
		$ci->load->model('mpoint_model');
		return $ci->mpoint_model->getPnt_Period_Default();
	}
}

