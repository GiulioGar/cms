<?php
function panel_book_info($the_title, $the_array, $the_field) {
include('../Connections/admin.php');
			$result = '<tr><td colspan="2"><div id="bluebox"><p>'.$the_title."</p>\n";
			while (list($value,$description) = each($the_array)){
			$query_panel = "SELECT DISTINCT(user_id) FROM t_user_info WHERE $the_field = '$value'";
			$panel = mysqli_query($query_panel, $admin) or die(mysql_error());
			$totalRows_panel = mysql_num_rows($panel);
			$result .= '<p align="left">'.$description.': '.$totalRows_panel.'</p>'."\n";
			@$csv.= $the_title.";".$description.';'.$totalRows_panel.";\n";
			}
			$result .= '</div></td></tr>';
			return $result;
}
function panel_book_info_csv($the_title, $the_array, $the_field) {
include('../Connections/admin.php'); 
			while (list($value,$description) = each($the_array)){
			if ($description != "[Selezionare]") {
			$query_panel = "SELECT DISTINCT(user_id) FROM t_user_info WHERE $the_field = '$value'";
			$panel = mysqli_query($query_panel, $admin) or die(mysql_error());
			$totalRows_panel = mysql_num_rows($panel);
			@$result .= $the_title.";".$description.';'.$totalRows_panel.";\n";
			}}
			return $result;
}
function panel_book_profile($the_title,$the_array,$the_field) {
include('../Connections/admin.php');
			$result = '<tr><td colspan="2"><div id="bluebox"><p>'.$the_title."</p>\n";
			while (list($value,$description) = each($the_array)){
			$query_panel = "SELECT DISTINCT(user_id) FROM t_user_profile WHERE question_code = '$the_field' AND find_in_set($value, answer)";
			$panel = mysqli_query($query_panel, $admin) or die(mysql_error());
			$totalRows_panel = mysql_num_rows($panel);
			$result .= '<p align="left">'.$description.': '.$totalRows_panel.'</p>'."\n";
			}
			$result .= "</div></td></tr>\n";
			return $result;
}
function panel_book_profile_csv($the_title,$the_array,$the_field) {
include('../Connections/admin.php'); 
			while (list($value,$description) = each($the_array)){
			$query_panel = "SELECT DISTINCT(user_id) FROM t_user_profile WHERE question_code = '$the_field' AND find_in_set($value, answer)";
			$panel = mysqli_query($query_panel, $admin) or die(mysql_error());
			$totalRows_panel = mysql_num_rows($panel);
			@$result .= $the_title.";".$description.';'.$totalRows_panel.";\n";
			}
			return $result;
}
function panel_book_profile_sub($the_title,$the_array,$the_field, $the_index) {
include('../Connections/admin.php');
			$result = '<tr><td colspan="2"><div id="bluebox"><p>'.$the_title."</p>\n";
			while (list($value,$description) = each($the_array)){
	$query_panel = "SELECT DISTINCT(user_id) FROM t_user_profile WHERE question_code = '$the_field' AND info NOT LIKE '[]' AND info LIKE '%\"$the_index\":\"$value\"%'";
			$panel = mysqli_query($query_panel, $admin) or die(mysql_error());
			$totalRows_panel = mysql_num_rows($panel);
			$result .= '<p align="left">'.$description.': '.$totalRows_panel.'</p>'."\n";
			}
			$result .= "</div></td></tr>\n";
			return $result;
}
function panel_book_profile_sub_csv($the_title,$the_array,$the_field, $the_index) {
include('../Connections/admin.php'); 
			while (list($value,$description) = each($the_array)){
	$query_panel = "SELECT DISTINCT(user_id) FROM t_user_profile WHERE question_code = '$the_field' AND info NOT LIKE '[]' AND info LIKE '%\"$the_index\":\"$value\"%'";
			$panel = mysqli_query($query_panel, $admin) or die(mysql_error());
			$totalRows_panel = mysql_num_rows($panel);
			@$result .= $the_title.";".$description.';'.$totalRows_panel.";\n";
			}
			return $result;
}

?>
