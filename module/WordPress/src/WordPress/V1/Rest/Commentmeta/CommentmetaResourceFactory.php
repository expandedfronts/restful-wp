<?php
namespace WordPress\V1\Rest\Commentmeta;

class CommentmetaResourceFactory
{
    public function __invoke($services)
    {
    	$mapper = new CommentmetaMapper();
        return new CommentmetaResource( $mapper );
    }
}
