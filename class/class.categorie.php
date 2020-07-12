<?php
class Categorie 
{
	var $db;
	var $id;
	var $categorie;
	var $description;
	var $image;
	
	function getAllCategories()
	{
		$list = array();
		$db = &Database::getInstance();
		$sql = "SELECT categorie,description,image,id from ".$db->prefix('recette_cat')."";
		$result = $db->query($sql);
       	while( $myrow = $db->fetchArray($result)) 
		{
			$list[] = new Categorie($myrow['categorie'],$myrow['description'],$myrow['image'],$myrow['id']);
        }	
		
		return $list;
	}
	
	function getAllCategoriesForType($nomType)
	{
		$list = array();
		$db = &Database::getInstance();
		$sql = "SELECT categorie,description,image,id from ".$db->prefix('recette_cat')." where categorie='".$nomType."'";
		$result = $db->query($sql);
       	while( $myrow = $db->fetchArray($result)) 
		{
			$list[] = new Categorie($myrow['categorie'],$myrow['description'],$myrow['image'],$myrow['id']);
        }	
		
		return $list;
	}	
	
	function getAllCategoriesForRecipe($id)
	{
		$list = array();
		$db = &Database::getInstance();
		$sql = "SELECT a.id as ide from ".$db->prefix('recette_cat')." as a,".$db->prefix('recette_lnk_cat')." as b where ".
		"a.id=b.categorie and b.recette=".$id;
		$result = $db->query($sql);
       	while( $myrow = $db->fetchArray($result)) 
		{
			$list[] = $myrow['ide'];
        }	
		
		return $list;
	}
	
	function getCategoriesTypes()
	{
		$list = array();
		$db = &Database::getInstance();
		$sql = "SELECT categorie from ".$db->prefix('recette_cat')." group by categorie order by categorie ";
		$result = $db->query($sql);
       	while( $myrow = $db->fetchArray($result)) 
		{
			$list[] = $myrow['categorie'];
        }	
		
		return $list;
	}
	
	function Categorie($cat,$descr,$imag,$id=-1)
	{
		$this->categorie = $cat;
		$this->description = $descr;
		$this->image = $imag;
		$this->id = $id;
	}
	
	function delete($id)
	{
		$db =& Database::getInstance();

		$sql = sprintf("DELETE FROM %s where id=%u ",$db->prefix('recette_cat'),$id);		
		if (!$result = $db->queryF($sql)) 
		{
			return false;
		}
		
		$sql = sprintf("DELETE FROM %s where categorie=%u;",$db->prefix('recette_lnk_cat'), $id);
		if (!$result = $db->queryF($sql)) 
		{
			return false;
		}	
		
		return true;	
	}
	
	function store()
	{
		$db = &Database::getInstance();
		$sql = sprintf("INSERT INTO ".$db->prefix('recette_cat')." (categorie,description,image) VALUES ('%s','%s','%s')", $this->categorie, $this->description,$this->image );
		if (!$result = $db->query($sql)) 
		{
			return false;
		}
		return true;
	}
	
	function clearForRecette($recetteid)
	{
		$db = &Database::getInstance();
		$sql = $sql = sprintf("DELETE FROM %s where recette=%u;",$db->prefix('recette_lnk_cat'), $recetteid);
		if (!$result = $db->queryF($sql)) 
		{
			return false;
		}		
		return true;
	}
	
	function clearForRecetteForType($recetteid,$type)
	{
		$db = &Database::getInstance();
		$liste = Categorie::getAllCategoriesForType($type);
		$sql = sprintf("DELETE FROM %s where recette=%u and categorie in (",$db->prefix('recette_lnk_cat'), $id,$db->prefix('recette_cat'),$type);
		foreach ($liste as $cat)
		{
			$sql = $sql.$cat->id.",";
		}
		$sql = $sql."-1);";

		if (!$result = $db->queryF($sql)) 
		{
			return false;
		}	
		return true;
	}
	
	function updateLnk($recetteid,$cateid)
	{
		$db = &Database::getInstance();
		$sql = sprintf("INSERT INTO ".$db->prefix('recette_lnk_cat')." (categorie,recette) VALUES (%u,%u)", $cateid, $recetteid );
		if (!$result = $db->queryF($sql)) 
		{
			return false;
		}
		return true;
	}
}

?>