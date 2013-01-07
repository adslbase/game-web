<?php

/**
 * This is the model class for Recover Password
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class UserRecoverPassForm extends CFormModel
{
        public $email;        

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            return array(
               array('email','required'),
               array('email', 'exist',
                        'attributeName'=>'email',
                        'className'=>'common.models.user.User',
                        'message'=>t('Email does not exist.')),                                
             );
	}

        
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>t('Email'),                       
		);
	}

}