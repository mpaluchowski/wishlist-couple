<?php
namespace lib;

class Controller {

	public function processAction() {
		if (!isset($_REQUEST['action']))
			die('No action, no reaction');

		$actionFunction = 'action_' . $_REQUEST['action'];
		if (method_exists($this, $actionFunction))
			$this->$actionFunction($_REQUEST);

		if (!$this->isAjax()) {
			header("Location: /");
		}
	}

	public function action_claim($params) {
		if (!isset($params['id']))
			die('ID missing');

		$claimManager = new \lib\ClaimManager();
		$claimManager->addClaim($params['id']);
	}

	private function isAjax() {
		return !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
				&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

}
