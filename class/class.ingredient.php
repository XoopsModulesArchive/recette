<?php
class Ingredient 
{
	var $db;
	var $qt;
	var $ing;
	var $id;
	
	function getAllIngredients()
	{
		$list = array();
		$db =& Database::getInstance();
		$sql = "SELECT A.id AS ide, name, count( recette ) as s FROM ".$db->prefix('recette_ingredient')." A, ".$db->prefix('recette_lnk_ingredient_recette')." B WHERE A.id = B.ingredient GROUP BY B.ingredient order by name";
		$result = $db->query($sql);
       	while( $myrow = $db->fetchArray($result)) 
		{
			$ligne = array(
				'id'=>$myrow['ide'],
				'name'=>$myrow['name'],
				'nb'=>$myrow['s']								
			);
			$list[] = $ligne;
        }	
		
		return $list;
	}
	
	function setIngredient($ping)
	{
		$this->ing = $ping;
	}	
	
	function setId($p)
	{
		$this->id = $p;
	}		
	
	function getId()
	{
		return $this->id;
	}		
	
	function setQuantite($pqt)
	{
		$this->qt = $pqt;
	}
	
	function Ingredient($pqt,$ping)
	{
		$this->db =& Database::getInstance();
		$this->qt = $pqt;
		$this->ing = $ping;
	}
	
	function getQuantite($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$title = $myts->makeTboxData4Show($this->qt);
			break;
		case "Edit":
			$title = $myts->makeTboxData4Edit($this->qt);
			break;
		case "Preview":
			$title = $myts->makeTboxData4Preview($this->qt);
			break;
		case "InForm":
			$title = $myts->makeTboxData4PreviewInForm($this->qt);
			break;
		}
		return $title;
	}	
	
	function getIngredient($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$title = $myts->makeTboxData4Show($this->ing);
			break;
		case "Edit":
			$title = $myts->makeTboxData4Edit($this->ing);
			break;
		case "Preview":
			$title = $myts->makeTboxData4Preview($this->ing);
			break;
		case "InForm":
			$title = $myts->makeTboxData4PreviewInForm($this->ing);
			break;
		}
		return $title;
	}	
	
	function changeThidIdByThisOne( $oldID , $newID )
	{
		$db =& Database::getInstance();
		$sql = sprintf("UPDATE %s SET ingredient = %u where ingredient = %u ",$db->prefix('recette_lnk_ingredient_recette'),$newID,$oldID);
		if (!$result = $db->query($sql)) {
			return false;
		}
		$sql = sprintf("DELETE FROM %s where id = %u ",$db->prefix('recette_ingredient'),$oldID);		
		if (!$result = $db->query($sql)) {
			return false;
		}
		return true;
	}
	
	function store($storyid)
	{
		// vérifier si l'ingredient existe ou pas
		$idIng = -1;
		
		$sql = "SELECT id FROM ".$this->db->prefix('recette_ingredient')."  WHERE name='".$this->ing."' ";
		$result = $this->db->query($sql);
       	while( $myrow = $this->db->fetchArray($result)) 
		{
			$idIng = $myrow['id'];			
        }	
		// Si = -1 alors creer un nouvelle ingrédient
		if ( $idIng==-1 )
		{
			$sql = sprintf("INSERT INTO ".$this->db->prefix('recette_ingredient')." (name) VALUES ('%s')", $this->ing );
			if (!$result = $this->db->query($sql)) {
				return false;
			}
			$idIng = $this->db->getInsertId();			
		}
		
		// Hop maintenant on peu creer la liaison
		$sql = sprintf("INSERT INTO ".$this->db->prefix('recette_lnk_ingredient_recette')." (ingredient,recette,quantite) VALUES (%u,%u,'%s')", $idIng , $storyid , $this->qt );				
		if (!$result = $this->db->query($sql)) 
		{
					echo $sql;
				return false;
		}
	}
}

?>