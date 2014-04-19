<?php
namespace lib;

class Configuration {

	private $data = [];

	public function __construct($file = 'data/config.inc.php') {
		$this->load($file);
	}

	public function load($file) {
		if (!is_file($file)) {
			die('You need to create the file config.inc.php in the /data/ folder.');
		}
		include_once($file);

		$this->data['language'] = $language;
		$this->data['title'] = $title;
		$this->data['quote'] = $quote;
		$this->data['intro'] = $intro;
		$this->data['names'] = $names;

		$this->data['wishlists'] = $wishlists;

		$claimManager = new ClaimManager();
		foreach ($this->data['wishlists'] as $wishlist => $items) {
			foreach ($items as $key => $item) {
				$this->data['wishlists'][$wishlist][$key]['id'] =
						md5($wishlist . $item['name']);
				$this->data['wishlists'][$wishlist][$key]['claimed'] =
						$claimManager->isClaimed($this->data['wishlists'][$wishlist][$key]['id']);
			}
		}
	}

	public function getLanguage() {
		return $this->data['language'];
	}

	public function getTitle() {
		return $this->data['title'];
	}

	public function getQuote() {
		return $this->data['quote'];
	}

	public function getIntro() {
		return $this->data['intro'];
	}

	public function getName($index) {
		return $this->data['names'][$index];
	}

	public function getWishlists() {
		return $this->data['wishlists'];
	}

}
