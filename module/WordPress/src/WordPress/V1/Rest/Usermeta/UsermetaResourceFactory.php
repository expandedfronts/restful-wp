<?php
namespace WordPress\V1\Rest\Usermeta;

class UsermetaResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new UsermetaMapper();
        return new UsermetaResource( $mapper );
    }
}
