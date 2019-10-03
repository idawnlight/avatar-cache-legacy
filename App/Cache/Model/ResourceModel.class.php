<?php

namespace Model\Cache;
    
use X\Model;
    
class ResourceModel extends Model {
        
    protected $table = "resource";

    public function getResource($hash) {
        return $this->where("hash", $hash)->findOne();
    }

    public function addResource($hash, $mime) {
        $i = $this->create();
        $i->hash           = $hash;
        $i->mime           = $mime;
        $i->save();
        return true;
    }

}