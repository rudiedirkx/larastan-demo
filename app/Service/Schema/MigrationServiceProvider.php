<?php

namespace App\Service\Schema;

use Illuminate\Database\Console\Migrations\StatusCommand as LaravelStatusCommand;
use Illuminate\Database\MigrationServiceProvider as BaseProvider;
use Illuminate\Database\Schema\Builder;

class MigrationServiceProvider extends BaseProvider {

	public function register() {
		parent::register();

		\Schema::resolved(function(Builder $schema) {
			$schema->blueprintResolver(function($table, $callback) {
				return new Blueprint($table, $callback);
			});
		});
	}

	protected function registerMigrateStatusCommand() {
		$this->app->singleton(LaravelStatusCommand::class, function ($app) {
			return new MigrationStatusCommand($app['migrator']);
		});
	}

}
