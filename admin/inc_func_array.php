<?php
function select_options($the_array, $pre_value){
			while (list($value,$description) = each($the_array)){
			if ($pre_value == $value){$selected = "selected=\"selected\""; } else {$selected = "";}
			@$result .= '<option value="'.$value.'" '.$selected.'>'.$description.'</option>'."\n";}
			return $result;
			}
			
function convert_array($the_array, $pre_value) {
			while (list($value,$description) = each($the_array)){
			if ($pre_value == $value){ $result = $description; } }
			return @$result;
			}
			
function check_options($the_array, $pre_values, $the_title){
			foreach ($the_array as $value=>$description) {
			if (in_array($value,$pre_values)){$selected = " checked=\"checked\""; } else {$selected = ""; }
			if ($description != "[Selezionare]"){
			@$result .= '<label><input name="'.$the_title.'[]" type="checkbox" value="'.$value.'"'.$selected.' />'.$description."</label><br />\n";}}
			return @$result;
}
?>
<?php require_once('inc_array.php'); ?>