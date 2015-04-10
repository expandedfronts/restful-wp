<?php
namespace WordPress\V1\Rest\Taxonomies;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class TaxonomiesMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {

		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'taxonomies';
	}

	public function create_taxonomy( $data ) {

	}

	public function delete_taxonomy( $id ) {

	}

	public function fetch_taxonomy( $id ) {

	}

	public function fetch_taxonomies() {

	}

	public function update_taxonomy() {

	}

}
