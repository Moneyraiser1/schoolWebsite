<?php 
interface GalleryInterface {
    public function fetchGalleryImages();
    public function deleteImage($id);
}