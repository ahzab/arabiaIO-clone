<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */

namespace ArabiaIOClone\Repositories;


interface VoteRepositoryInterface 
{
    

    public function tryUpvotePost($post, $user);
}

?>
