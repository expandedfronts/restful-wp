<?php
namespace WordPress\V1\Rest\Postmeta;

class PostmetaResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new PostmetaMapper();
        return new PostmetaResource( $mapper );
    }
}
