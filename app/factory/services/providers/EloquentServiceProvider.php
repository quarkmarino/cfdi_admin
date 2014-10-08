<?php

namespace Factory\Services\Providers;

use Illuminate\Support\ServiceProvider;

class EloquentProvider extends ServiceProvider {

	public function register(){
		$this->app->bind( 'Factory\\Interfaces\\UserInterface', 'Factory\\ORM\\Eloquent\\User' );
		$this->app->bind( 'Factory\\Interfaces\\ContributorInterface', 'Factory\\ORM\\Eloquent\\Contributor' );
	}
}