<?php

class CommentModel extends Model {
    public $table = 'comments';
    
    /**
     * Pulls comments for the given deliverables and adds them to the array
     */
    public function addCommentsToDeliverables(&$deliverables) {
        $comments = $this->db->query("
            SELECT
                comments.*, users.name
            FROM comments 
            INNER JOIN users ON comments.user_id = users.id
            WHERE
                comments.deliverable_id IN (".implode(',', array_keys($deliverables)).")
        ");
        
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                if (empty($deliverables[$comment['deliverable_id']])) {
                    $deliverables[$comment['deliverable_id']]['comments'] = array();
                }
                $deliverables[$comment['deliverable_id']]['comments'][] = $comment;
            }
        }
    }

}

?>