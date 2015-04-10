<?php
namespace WordPress\V1\Rest\Taxonomies;

class TaxonomiesResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new TaxonomiesMapper();
        return new TaxonomiesResource( $mapper );
    }
}
