<?php
function checkCategory($id,$arrCate){
    if(!empty($arrCate)){
        return in_array($id,$arrCate);
    }
    return false;
}