<?php
namespace WordPress\V1\Rest\Comments;

class CommentsResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new CommentsMapper();
        return new CommentsResource( $mapper );
    }
}
