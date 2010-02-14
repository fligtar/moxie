<?php
if (!empty($vars['products'])) {
    echo '<ul>';
    foreach ($vars['products'] as $product) {
        echo '<li><a href="'.$this->getBaseURL().'/'.$product['url'].'">'.$product['name'].'</a></li>';
    }
    echo '</ul>';
}
?>