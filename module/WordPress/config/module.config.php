<?php

$api_url = apply_filters( 'restful_wp_api_url', 'api' );

return array(
    'router' => array(
        'routes' => array(
            'word-press.rest.posts' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/posts[/:posts_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Posts\\Controller',
                    ),
                ),
            ),
            'word-press.rest.users' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/users[/:users_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Users\\Controller',
                    ),
                ),
            ),
            'word-press.rest.comments' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/comments[/:comments_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Comments\\Controller',
                    ),
                ),
            ),
            'word-press.rest.options' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/options[/:options_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Options\\Controller',
                    ),
                ),
            ),
            'word-press.rest.taxonomies' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/taxonomies[/:taxonomies_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Taxonomies\\Controller',
                    ),
                ),
            ),
            'word-press.rest.usermeta' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/users/:user_id/meta[/:usermeta_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Usermeta\\Controller',
                    ),
                ),
            ),
            'word-press.rest.commentmeta' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/comments/:comment_id/meta[/:commentmeta_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Commentmeta\\Controller',
                    ),
                ),
            ),
            'word-press.rest.postmeta' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => "/$api_url/posts/:post_id/meta[/:postmeta_id]",
                    'defaults' => array(
                        'controller' => 'WordPress\\V1\\Rest\\Postmeta\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'word-press.rest.posts',
            1 => 'word-press.rest.users',
            2 => 'word-press.rest.comments',
            3 => 'word-press.rest.options',
            4 => 'word-press.rest.taxonomies',
            5 => 'word-press.rest.usermeta',
            6 => 'word-press.rest.commentmeta',
            7 => 'word-press.rest.postmeta',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'WordPress\\V1\\Rest\\Posts\\PostsResource' => 'WordPress\\V1\\Rest\\Posts\\PostsResourceFactory',
            'WordPress\\V1\\Rest\\Users\\UsersResource' => 'WordPress\\V1\\Rest\\Users\\UsersResourceFactory',
            'WordPress\\V1\\Rest\\Comments\\CommentsResource' => 'WordPress\\V1\\Rest\\Comments\\CommentsResourceFactory',
            'WordPress\\V1\\Rest\\Options\\OptionsResource' => 'WordPress\\V1\\Rest\\Options\\OptionsResourceFactory',
            'WordPress\\V1\\Rest\\Taxonomies\\TaxonomiesResource' => 'WordPress\\V1\\Rest\\Taxonomies\\TaxonomiesResourceFactory',
            'WordPress\\V1\\Rest\\Usermeta\\UsermetaResource' => 'WordPress\\V1\\Rest\\Usermeta\\UsermetaResourceFactory',
            'WordPress\\V1\\Rest\\Commentmeta\\CommentmetaResource' => 'WordPress\\V1\\Rest\\Commentmeta\\CommentmetaResourceFactory',
            'WordPress\\V1\\Rest\\Postmeta\\PostmetaResource' => 'WordPress\\V1\\Rest\\Postmeta\\PostmetaResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'WordPress\\V1\\Rest\\Posts\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Posts\\PostsResource',
            'route_name' => 'word-press.rest.posts',
            'route_identifier_name' => 'posts_id',
            'collection_name' => 'posts',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Posts\\PostsEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Posts\\PostsCollection',
            'service_name' => 'Posts',
        ),
        'WordPress\\V1\\Rest\\Users\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Users\\UsersResource',
            'route_name' => 'word-press.rest.users',
            'route_identifier_name' => 'users_id',
            'collection_name' => 'users',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Users\\UsersEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Users\\UsersCollection',
            'service_name' => 'Users',
        ),
        'WordPress\\V1\\Rest\\Comments\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Comments\\CommentsResource',
            'route_name' => 'word-press.rest.comments',
            'route_identifier_name' => 'comments_id',
            'collection_name' => 'comments',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Comments\\CommentsEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Comments\\CommentsCollection',
            'service_name' => 'Comments',
        ),
        'WordPress\\V1\\Rest\\Options\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Options\\OptionsResource',
            'route_name' => 'word-press.rest.options',
            'route_identifier_name' => 'options_id',
            'collection_name' => 'options',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Options\\OptionsEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Options\\OptionsCollection',
            'service_name' => 'Options',
        ),
        'WordPress\\V1\\Rest\\Taxonomies\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Taxonomies\\TaxonomiesResource',
            'route_name' => 'word-press.rest.taxonomies',
            'route_identifier_name' => 'taxonomies_id',
            'collection_name' => 'taxonomies',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Taxonomies\\TaxonomiesEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Taxonomies\\TaxonomiesCollection',
            'service_name' => 'Taxonomies',
        ),
        'WordPress\\V1\\Rest\\Usermeta\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Usermeta\\UsermetaResource',
            'route_name' => 'word-press.rest.usermeta',
            'route_identifier_name' => 'usermeta_id',
            'collection_name' => 'usermeta',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Usermeta\\UsermetaEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Usermeta\\UsermetaCollection',
            'service_name' => 'Usermeta',
        ),
        'WordPress\\V1\\Rest\\Commentmeta\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Commentmeta\\CommentmetaResource',
            'route_name' => 'word-press.rest.commentmeta',
            'route_identifier_name' => 'commentmeta_id',
            'collection_name' => 'commentmeta',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Commentmeta\\CommentmetaEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Commentmeta\\CommentmetaCollection',
            'service_name' => 'Commentmeta',
        ),
        'WordPress\\V1\\Rest\\Postmeta\\Controller' => array(
            'listener' => 'WordPress\\V1\\Rest\\Postmeta\\PostmetaResource',
            'route_name' => 'word-press.rest.postmeta',
            'route_identifier_name' => 'postmeta_id',
            'collection_name' => 'postmeta',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WordPress\\V1\\Rest\\Postmeta\\PostmetaEntity',
            'collection_class' => 'WordPress\\V1\\Rest\\Postmeta\\PostmetaCollection',
            'service_name' => 'Postmeta',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'WordPress\\V1\\Rest\\Posts\\Controller' => 'Json',
            'WordPress\\V1\\Rest\\Users\\Controller' => 'HalJson',
            'WordPress\\V1\\Rest\\Comments\\Controller' => 'HalJson',
            'WordPress\\V1\\Rest\\Options\\Controller' => 'HalJson',
            'WordPress\\V1\\Rest\\Taxonomies\\Controller' => 'HalJson',
            'WordPress\\V1\\Rest\\Usermeta\\Controller' => 'HalJson',
            'WordPress\\V1\\Rest\\Commentmeta\\Controller' => 'HalJson',
            'WordPress\\V1\\Rest\\Postmeta\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'WordPress\\V1\\Rest\\Posts\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Comments\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Options\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
                3 => 'application/x-www-form-urlencoded',
            ),
            'WordPress\\V1\\Rest\\Taxonomies\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Usermeta\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Commentmeta\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Postmeta\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'WordPress\\V1\\Rest\\Posts\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Comments\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Options\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Taxonomies\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Usermeta\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Commentmeta\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
            'WordPress\\V1\\Rest\\Postmeta\\Controller' => array(
                0 => 'application/vnd.word-press.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'WordPress\\V1\\Rest\\Posts\\PostsEntity' => array(
                'entity_identifier_name' => 'ID',
                'route_name' => 'word-press.rest.posts',
                'route_identifier_name' => 'posts_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Posts\\PostsCollection' => array(
                'entity_identifier_name' => 'ID',
                'route_name' => 'word-press.rest.posts',
                'route_identifier_name' => 'posts_id',
                'is_collection' => true,
            ),
            'WordPress\\V1\\Rest\\Users\\UsersEntity' => array(
                'entity_identifier_name' => 'ID',
                'route_name' => 'word-press.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Users\\UsersCollection' => array(
                'entity_identifier_name' => 'ID',
                'route_name' => 'word-press.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ),
            'WordPress\\V1\\Rest\\Comments\\CommentsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'word-press.rest.comments',
                'route_identifier_name' => 'comments_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Comments\\CommentsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'word-press.rest.comments',
                'route_identifier_name' => 'comments_id',
                'is_collection' => true,
            ),
            'WordPress\\V1\\Rest\\Options\\OptionsEntity' => array(
                'entity_identifier_name' => 'option_name',
                'route_name' => 'word-press.rest.options',
                'route_identifier_name' => 'options_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Options\\OptionsCollection' => array(
                'entity_identifier_name' => 'option_name',
                'route_name' => 'word-press.rest.options',
                'route_identifier_name' => 'options_id',
                'is_collection' => true,
            ),
            'WordPress\\V1\\Rest\\Taxonomies\\TaxonomiesEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'word-press.rest.taxonomies',
                'route_identifier_name' => 'taxonomies_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Taxonomies\\TaxonomiesCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'word-press.rest.taxonomies',
                'route_identifier_name' => 'taxonomies_id',
                'is_collection' => true,
            ),
            'WordPress\\V1\\Rest\\Usermeta\\UsermetaEntity' => array(
                'entity_identifier_name' => 'umeta_id',
                'route_name' => 'word-press.rest.usermeta',
                'route_identifier_name' => 'usermeta_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Usermeta\\UsermetaCollection' => array(
                'entity_identifier_name' => 'umeta_id',
                'route_name' => 'word-press.rest.usermeta',
                'route_identifier_name' => 'usermeta_id',
                'is_collection' => true,
            ),
            'WordPress\\V1\\Rest\\Commentmeta\\CommentmetaEntity' => array(
                'entity_identifier_name' => 'meta_key',
                'route_name' => 'word-press.rest.commentmeta',
                'route_identifier_name' => 'commentmeta_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Commentmeta\\CommentmetaCollection' => array(
                'entity_identifier_name' => 'meta_key',
                'route_name' => 'word-press.rest.commentmeta',
                'route_identifier_name' => 'commentmeta_id',
                'is_collection' => true,
            ),
            'WordPress\\V1\\Rest\\Postmeta\\PostmetaEntity' => array(
                'entity_identifier_name' => 'meta_key',
                'route_name' => 'word-press.rest.postmeta',
                'route_identifier_name' => 'postmeta_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'WordPress\\V1\\Rest\\Postmeta\\PostmetaCollection' => array(
                'entity_identifier_name' => 'meta_key',
                'route_name' => 'word-press.rest.postmeta',
                'route_identifier_name' => 'postmeta_id',
                'is_collection' => true,
            ),
        ),
    ),
);
