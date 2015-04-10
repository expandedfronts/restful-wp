<?php
namespace WordPress\V1\Rest\Posts;

class PostsResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new PostsMapper();
        return new PostsResource( $mapper );
    }
}
