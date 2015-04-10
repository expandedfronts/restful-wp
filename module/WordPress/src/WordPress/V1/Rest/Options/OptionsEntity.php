<?php
namespace WordPress\V1\Rest\Options;

class OptionsEntity
{
	public $option_id;

	public $option_name;

	public $option_value;

	public $autoload;

	public function getArrayCopy() {
		return array(
			'option_id' 	=> $this->option_id,
			'option_name' 	=> $this->option_name,
			'option_value' 	=> $this->option_value,
			'autoload' 		=> $this->autoload,
		);
	}

	public function exchangeArray( array $array ) {
		$this->option_id 	= $array['option_id'];
		$this->option_name 	= $array['option_name'];
		$this->option_value = $array['option_value'];
		$this->autoload 	= $array['autoload'];
	}
}
