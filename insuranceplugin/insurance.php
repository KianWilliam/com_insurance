<?php
/*
 * @package component Insurance for Joomla! 3.x
 * @version $Id: com_Insurance 1.0.0 2017-10-10 23:26:33Z $
 * @author Kian William Nowrouzian
 * @copyright (C) 2016- Kian William Nowrouzian
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of Insurance.
    Insurance is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    Insurance is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with Insurance.  If not, see <http://www.gnu.org/licenses/>. 
*/
?>
<?php


defined('_JEXEC') or die;

use Joomla\Registry\Registry;
JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_insurance/models');


class PlgExtensionInsurance extends JPlugin
{
	
	public function onExtensionAfterSave($context, $data , $isNew)
	{
		
		if($data->get('option')=="com_insurance")
		{
					
			$db = JFactory::getDbo();
            $query = $db->getQuery(true);
			$app = JFactory::getApplication(); 
            $prefix = $app->getCfg('dbprefix');
			$dbname = $app->getCfg('db');
          	
						$db->setQuery('SHOW TABLES FROM '.$dbname.' where Tables_in_'.$dbname.' = "'.$prefix.$data->get('myid').'"');

            $result = $db->loadObjectList();
			
			
			
			if(count($result)==0)
			{
				
            				$query = $db->getQuery(true);
							$query = "CREATE TABLE IF NOT EXISTS `#__".$data->get('myid')."` (".
                            "`id` int(10) unsigned NOT NULL auto_increment,".
                            "`userid` int(10) unsigned NULL,".
							"`published` tinyint(4) NOT NULL default 0,".
                            "`ordering` int(11) NOT NULL default 0,".
                            "`params` text NOT NULL,".
                            "PRIMARY KEY  (`id`)".
                            ") ENGINE=MyISAM  DEFAULT CHARSET=utf8";
							$db->setQuery($query);
							$db->execute($query);
			}
			
		 		
		}

		
		 
       return true;
	}
	
		
}
