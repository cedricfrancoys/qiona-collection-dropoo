<?php
namespace dropoo;

use qinoa\orm\Model;

class Document extends Model {

    public static function getColumns() {
        return array(
            'name'		    => array('type' => 'string'),        
            'data'			=> array('type' => 'file', 'onchange' => 'dropoo\Document::onchangeContent'),
            'content_type'	=> array('type' => 'string'),
            'size'		    => array('type' => 'integer'),
            'hash'			=> array('type' => 'string'),
        );
    }

    public static function onchangeContent($om, $oids, $lang) {
        $res = $om->read(__CLASS__, $oids, ['data']);
        
        foreach($res as $oid => $odata) {
            $content = $odata['data'];
            $size = strlen($content);
            // retrieve content_type from MIME
            $finfo = new \finfo(FILEINFO_MIME);    
            $content_type = explode(';', $finfo->buffer($content))[0];
            $om->write('dropoo\Document', $oid, 
                array(
                        'size'		        => $size, 
                        'content_type'		=> $content_type,
                        'hash'              => md5($oid.substr($content, 0, 128))
                ), 
                $lang);
        }
    }
}