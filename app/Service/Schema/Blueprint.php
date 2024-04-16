<?php

namespace App\Service\Schema;

use Illuminate\Database\Schema\Blueprint as BaseBlueprint;

class Blueprint extends BaseBlueprint {

	public function timestamp($column, $precision = 0) {
		return $this->integer($column)->unsigned();
	}

	/**
	 * Create users and timestamps columns.
	 */
	public function createdAndUpdated() {
		$this->timestamp('created_at')->useCurrent();
		$this->userReference('created_by', TRUE);

		$this->timestamp('updated_at')->nullable();
		$this->userReference('updated_by', TRUE);
	}

	/**
	 * Create status changed columns.
	 */
	public function statusChanged() {
		$this->timestamp('status_changed_at')->nullable();
		$this->userReference('status_changed_by', TRUE)->onDelete('set null');
	}

	/**
	 * Create a custom user column & reference.
	 */
	public function userReference($name, $nullable = FALSE) {
		// Create column.
		$column = $this->referenceColumn($name);
		if ($nullable) {
			$column->nullable();
		}

		// Create foreign key relation.
		return $this->reference($name, 'users', 'id');
	}

	/**
	 * Create PK column.
	 */
	public function pk($name) {
		return $this->bigIncrements($name);
	}

	/**
	 * Create reference column, without its foreign key relation.
	 */
	public function referenceColumn($name) {
		return $this->foreignId($name);
	}

	/**
	 * Create foreign key relation for an existing reference column.
	 */
	public function reference($column, $foreignTable, $foreignKey = 'id', $name = NULL) {
		return $this->foreign($column, $name)->references($foreignKey)->on($foreignTable);
	}

	/**
	 * Drop an existing foreign key relation.
	 */
	public function dropReference($column) {
		return $this->dropForeign($this->createIndexName('foreign', [$column]));
	}

}
