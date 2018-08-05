<?php

namespace Drupal\agiledrop\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\agiledrop\Days\DaysLeft;



/**
 * Provides a 'DaysEvent' Block.
 *
 * @Block(
 *   id = "days_event",
 *   admin_label = @Translation("Days Event"),
 *   category = @Translation("Custom"),
 * )
 */
class DaysEvent extends BlockBase implements ContainerFactoryPluginInterface  {
	
	
	private $daysLeft;
	
	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition){
		$daysLeft = $container->get('agiledrop.days_left');
		
		return new static(
			$configuration,
			$plugin_id,
			$plugin_definition,
			$daysLeft);
	}

	
	public function __construct(array $configuration, $plugin_id, $plugin_definition, DaysLeft $daysLeft){
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->daysLeft = $daysLeft;
	}
	
  /**
   * {@inheritdoc}
   */
  public function build() {
	  
	  //getting the node object
	  $nid = \Drupal::routeMatch()->getParameter('node');
	  //checking if we are on correct content type in this case event
	  if ($nid && $nid->getType() == 'event'){
		//getting the date value
		$days = $nid->field_event_date->value;
        // calling service for calculations
        $output = $this->daysLeft->eventDays($days);
	  }else {
		 //displaying msg if we are not on event
		 $output = "Choose an event to see the days.";
	  }
	  
	 //creating a block and setting the cache to no-cache
	 $build=[
				'#markup' => $output,
				'#cache' => ['max-age' => 0]
				];
				
	return $build;
	}
}
