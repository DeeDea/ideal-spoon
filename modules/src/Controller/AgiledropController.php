<?php

namespace Drupal\agiledrop\Controller;


class AgiledropController {

	public function content(){
	 return array(
                '#title' => 'Events',
                '#markup' => 'Days till event starts',
            );
	}
}

