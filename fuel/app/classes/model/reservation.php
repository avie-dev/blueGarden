<?php

	
	class Model_Reservation extends \Orm\Model
	{
		protected static $_properties = array(
			'id',
			'username',
			'password',
			'group',
			'email',
			'last_login',
			'login_hash',
			'profile_field',
			'created_at',
			'updated_at',
		);

		protected static $_observers = array(
			'Orm\Observer_CreatedAt' => array(
				'events' => array('before_insert'),
				'mysql_timestamp' => false,
			),
			'Orm\Observer_UpdatedAt' => array(
				'events' => array('before_update'),
				'mysql_timestamp' => false,
			),
		);
		
	/**	public static function signup(Fieldset $form)
		{
			//$form->add('username', 'Username:')->add_rule('required');
			$form->add('loginpw', 'Choose Password:', array('type'=>'password'))->add_rule('required');
			$form->add('loginpw_chk', 'Re-type Password:', array('type' => 'password'))->add_rule('required');
			$form->add('cus_mail', 'メールアドレス:')->add_rule('required')->add_rule('valid_email');
			$form->add('submit', ' ', array('type'=>'submit', 'value' => 'Register'));
			return $form;
		}
	**/

		public static function validate_signup(Fieldset $form, $auth)
		{
			$form->field('loginpw')->add_rule('match_value', $form->field('loginpw_chk')->get_attribute('value'));
			$val = Validation::instance();
			$val = $form->validation();
			//$val->set_message('required', 'The field :field is required');
			//$val->set_message('valid_email', 'The field :field must be an email address');
			//$val->set_message('match_value', 'The passwords must match');
			
			if ($val->run())
			{
				$username = $form->field('cus_mail')->get_attribute('value');
				$password = $form->field('loginpw')->get_attribute('value');
				$email = $form->field('cus_mail')->get_attribute('value');
				$name = $form->field('cus_name')->get_attribute('value');
				//$group = '1';
				$kana = $form->field('cus_kana')->get_attribute('value');
				$tel = $form->field('cus_tel')->get_attribute('value');
				$postno = $form->field('cus_zip')->get_attribute('value');
				$pref = $form->field('cus_pref')->get_attribute('value');
				$addr1 = $form->field('cus_addr1')->get_attribute('value');
				$addr2 = $form->field('cus_addr2')->get_attribute('value');
				$sex = $form->field('cus_sex')->get_attribute('value');
				$birthy = $form->field('cus_birthy')->get_attribute('value');
				$birthm = $form->field('cus_birthm')->get_attribute('value');
				$birthd = $form->field('cus_birthd')->get_attribute('value');
				
				try
				{
					echo '<script language="javascript">';
						echo 'alert("user created")';
						echo '</script>';
					//$user = $auth->create_user($username, $password, $email);
					$user = $auth->create_user(
					$username,
					'pass',
					$email,
					1,
					array(
						'name' => $name,
						'kana' => $kana,
						'tel' => $tel,
						'post_no' => $postno,
						'pref' => $pref,
						'addr1' => $addr1,
						'addr2' => $addr2,
						'sex' => $sex,
						'birthy' => $birthy,
						'birthm' => $birthm,
						'birthd' => $birthd,
						'user_point' => '0',
					)
				);
				}
				catch (Exception $e)
				{
					$error = $e->getMessage();
				}
				if (isset($user))
				{
					$auth->login($username, $password);
				}
				else
				{
					if (isset($error))
					{
						$li = $error;
					}
					else
					{
						$li = 'Something went wrong with creating the user!';
					}
					$errors = Html::ul(array($li));
					return array('e_found' => true, 'errors' => $errors);
				}
			}
			else
			{
				$errors = $val->show_errors();
				return array('e_found' => true, 'errors' => $errors);
			}
		}

	}
		

