<?php

namespace Model\Cache;
    
use X\Model;
    
class ProfileModel extends Model {
        
    protected $table = "profile";

    public function getProfile($identification, $size, $type, $option = NULL) {
        $i = $this->where("identification", $identification)->where("type", $type)->where("size", $size);
        if ($option !== NULL) $i->where("gr_options", $option);
        return $i->findOne();
    }

    public function updateProfile($identification, $size, $type, $hash, $last_modified, $last_update, $option = NULL) {
        $i = $this->where("identification", $identification)->where("type", $type)->where("size", $size);
        if ($option !== NULL) $i->where("gr_options", $option);
        $set = $i->findOne();
        $set->hash = $hash;
        $set->last_modified = $last_modified;
        $set->last_update = $last_update;
        $set->save();
    }

    public function updateTime($identification, $size, $type, $last_update, $option = NULL) {
        $i = $this->where("identification", $identification)->where("type", $type)->where("size", $size);
        if ($option !== NULL) $i->where("gr_options", $option);
        $set = $i->findOne();
        $set->last_update = $last_update;
        $set->save();
    }

    public function addProfile($identification, $type, $hash, $size, $raw_url, $raw_id, $last_modified, $last_update, $option = NULL) {
        $i = $this->create();
        $i->identification = $identification;
        $i->type           = $type;
        $i->hash           = $hash;
        $i->size           = $size;
        $i->raw_url        = $raw_url;
        $i->raw_id         = $raw_id;
        $i->last_modified  = $last_modified;
        $i->last_update    = $last_update;
        if ($option !== NULL) $i->gr_options = $option;
        $i->save();
        return true;
    }

}