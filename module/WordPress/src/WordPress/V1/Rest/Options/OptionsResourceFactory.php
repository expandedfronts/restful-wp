<?php
namespace WordPress\V1\Rest\Options;

class OptionsResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new OptionsMapper();
        return new OptionsResource( $mapper );
    }
}
