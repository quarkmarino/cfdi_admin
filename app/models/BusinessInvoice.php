<?php
namespace Models;

use Eloquent;

class Invoice extends Eloquent {
	protected $table = 'business_invoices';

	protected $fillable = [];
}