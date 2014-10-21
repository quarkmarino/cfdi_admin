<?php
namespace Models;

use Eloquent;

class File extends Eloquent {
	protected $table = 'filesystem_files';

	protected $fillable = [];
}