<?php

class Model_Facial extends \Model_Crud{
	public function get_data()	{
	
	}
	
	protected static $_table_name = 'tblservicefacial';
	protected static $_primary_key = 'svc_no';
	protected static $_created_at = 'created_at';
	protected static $_updated_at = 'updated_at';
	protected static $_mysql_timestamp = true;

}
