<?php

class ImageManager {

    public function __construct($filename) {

        if (is_file($filename)) 
        {
            $this->filename  = $filename;
            $this->info      = getimagesize($this->filename);
            $infos           = pathinfo($_FILES['photo']['name']);
            $extension       = $infos['extension'];
            $this->extension = $extension;
        } 
        else 
        {
            throw new Exception("Le fichier '$filename' n'existe pas !");
        }
    }

    public function resize_to($max_width, $max_height) {

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

    public function save_as($filename) {
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

    public function delete($filename) {
       if (file_exists ($filename)) {
            unlink($filename);
            return 'Fichier supprimé';
       } else {
           return 'Fichier inexistant';
       }
            
        /* // Ouvre un dossier bien connu, et liste tous les fichiers
        // Pour chaque fichier on extrait le partie avant l'extension
            // Si le nom du fichier avant l'extension est = au idchpter
                // Alors on efface ce fichier
                $dir = ROOT."images/";
                
                if (is_dir($dir)) {

                    echo "Le dossier est bien un dossier";
        
                    if ($dh = opendir($dir)) {
        
                        echo "On est bien entré dans le dossier";
        
                        while (($file = readdir($dh)) !== false) {
        
                            echo $file . ' ';
                            $detailsFile = pathinfo($file);
                            echo $detailsFile['filename'] . ' ' . $detailsFile['extension'] . ' ' . $detailsFile['dirname'] . ' ' . $detailsFile['basename'];
        
                            if ($detailsFile['filename'] === $chapterId)
                            {
                                echo "filename et chapter sont égaux";
        
                                fclose($file);
                                //unlink($detailsFile['basename']);
                                $result = unlink(realpath($file));
                                echo $result;
                            }
                        }
                        closedir($dh);
                    }
                } 
                */
    }

    public function filename() {

        return $this->filename;
    }

    protected function resource() {

        if (empty($this->resource)) {

            switch($this->info[2]) {

                case IMAGETYPE_PNG:  $this->resource = imagecreatefrompng($this->filename); break;
                case IMAGETYPE_JPEG: $this->resource = imagecreatefromjpeg($this->filename);  break;
                case IMAGETYPE_GIF:  $this->resource = imagecreatefromgif($this->filename); break;
                default :
                    throw new Exception("Type de fichier incompatible. Veuillez utiliser une image .gif, .png ou .jpg");
            }
        }
        return $this->resource;
    }

    public function extension() {

        return $this->extension;
    }
}