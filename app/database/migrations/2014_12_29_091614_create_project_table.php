<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectTable extends Migration {

	private $tablename = 'sr_projects';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create($this->tablename, function (Blueprint $table) {
			$table->string('Code')->primary();
			$table->string('MasterCode')->nullable();
			$table->string('Address');
			$table->string('ClientRef');
			$table->string('Client');
			$table->string('ContractorRef')->nullable();
			$table->string('Coordinator');
			$table->string('Duration')->nullable();
			$table->string('Instructions')->nullable();
			$table->string('SLA')->nullable();
			$table->string('Status');
			$table->string('SubClient')->nullable();
			$table->string('TaskType');
			$table->string('Start')->nullable();
			$table->string('StartDate')->nullable();
			$table->string('Finish')->nullable();
			$table->string('FinishDate')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop($this->tablename);
	}

}
