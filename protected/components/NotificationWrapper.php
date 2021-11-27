<?php
class NotificationWrapper
{	
	public static function isTableView($table_name='')
	{
		$stmt="SELECT TABLE_TYPE FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = ".FunctionsV3::q($table_name)." ";
		if($res = Yii::app()->db->createCommand($stmt)->queryRow()){			
			if($res['TABLE_TYPE']=="VIEW"){
				return true;
			}
		} 
		return false;
	}
	
	public static function hasPrimaryKey($table_name='')
	{
		$stmt="
		SELECT *  
        FROM information_schema.table_constraints  
        WHERE constraint_type = 'PRIMARY KEY'   
        AND table_name = ".q($table_name)."
		";		
		if($res = Yii::app()->db->createCommand($stmt)->queryRow()){			
			return $res;
		} 
		return false;
	}
	
	public static function hasAutoIncrement($table_name='')
	{
		$stmt="
		SHOW CREATE TABLE $table_name
		";			
		if($res = Yii::app()->db->createCommand($stmt)->queryRow()){						
            if (preg_match("/AUTO_INCREMENT/i", $res['Create Table'])) {	
            	 return true;
            }	
		} 
		return false;
	}
	
	public static function checkAllTable($required_table=array(),$view_table=array())
	{
		$table_prefix=Yii::app()->db->tablePrefix;					
		$tables = Yii::app()->db->schema->getTableNames();		
		
		$table_from_db = array();
		
		if(is_array($tables) && count($tables)>=1){
			foreach ($tables as $table_name) {
				$table_name_without_prefix = str_replace($table_prefix,"",$table_name);
				
				$table_from_db[]=$table_name_without_prefix;
				
				if(in_array($table_name_without_prefix,$required_table)):
					if(in_array($table_name_without_prefix,$view_table)){				
						if( !self::isTableView($table_prefix.$table_name_without_prefix)){						
							Yii::app()->db->createCommand()->dropTable($table_prefix.$table_name_without_prefix);
							throw new Exception( Yii::t("default","[table] is not a view please run database update",array(
							  '[table]'=>$table_name
							)) );
						}
					} else {
						if(!self::hasPrimaryKey($table_name)){
							throw new Exception( Yii::t("default","[table] has no primary key",array(
							  '[table]'=>$table_name
							)) );
						}					
						if(!self::hasAutoIncrement($table_name)){
							throw new Exception( Yii::t("default","[table] has no auto increment",array(
							  '[table]'=>$table_name
							)) );
						}
					}				
				endif;
			}
		}
		
		if(is_array($table_from_db) && count($table_from_db)>=1){
			foreach ($required_table as $required_table_val) {
				if(!in_array($required_table_val,$table_from_db)){
					throw new Exception( Yii::t("default","table [table] not found. please run the db update",array(
					  '[table]'=>$required_table_val
					)) );
				}
			}
		}				
	}
	
	public static function checkCuisine()
	{
		try {
			 NotificationWrapper::checkFields('cuisine',array(
    	      'slug'=>""    	      
    	    )); 
		} catch (Exception $e) {
			return true;
		}
		
		if(Yii::app()->db->schema->getTable("{{cuisine_merchant}}")){
			$stmt="
			SELECT count(*) as total,
			a.merchant_id,
			a.cuisine
			FROM {{merchant}} a	
			WHERE 
			a.cuisine is not null 
			and
			merchant_id NOT IN (
			   select merchant_id
			   from {{cuisine_merchant}}
			   where merchant_id=a.merchant_id
			)
			GROUP by a.merchant_id,a.cuisine
			LIMIT 0,1
			";								
			if($res = Yii::app()->db->createCommand($stmt)->queryRow()){							
				if($res['total']>0){
					$error = Yii::t("default","Cuisine table needs update [total] records. click here",array(
					 '[total]'=>$res['total']
					));
					$link = Yii::app()->createUrl("/admin/update_cuisine");
					throw new Exception( "<a href=\"$link\">".$error."</a>" );
				}
			}
		}
		
		$stmt="
		SELECT count(*) as total
		FROM
		{{cuisine}}
		WHERE slug = ''
		LIMIT 0,1
		";
		if($res = Yii::app()->db->createCommand($stmt)->queryRow()){
			if($res['total']>0){
				$error = Yii::t("default","Cuisine table needs update [total] records. click here",array(
				 '[total]'=>$res['total']
				));
				$link = Yii::app()->createUrl("/admin/update_cuisine_slug");
				throw new Exception( "<a href=\"$link\">".$error."</a>" );
			}
		}
		
		return true;		
	}
	
	public static function checkOpeningHours()
	{
		$stmt="
		SELECT count(*) as total,
		a.merchant_id	
		FROM {{option}} a	
		WHERE 
		option_name='stores_open_starts'
		and
		merchant_id NOT IN (
		   select merchant_id
		   from {{opening_hours}}
		   where merchant_id=a.merchant_id
		)
		group by a.merchant_id
		";				
		if($res = Yii::app()->db->createCommand($stmt)->queryRow()){			
			if($res['total']>0){
				$error = Yii::t("default","Merchant opening hours needs update [total] records. click here",array(
				 '[total]'=>$res['total']
				));
				$link = Yii::app()->createUrl("/admin/update_opening_hours");
				throw new Exception( "<a href=\"$link\">".$error."</a>" );
			}
		}		
		return true;		
	}

	public static function checkCurrency()
	{
		$table_prefix=Yii::app()->db->tablePrefix;
		$table_name= $table_prefix."currency";		
		if(Yii::app()->db->schema->getTable($table_name)){			
			if(!self::hasAutoIncrement($table_name)){				
				$error =  Yii::t("default","table [table] needs update",array(
				  '[table]'=>$table_name
				));
				$link = Yii::app()->createUrl("/admin/update_currency");
				throw new Exception( "<a href=\"$link\">".$error."</a>" );
			}
		}
	}
		
	public static function checkFields($table_name='', $fields=array())
	{				
		$orig_table = $table_name;
		$table_name = "{{{$table_name}}}";		
		if(Yii::app()->db->schema->getTable($table_name)){
			if($table_cols = Yii::app()->db->schema->getTable($table_name)){
				foreach ($fields as $key=>$val) {
					if(!isset($table_cols->columns[$key])) {
						if( !self::isTableView($table_name)){												    
						    throw new Exception( Yii::t("mobile2","[table] needs update please run the db update",array(
							  '[table]'=>$orig_table
							)) );
						} else {
							throw new Exception( Yii::t("mobile2","[table] needs update please run the db update",array(
							  '[table]'=>$orig_table
							)) );
						}
					}
				}
			}
		} else throw new Exception( Yii::t("mobile2","table [table] not found",array(
					  '[table]'=>$table_name
					)) );
	}			
	
	public static function checkRequiredFile()
	{
	     $folder = array(
	       Yii::getPathOfAlias('webroot')."/upload",	      
	       Yii::getPathOfAlias('webroot')."/cronHelper",
	       Yii::getPathOfAlias('webroot')."/protected/runtime"
	     );
	     foreach ($folder as $val) {
	     	if(!is_dir($val)){	     		
	     		 if (!mkdir($val,0777)){	     		
			     	 throw new Exception( Yii::t("mobile2","Folder [folder_name] does not exist please. create this folder manually and set the permission to 777",array(
					  '[folder_name]'=>$val
					)) );
	     		 }
		     }
	     }	     
	     return true;
	}
	
	public static function checkDeliveryDistanceCovered()
	{
		$stmt="SELECT count(*) as total
		FROM {{merchant}}
		WHERE delivery_distance_covered<=0
		";
		if($res = Yii::app()->db->createCommand($stmt)->queryRow()){
			if($res['total']>0){
				$error = Yii::t("default","Merchant delivery distance covered needs update [total] records. click here",array(
					 '[total]'=>$res['total']
					));
				$link = Yii::app()->createUrl("/admin/update_distance_covered");
				throw new Exception( "<a href=\"$link\">".$error."</a>" );
			}
		}
		return true;
	}
	
	public static function checkMigration()
	{
		$items = Item_migration::getItemToMigrate();		
		$subaddon_item = Item_migration::getSubItem();	
		$translation_category = Item_migration::GetTranslation("category","category_translation","cat_id");			
		$sizetranslation = Item_migration::GetTranslation("size","size_translation","size_id");			
		$subcategory_translation = Item_migration::GetTranslation("subcategory","subcategory_translation","subcat_id");			
		$subcategory_item_translation = Item_migration::GetTranslation("subcategory_item","subcategory_item_translation","sub_item_id");			
		$ingredients_translation = Item_migration::GetTranslation("ingredients","ingredients_translation","ingredients_id");			
		$cooking_ref_translation = Item_migration::GetTranslation("cooking_ref","cooking_ref_translation","cook_id");			
		$item_translation = Item_migration::GetTranslation("item","item_translation","item_id");			
		$cuisine_translation = Item_migration::GetTranslation("cuisine","cuisine_translation","cuisine_id");			
		$item_sub_item = Item_migration::getItemSubcategoryItem();		
		
		$total_to_migrate = (integer)$items + (integer)$subaddon_item + (integer) $item_sub_item;
		
		if ( Yii::app()->functions->multipleField()){
			$total_to_migrate = (integer)$items + (integer)$subaddon_item  + (integer) $item_sub_item + (integer)$translation_category + 
			(integer)$sizetranslation + (integer)$subcategory_translation + 
			(integer)$subcategory_item_translation + (integer)$ingredients_translation +  (integer)$cooking_ref_translation + (integer)$item_translation +
			(integer)$cuisine_translation;
		}
				
		
		if($total_to_migrate>0){
			$error = Yii::t("default","[total] items for migration",array(
				 '[total]'=>$total_to_migrate
				));
			$link = Yii::app()->createUrl("/admin/migration_status");
			throw new Exception( "<a href=\"$link\">".$error."</a>" );
		}
		return true;
	}
	
	/*public static function getItemToMigrate()
	{
		if(Yii::app()->db->schema->getTable("{{item_relationship_size}}")){	
			$stmt="
			SELECT count(*) as total FROM {{item}} a
			WHERE item_id NOT IN (
			  select item_id from {{item_relationship_size}}
			  where item_id = a.item_id
			)
			";			
			if($res = Yii::app()->db->createCommand($stmt)->queryRow()){
				if($res['total']>0){
					return $res['total'];
				}
			}
		}
		return false;
	}
	
	public static function checkMigrateItem()
	{
		if($total = self::getItemToMigrate()){
			$error = Yii::t("default","[total] food item needs update. click here",array(
				 '[total]'=>$total
				));
			$link = Yii::app()->createUrl("/admin/update_item");
			throw new Exception( "<a href=\"$link\">".$error."</a>" );
		}
		return true;
	}*/
		
}
/*end class*/