<?php
/*
    This file is part of the Resipedia project <http://www.github.com/cedricfrancoys/resipedia>
    Some Rights Reserved, Cedric Francoys, 2018, Yegen
    Licensed under GNU GPL 3 license <http://www.gnu.org/licenses/>
*/
use dropoo\Document;

list($params, $providers) = announce([
    'description'   => 'Returns a list of entites according to given domain (filter), start offset, limit and order.',
    'params'        => [
        'hash' =>  [
            'description'   => 'Unique identifier of the resource.',
            'type'          => 'string', 
            'required'      => true
        ]
    ],
    'providers'     => ['context', 'orm'] 
]);

list($context, $om) = [ $providers['context'], $providers['orm'] ];

// documents are public : we d'ont use collections to bypass any permission check
$ids = $om->search('dropoo\Document', ['hash', '=', $params['hash']]);

if(count($ids) < 1) {
    throw new Exception("wrong identifier '{$params['hash']}'", QN_ERROR_UNKNOWN_OBJECT);
}

// retrieve document
$objects = $om->read('dropoo\Document', $ids, ['name', 'data', 'content_type', 'size']);
if($objects < 0) {
	throw new Exception("unable to retrieve object", QN_ERROR_UNKNOWN);
}

$context->httpResponse()
        ->header('Content-Type', $objects[$ids[0]]['content_type'])
        ->body($objects[$ids[0]]['data'], true)
        ->send();