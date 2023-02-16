<?php

if ( ! function_exists( 'user_has_role' ) ) {
	function user_has_role($user_id, $role_name){
		$user_meta = get_userdata($user_id);
		$user_roles = $user_meta->roles;
		return in_array($role_name, $user_roles);
	}
}
if ( ! function_exists( 'atpbs_replace_index_in_array' ) ) {
	function atpbs_replace_index_in_array($old_arr,$new_arr,$str){
		$_str = $str;
		if ($old_arr && $new_arr){
			foreach ($old_arr as $okey => $ovalue) {
				$_str = str_replace($ovalue,"_" . $ovalue,$_str);
			}
		}
		foreach ($new_arr as $nkey => $nvalue) {
			$_str = str_replace("_" . $old_arr[$nkey],$nvalue,$_str);
		}
		return $_str;
	}
}