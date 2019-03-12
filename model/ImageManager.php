<?php

class ImageManager {

    /**
     * __construct
     *
     * @param  string $filename
     *
     * @return void
     */
    public function __construct(string $filename = null)
    {
        if (is_file($filename)) 
        {
            if(file_exists($filename)) {
                $this->filename  = $filename;
                $this->info      = getimagesize($this->filename);
                if($_FILES) {
                    $infos           = pathinfo($_FILES['photo']['name']);
                    $extension       = $infos['extension'];
                    $this->extension = $extension;
                }
            }
            else {
                return null;
            }
        } 
        else 
        {
            throw new Exception("Le fichier '$filename' n'existe pas !");
        }
    }

    /**
     * To resize the uploaded photo when adding a new chapter
     *
     * @param  int $max_width
     * @param  int $max_height
     *
     * @return void
     */
    public function resize_to(int $max_width, int $max_height) 
    {
        //If image dimension is smaller, do not resize
        if ($this->info[0] <= $max_width && $this->info[1] <= $max_height) 
        {
            $new_height = $this->info[1];
            $new_width  = $this->info[0];
        } 
        else 
        {
            if ($max_width/$this->info[0] > $max_height/$this->info[1]) 
            {
                $new_width  = (int)round($this->info[0]*($max_height/$this->info[1]));
                $new_height = $max_height;
            } 
            else 
            {
                $new_width  = $max_width;
                $new_height = (int)round($this->info[1]*($max_width/$this->info[0]));
            }
        }

        $new_img = imagecreatetruecolor($new_width, $new_height);

        // If image is PNG or GIF, set it transparent
        if(($this->info[2] == 1) OR ($this->info[2]==3)) {

            imagealphablending($new_img, false);
            imagesavealpha($new_img, true);
            $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
            imagefilledrectangle($new_img, 0, 0, $new_width, $new_height, $transparent);
        }

        imagecopyresampled($new_img, $this->resource(), 0, 0, 0, 0, $new_width, $new_height, $this->info[0], $this->info[1]);

        imagedestroy($this->resource);
        $this->resource = $new_img;

        $this->info[0]  = $new_width;
        $this->info[1]  = $new_height;

        return $this;
    }

    /**
     * To save the photo and limit authorized formats
     *
     * @param  string $filename
     *
     * @return ImageManager
     */
    public function save_as(string $filename) 
    {
        switch($this->info[2]) 
        {
            case IMAGETYPE_PNG:  imagepng ($this->resource(), $filename); break;
            case IMAGETYPE_JPEG: imagejpeg($this->resource(), $filename); break;
            case IMAGETYPE_GIF:  imagegif ($this->resource(), $filename); break;
            default :
                throw new Exception("Type de fichier incompatible. Veuillez sauvegarder l'image en .gif, .png ou .jpg");
        }
        $this->filename = $filename;
        return $this;
    }

    /**
     *  To delete the saved photo when deleting the chapter
     *
     * @param  string $filename
     *
     * @return void
     */
    public function delete(string $filename): void
    {
       if (file_exists ($filename)) {
            unlink($filename);
       } 
    }

    // GETTERS

    public function filename() 
    {
        return $this->filename;
    }

    protected function resource() 
    {
        if (empty($this->resource)) {
            switch($this->info[2]) 
            {
                case IMAGETYPE_PNG:  $this->resource = imagecreatefrompng($this->filename); break;
                case IMAGETYPE_JPEG: $this->resource = imagecreatefromjpeg($this->filename);  break;
                case IMAGETYPE_GIF:  $this->resource = imagecreatefromgif($this->filename); break;
                default :
                    throw new Exception("Type de fichier incompatible. Veuillez utiliser une image .gif, .png ou .jpg");
            }
        }
        return $this->resource;
    }

    public function extension() 
    {
        return $this->extension;
    }
}