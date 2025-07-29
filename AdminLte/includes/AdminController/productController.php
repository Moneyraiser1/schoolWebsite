<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../AdminAbstract/productInterface.php";
require_once __DIR__ . "/../Model/Database.php";
  define('APPURL', 'http://localhost/FLCS');

class productController implements productInterface{
    private $id;
    private $db;

    private $imageFolder = "../productImage/"; // Adjust path if needed

    public function __construct() {
        $this->db = new Database();
    }

    // Fetch all images
    public function fetchproducts() {
        $this->db->query(query: "SELECT * FROM products ORDER BY id DESC");
        $rows = $this->db->resultSetObj();
        return (count($rows) > 0) ? $rows : false;
    }

    // Delete image by ID (from DB and filesystem)
    public function deleteProducts($id) {
        // Step 1: Get image filename
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(":id", $id);
        $record = $this->db->singleRecordObj();

        if ($record && isset($record->gallery)) {
            $filename = $record->gallery;
            $filePath = $this->imageFolder . $filename;

            // Step 2: Delete file from system
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Step 3: Delete from database
            $this->db->query("DELETE FROM gallery WHERE id = :id");
            $this->db->bind(":id", $id);
            return $this->db->execute();
        }

        return false;
    }
        
    public function InsertProducts($barcode, $proname, $stock, $pro_img, $pro_desc, $purchase_p, $selling_p) {
    if (empty($barcode) || empty($proname) || empty($stock) || empty($pro_img["name"]) || empty($pro_desc) || empty($purchase_p) || empty($selling_p)) {
        return "All fields are required!";
    }

    $uploadDir = __DIR__ . '/../productImage/';
    $fileName = basename($pro_img["name"]);
    $targetFile = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($pro_img["tmp_name"]);
    if ($check === false) {
        return "File is not an image.";
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        return "Only JPG, JPEG, PNG files are allowed.";
    }

    if (file_exists($targetFile)) {
        return "File already exists.";
    }

    if (move_uploaded_file($pro_img["tmp_name"], $targetFile)) {
        $this->db->query("INSERT INTO products (barcode, pro_name, stock, pro_image, pro_desc, purchase_price, sales_price) VALUES (:bc, :pname, :st, :pimg, :pdesc, :purp, :salep)");

        $this->db->bind(':bc', $barcode);
        $this->db->bind(':pname', $proname);
        $this->db->bind(':st', $stock);
        $this->db->bind(':pimg', $fileName);
        $this->db->bind(':pdesc', $pro_desc);
        $this->db->bind(':purp', $purchase_p);
        $this->db->bind(':salep', $selling_p);

        if ($this->db->execute()) {
            return true;
        } else {
            return "Failed to insert into database.";
        }
    } else {
        return "Failed to upload image.";
    }
}
    public function fetchSingleproduct($id) {
        $this->id = $id;
        $this->db->query(query: "SELECT * FROM products WHERE id =:id ");
        $this->db->bind(":id", $id);
        $rows = $this->db->singleRecordObj();
        return  $rows;
    }

public function updateProduct($id, $barcode, $proname, $stock, $pro_img, $pro_desc, $purchase_p, $selling_p) {
    $imageUpdated = false;

    if (!empty($pro_img["name"])) {
        // Get existing product
        $existingProduct = $this->fetchSingleproduct($id);
        $existingImagePath = __DIR__ . '/../productImage/' . $existingProduct->pro_image;
        if (file_exists($existingImagePath)) {
            unlink($existingImagePath);
        }

        $imageName = uniqid('', true) . "." . pathinfo($pro_img["name"], PATHINFO_EXTENSION);
        $imageUpdated = true;

        $this->db->query("UPDATE products SET barcode=:pro_barcode, pro_name=:pro_name, stock=:pro_stock, pro_image=:pro_image, pro_desc=:pro_desc, purchase_price=:pro_purchase_price, sales_price=:pro_selling_price WHERE id=:id");

        $this->db->bind(":pro_image", $imageName);
    } else {
        $this->db->query("UPDATE products SET barcode=:pro_barcode, pro_name=:pro_name, stock=:pro_stock, pro_desc=:pro_desc, purchase_price=:pro_purchase_price, sales_price=:pro_selling_price WHERE id=:id");
    }

    // Common bindings
    $this->db->bind(":pro_barcode", $barcode);
    $this->db->bind(":pro_name", $proname);
    $this->db->bind(":pro_stock", $stock);
    $this->db->bind(":pro_desc", $pro_desc);
    $this->db->bind(":pro_purchase_price", $purchase_p);
    $this->db->bind(":pro_selling_price", $selling_p);
    $this->db->bind(":id", $id);

    if ($this->db->execute()) {
        if ($imageUpdated) {
            move_uploaded_file($pro_img["tmp_name"], __DIR__ . '/../productImage/' . $imageName);
        }
        return true;
    } else {
        return false;
    }
}


public function deleteProduct($id) {
    // Get the product details
    $product = $this->fetchSingleproduct($id);

    if ($product) {
        // Delete the product image
        $imagePath = __DIR__ . '/../productImage/' . $product->pro_image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the product from the database
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return "Failed to delete product.";
        }
    } else {
        return "Product not found.";
    }
}

}