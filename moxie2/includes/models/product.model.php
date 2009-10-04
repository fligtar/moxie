<?php

class ProductModel extends Model {
    public $table = 'products';
    
    /**
     * Get the product's information based on the URL parameter,
     * which could either be the id or URL slug
     */
    public function getProductFromURL($param) {
        if (is_numeric($param)) {
            $product = $this->get($param);
        }
        else {
            $products = $this->getAll("url = '".escape($param)."'");
            $product = $products[0];
        }
        
        return $product;
    }
}

?>