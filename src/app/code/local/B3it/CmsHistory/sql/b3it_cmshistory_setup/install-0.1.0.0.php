<?php
/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;

$installer->startSetup();
if (!$installer->tableExists($installer->getTable('b3it_cmshistory/history_page')))
{
	$installer->run("
	-- DROP TABLE IF EXISTS {$installer->getTable('b3it_cmshistory/history_page')};
	CREATE TABLE {$installer->getTable('b3it_cmshistory/history_page')} (
	    `id` int(11) unsigned NOT NULL auto_increment,
        `title` varchar(128) default '',
        `identifier` varchar(128) default '',
        `page_id` SMALLINT(6) NOT NULL,
        `version` smallint(6) unsigned default 0,
        `status` smallint(6) unsigned default 0,
        `content` text default '',
        `orig_content` text default '',
        `user` varchar(128) default '',
	 `created_at` datetime default null,
     `updated_at` datetime default null,
	  PRIMARY KEY (`id`),
     FOREIGN KEY (`page_id`) REFERENCES `{$this->getTable('cms/page')}`(`page_id`) ON DELETE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		");
}

if (!$installer->tableExists($installer->getTable('b3it_cmshistory/history_block')))
{
	$installer->run("
	-- DROP TABLE IF EXISTS {$installer->getTable('b3it_cmshistory/history_block')};
	CREATE TABLE {$installer->getTable('b3it_cmshistory/history_block')} (
	    `id` int(11) unsigned NOT NULL auto_increment,
        `title` varchar(128) default '',
        `identifier` varchar(128) default '',
        `block_id` SMALLINT(6) NOT NULL,
        `version` smallint(6) unsigned default 0,
        `status` smallint(6) unsigned default 0,
        `content` text default '',
        `orig_content` text default '',
        `user` varchar(128) default '',
	 `created_at` datetime default null,
     `updated_at` datetime default null,
	  PRIMARY KEY (`id`),
     FOREIGN KEY (`block_id`) REFERENCES `{$this->getTable('cms/block')}`(`block_id`) ON DELETE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		");
}

$installer->endSetup();
