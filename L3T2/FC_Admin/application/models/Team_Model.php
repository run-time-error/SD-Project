<?php
/**
	Provides Database support for `team` entity. 
*/
class Team_model extends CI_Model 
{
	
    public function __construct()	
	{
        $this->load->database();
	}
	
	/**
		Returns the name of a particular team (given by team_id)
	*/
	public function get_team_name($team_id)
	{
		$sql = 'SELECT `team_name` FROM `team` where `team_id`=?';				
		$query=$this->db->query($sql,$team_id); 
		$result=$query->row_array();
		
		return $result['team_name'];
	}
	
	/**
		\brief Returns `team_id` for a given `team_name`
		
		It is discouraged to use this function.
	*/
	public function get_team_id($team_name)	//DONE
	{
		$sql = 'SELECT `team_id` FROM `team` where `team_name`=?';				
		$query=$this->db->query($sql,$team_name);

		$result=$query->row_array();
		
		return $result['team_id'];
	}
	
	/**
		\brief Insert a new team into database
		
		input: $data : array('team_id'=>?,'team_name'=>?,'jersy_image'=>?)
	*/
	public function create_team($data)		
	{
		$sql = 'INSERT INTO `team` VALUES(?,?,?)';		
		return $this->db->query($sql,$data); 
	}
	
	/**
		Get all team information from the database
	*/
	public function get_all_teams()	
	{
		$sql = 	'SELECT * from `team` ORDER BY `team_name`';
				
		$query=$this->db->query($sql); 
		
		return $query;
	}
	
	/**
		Get information of all players of a particular team (given by team_id)
	*/
	public function get_team_players($team_id)	//DONE
	{
		$sql = 	'SELECT * from `player` where `team_id`=? ORDER BY `player_cat` ASC, `name` ASC';			
		$query=$this->db->query($sql,$team_id); 
		return $query;
	}

	/**
		Get name and id of all players in current tournament
	*/
	public function get_tournament_team_players($team)	//done
	{
		$sql = 'select P.`name` as PLAYER_NAME, P.`player_id` as PLAYER_ID
				from `player` P, `player_tournament` PT
				where P.`player_id` = PT.`player_id` and P.`team_id`=? and PT.`tournament_id`=?';
		$query = $this->db->query($sql,$team);
		return $query;
	}
	
	/**
		Redundant and not used; Delete if confirmed
	*/
	public function update_motm_id($match_id,$player_id)	
	{
		$sql='UPDATE `match` SET `motm_id`=? WHERE `match_id`=?';
		$query=$this->db->query($sql,$team_id); 
		return;
	}
	
}
?>