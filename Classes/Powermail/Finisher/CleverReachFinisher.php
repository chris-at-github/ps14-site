<?php

namespace Ps14\Site\Powermail\Finisher;

use WapplerSystems\Cleverreach\Powermail\Finisher\CleverReach;

/**
 * Der Finisher von EXT:cleverreach laeuft fuer alle Powermail-Formulare. Bei Formularen ohne
 * CleverReach-Einstellung (Kontakt, Service) wirft er "Undefined array key cleverreach".
 * Diese Formulare werden hier vorher uebersprungen.
 */
class CleverReachFinisher extends CleverReach {

	/**
	 * @return void
	 */
	public function cleverreachFinisher() {
		if(empty($this->settings['main']['cleverreach'])) {
			return;
		}

		parent::cleverreachFinisher();
	}
}
