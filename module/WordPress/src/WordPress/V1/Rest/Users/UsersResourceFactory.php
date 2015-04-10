<?php
namespace WordPress\V1\Rest\Users;

class UsersResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new UsersMapper();
        return new UsersResource( $mapper );
    }
}
