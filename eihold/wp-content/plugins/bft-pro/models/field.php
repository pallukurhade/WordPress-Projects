<?php
class BFTProField {
	function select($list_id=0, $id=0) {
		global $wpdb;
		
		$list_id_sql="";
		if($list_id) $list_id_sql=$wpdb->prepare(" AND list_id=%d ", $list_id);
		
		$id_sql="";
		if($id) $id_sql=$wpdb->prepare(" AND id=%d ", $id);
		
		$fields=$wpdb->get_results("SELECT * FROM ".BFTPRO_FIELDS." WHERE id>0 $list_id_sql $id_sql ORDER BY name, id");
		
		if($id) return $fields[0];
		
		return $fields;
	}
	
	function add($vars) {		
		global $wpdb;

		$this->cleanup($vars);		
				
		$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_FIELDS." SET 
			name=%s, ftype=%s, fvalues=%s, is_required=%d, label=%s, list_id=%d, field_date_format=%s", 
			$vars['name'], $vars['ftype'], $vars['fvalues'], @$vars['is_required'], $vars['label'], $vars['list_id'], $vars['field_date_format']));
		return $wpdb->insert_id;	 
	}
	
	function save($vars, $id) {
		global $wpdb;
		
		$this->cleanup($vars);
						
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_FIELDS." SET
		name=%s, ftype=%s, fvalues=%s, is_required=%d, label=%s, field_date_format=%s WHERE id=%d", 
			$vars['name'], $vars['ftype'], $vars['fvalues'], @$vars['is_required'], $vars['label'], $vars['field_date_format'], $id));
			
		return false;	
	}
	
	function delete($id) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_FIELDS." WHERE id=%d", $id));
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_DATAS." WHERE field_id=%d", $id));
		
		return true;
	}
	
	// make sure $name is OK and maybe other things
	private function cleanup(&$vars) {
		$vars['name']=strtolower($vars['name']);
		$vars['name']=preg_replace("/[^a-z0-9]/","",$vars['name']);
		if($vars['ftype'] != 'date') $vars['field_date_format'] = ''; // to avoid confusion we want this to have value only on the proper fields
	}
	
	// display field's data in more friendly way (currently used by fields of type "date")
	static function friendly($ftype, $data, $field_date_format = '') {
		if($ftype == 'date') {
			list($y, $m, $d) = explode("-", $data);
			if($y == 1900) $y = date("Y"); // we use 1900 to store dates without year
			$time = mktime(0,0,0, $m, $d, $y);
						
			$format = $field_date_format;
			$format = str_replace('MM', 'm', $format);
			$format = str_replace('YYYY', 'Y', $format);
			$format = str_replace('YY', 'y', $format);
			$format = str_replace('DD', 'd', $format);
			$data = date($format, $time);
		}
		return $data; 
	} 
}