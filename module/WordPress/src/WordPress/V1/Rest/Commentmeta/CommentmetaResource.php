<?php
namespace WordPress\V1\Rest\Commentmeta;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class CommentmetaResource extends AbstractResourceListener
{

    /**
     * Stores an instance of the CommentmetaMapper object.
     * @var CommentmetaMapper
     */
    protected $mapper;

    /**
     * Constructs the class.
     *
     * @access public
     * @param  object $mapper The CommentmetaMapper Object
     */
    public function __construct( $mapper ) {
        $this->mapper = $mapper;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return $this->mapper->create_meta( $data, $this->get_comment_id() );
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return $this->mapper->delete_meta( $id, $this->get_comment_id() );
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->mapper->fetch_meta( $id, $this->get_comment_id() );
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->mapper->fetch_all_meta( $params, $this->get_comment_id() );
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return $this->mapper->update_meta( $id, $data, $this->get_comment_id() );
    }

    /**
     * Returns the ID of the current comment.
     *
     * @access private
     * @return int
     */
    private function get_comment_id() {
        return $this->getEvent()->getRouteMatch()->getParam('comment_id');
    }
}
