<?php

namespace App\Service\Schema;

use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Support\Collection;

class MigrationStatusCommand extends StatusCommand {

	public function handle() {
		return $this->migrator->usingConnection($this->option('database'), function () {
			if (! $this->migrator->repositoryExists()) {
				$this->components->error('Migration table not found.');

				return 1;
			}

			$ran = $this->migrator->getRepository()->getRan();

			$batches = $this->migrator->getRepository()->getMigrationBatches();

			if (count($migrations = $this->getStatusFor($ran, $batches)) > 0) {
				$this->newLine();

				if ($this->option('pending')) {
					$migrations = $migrations->filter(function($migration) {
						return str($migration[1])->contains('Pending');
					});
				}
				else {
					$this->addUnknownRanMigrations($migrations, $ran, $batches);
				}

				$this->components->twoColumnDetail('<fg=gray>Migration name</>', '<fg=gray>Batch / Status</>');
				foreach ($migrations as $migration) {
					$this->components->twoColumnDetail($migration[0], $migration[1]);
				}

				$this->newLine();
			}
			else {
				$this->components->info('No migrations found');
			}
		});
	}

	protected function addUnknownRanMigrations(Collection $migrations, array $ran, array $batches) {
		foreach ($ran as $migration) {
			if (!isset($migrations[$migration])) {
				$migrations[$migration] = [
					"<fg=red>$migration</fg=red>",
					'<fg=red>[' . ($batches[$migration] ?? '?') . '] Missing</fg=red>',
				];
			}
		}

		return $migrations;
	}

}
