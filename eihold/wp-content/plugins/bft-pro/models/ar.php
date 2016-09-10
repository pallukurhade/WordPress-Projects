<?php
class BFTProARModel {
	// just select all of my autoresponder campaigns order by name
	function select($id = null) {
		global $wpdb;
		
		$id_sql = $id?$wpdb->prepare(" WHERE id=%d ", $id):"";
		
		$campaigns = $wpdb->get_results("SELECT * FROM ".BFTPRO_ARS." $id_sql ORDER BY name");		
			
		if($id) return $campaigns[0];		
		else return $campaigns;
	}
	
	function add($vars) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_ARS."  SET 
			name=%s, list_ids=%s, description=%s, sender=%s", $vars['name'], "|".@implode("|", $vars['list_ids'])."|", 
			@$vars['description'], $vars['sender']));
			
		return $wpdb->insert_id;	
	}
	
	function edit($vars, $id)
	{
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_ARS." SET
 			name=%s, list_ids=%s, description=%s, sender=%s WHERE id=%d", 
 			$vars['name'], "|".@implode("|", $vars['list_ids'])."|", 
			$vars['description'], $vars['sender'], $id));
			
		return true;		
	}
	
	function delete($id) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_ARS." WHERE id=%d",$id));
		
		return true; 
	}
}