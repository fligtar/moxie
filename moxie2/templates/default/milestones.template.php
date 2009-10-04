<?php
if (!empty($vars['milestones'])) {
    echo '<ul>';
    foreach ($vars['milestones'] as $milestone) {
        echo '<li><a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/milestones/'.$milestone['url'].'">'.$milestone['name'].'</a></li>';
    }
    echo '</ul>';
}
?>