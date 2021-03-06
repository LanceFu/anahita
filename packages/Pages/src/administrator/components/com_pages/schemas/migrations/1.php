<?php

/** 
 * LICENSE: ##LICENSE##
 * 
 * @package    Com_Pages
 * @subpackage Schema_Migration
 */

/**
 * Schema Migration
 *
 * @package    Com_Pages
 * @subpackage Schema_Migration
 */
class ComPagesSchemaMigration1 extends ComMigratorMigrationVersion
{
   /**
    * Called when migrating up
    */
    public function up()
    {
        dbexec('UPDATE #__anahita_nodes SET access=\'admins\' WHERE enabled=0 AND type=\'ComMediumDomainEntityMedium,ComPagesDomainEntityPage,com:pages.domain.entity.page\'');
    }

   /**
    * Called when rolling back a migration
    */        
    public function down()
    {
        //add your migration here        
    }
}