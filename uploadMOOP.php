<?php


class uploadMOOP
{
    private $target_dir;
    private $inputName;
    private $totalLength;
    private $uploadOk;
    private $error = "";

    public function setValue($directory, $inputName) {
        $this->target_dir = $directory;
        $this->inputName = $inputName;
        $this->totalLength = count($_FILES[$this->inputName]['name']);
    }

    public function processUpload() {
        $total = $this->totalLength;
        for ($i = 0; $i < $total; $i++) {
            $fileName = $_FILES[$this->inputName]['name'][$i];
            $target_file = $this->target_dir . basename($fileName);
            $this->uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (($this->processFilter($this->inputName,$i, $imageFileType)) == true) {
                move_uploaded_file($_FILES["transcriptFile"]["tmp_name"][$i], $target_file);
                echo $this->error = "Uploaded $fileName completed!<br/>";
            }

            else
                return $this->error;

        }
    }

    private function processFilter($inputName, $index, $imageFileType ) {

        // Allow files formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $this->error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
            $this->uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($this->uploadOk == 0) {
             $this->error .="Sorry, your file was not uploaded.<br/>";
            return false;
        } else {
            return true;
        }
    }

}