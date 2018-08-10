<?php

/**
 * The welcome 404 presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Welcome_404 extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
		$messages = array('Pssss...ya estamos otra vez...', '¿Pero esto funciona?', 'Uh Oh!', 'Cáspita...', 'Pero qué mierd...','Cachis en la má...');
		$this->title = $messages[array_rand($messages)];
	}
}
