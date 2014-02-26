<?php

/**
 * Description of Community
 *
 * @author Hichem MHAMED
 */
class Community extends Eloquent
{
    protected $table = 'communities';
    
    public $presenter = 'Presenters\CommunityPresenter';
    
    protected $fillable = array('name', 'slug','description','creator_id');
    
    
    public function creator()
    {
        return $this->belongsTo('User','creator_id');
    }
}

?>