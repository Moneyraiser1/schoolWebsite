<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../AdminAbstract/galleryInterface.php";
require_once __DIR__ . "/../Model/Database.php";
  define('APPURL', 'http://localhost/FLCS');

class GalleryController implements GalleryInterface{
    private $db;
    private $img_Title;
    private $imageFolder = "../GalleryImage/"; // Adjust path if needed

    public function __construct() {
        $this->db = new Database();
    }

    // Fetch all images
    public function fetchGalleryImages() {
        $this->db->query(query: "SELECT * FROM gallery ORDER BY id DESC");
        $rows = $this->db->resultSetObj();
        return (count($rows) > 0) ? $rows : false;
    }

    // Delete image by ID (from DB and filesystem)
    public function deleteImage($id) {
        // Step 1: Get image filename
        $this->db->query("SELECT * FROM gallery WHERE id = :id");
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

    // Count images in gallery
    public function countImages() {
        $this->db->query("SELECT COUNT(*) as total FROM gallery");
        return $this->db->singleRecordObj();
    }

    public function uploadData($file, $img_Title) {
    $this->img_Title = $img_Title;
    $uploadDir = __DIR__ . '/../GalleryImage/';  // RESOLVES TO: C:\xampp\htdocs\FLCS\AdminLte\includes\images\
 // Physical server path
    $fileName = basename($file["name"]);
    $targetFile = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return "File is not an image.";
    }

    // Allowed formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        return "Only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Check for duplicates
    if (file_exists($targetFile)) {
        return "File already exists.";
    }

    // Move uploaded file
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Save filename in DB
        $this->db->query("INSERT INTO gallery (gallery, title) VALUES (:gal, :ti)");
        $this->db->bind(':gal', $fileName);
        $this->db->bind(':ti', $img_Title);
        if($this->db->execute()){
       
        return "Image uploaded successfully.";
             
        }
    } else {
        return "Error uploading file.";
    }
}


}
