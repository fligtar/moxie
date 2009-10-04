<?php

class AttachmentModel extends Model {
    public $table = 'attachments';
    
    /**
     * Pulls attachments for the given deliverables and adds them to the array
     */
    public function addAttachmentsToDeliverables(&$deliverables) {
        $attachments = $this->getAll('deliverable_id IN ('.implode(',', array_keys($deliverables)).')');
        
        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                if (empty($deliverables[$attachment['deliverable_id']])) {
                    $deliverables[$attachment['deliverable_id']]['attachments'] = array();
                }
                $deliverables[$attachment['deliverable_id']]['attachments'][] = $attachment;
            }
        }
    }

}

?>