<?php 
interface ProductInterface{
    public function fetchproducts();
    public function deleteProducts($id);
            public function InsertProducts($barcode, $proname, $stock, $pro_img, $pro_desc, $purchase_p, $selling_p);
    
}