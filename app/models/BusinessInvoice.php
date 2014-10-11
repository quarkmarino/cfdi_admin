<?php
namespace Models;

use Eloquent;

class Invoice extends Eloquent {
	protected $table = 'business_invoices';

	protected $fillable = [];

	public function receiver(){
		return $this->hasOne('Models\Contributor', 'receiver_id');
	}

	public function issuer(){
		return $this->hasOne('Models\Contributor', 'issuer_id');
	}

	public function certifier(){
		return $this->hasOne('Models\Contributor', 'pac_id');
	}
}