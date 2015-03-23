<?php

class View_User extends ViewModel{
	public function view(){
		$users = Model_User::find_all();
		$this->users=$users;
	}
}