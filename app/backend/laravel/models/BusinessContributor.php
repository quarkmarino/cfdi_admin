<?php
namespace Models;

use Eloquent;
use Crypt;

class Contributor extends Eloquent {
	protected $table = 'business_contributors';

	protected $fillable = ['rfc', 'name', 'type', 'password'];

	protected $hidden = ['user_id', 'password', 'key_id', 'cer_id', 'updated_at'];

	public function setUserIdAttribute($user_id = 1){
		$this->attributes['user_id'] = $user_id;
	}

	public function setPasswordAttribute($password){
		$this->attributes['password'] = Crypt::encrypt($password);
	}

	public function getPasswordAttribute($password){
		return Crypt::decrypt($password);
	}

	public function user(){
		return $this->belongsTo('Models\User');
	}

	public function issuedInvoices(){
		return $this->hasMany('Models\Invoice', 'issuer_id');
	}

	public function receivedInvoices(){
		return $this->hasMany('Models\Invoice', 'receiver');
	}

	public function certifiedInvoices(){
		return $this->hasMany('Models\Invoice', 'pac_id');
	}
}