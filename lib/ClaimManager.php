<?php
namespace lib;

class ClaimManager {

	private $data;
	private $filename;

	public function __construct($claimDatabase = 'data/claims.db.txt') {
		$this->filename = $claimDatabase;
	}

	public function addClaim($id) {
		// Try setting up thread safety
		if (function_exists("sem_get")) {
			$key = sem_get($this->filename);

			if (sem_acquire($key)) {
				$this->processAddClaim($id);
				sem_release($key);
			}
		} else {
			$this->processAddClaim($id);
		}
	}

	private function processAddClaim($id) {
		$this->readDatabase($this->filename);
		$this->data[$id] = "";
		$this->writeDatabase($this->filename);
	}

	public function isClaimed($id) {
		$this->readDatabase($this->filename);
		return array_key_exists($id, $this->data);
	}

	private function readDatabase($filename) {
		if (file_exists($filename))
			$this->data = unserialize(file_get_contents($filename));
		else
			$this->data = [];
	}

	private function writeDatabase($filename) {
		file_put_contents($filename, serialize($this->data));
	}

}
