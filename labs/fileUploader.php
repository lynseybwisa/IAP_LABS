<?php
    class FileUploader{
        private static $target_directory = "upload/";
        private static $size_limit = 50000; //Size given in bits
        private $uploadOk = false;
        private $file_original_name;
        private $file_type;
        private $file_size;
        private $final_file_name;
        private $temporary_file_name;

        public function __construct($data){
            $this->file_original_name = $data['name'];
            $this->file_size = $data['size'];
            $this->file_type = $data['type'];
            $this->file_tmp_name = $data['tmp_name'];
        }

        //Getters and setters
        public function setOriginalName($name){
            $this->file_original_name = $name;
        }

        public function getOriginalName(){
            return $this->file_original_name;
        }
        public function setTemporaryFileName($tmp_name){
            $this->file_tmp_name = $tmp_name;
        }

        public function getTemporaryFilename(){
            return $this->file_tmp_name;
        }

        public function setFileType($type){
            $this->file_type = $type;
        }

        public function getFileType(){
            return $this->file_type;
        }

        public function setFileSize(){
            $this->file_size = $file_size;
        }

        public function getFileSize(){
            return $this->file_size;
        }

        public function setFinalFileName($file_name){
            $this->final_file_name = $file_name;
        }

        public function getFinalFileName(){
            return $this->final_file_name;
        }

        //Methods
        
        public function fileAlreadyExists(){
            //Check if the file exists
            if(!file_exists("upload/" . $this->file_original_name)){
                return true;
            }else{
                return false;
            }
        }
        public function saveFilePathTo(){
            return FileUploader::$target_directory;
        }
            
        public function moveFile(){
            if(move_uploaded_file($this->file_tmp_name, $this->saveFilePathTo() . $this->file_original_name)){
                return true;
            }else{
                return false;
            }

        }
        public function fileTypeIsCorrect(){
             //The allowed File Types
             $allowed = array(
                "jpg" => "image/jpg",
                 "jpeg" => "image/jpeg",
                  "gif" => "image/gif",
                   "png" => "image/png");
            // Verify file extension
            $ext = pathinfo($this->file_original_name, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)){
                return false;
            }else{
                if(!in_array($this->file_type, $allowed)){
                    return false;
                }else{
                    return true;
                }
            }     
        }
        public function fileSizeIsCorrect(){
            if($this->file_size > FileUploader::$size_limit){
                return false;
            }else{
                return true;
            } 
        }
        public function fileWasSelected(){}

        public function uploadFile(){
            if($this->fileTypeIsCorrect()){
                if ($this->fileSizeIsCorrect()) {
                    if ($this->fileAlreadyExists()) {
                        if ($this->moveFile()) {
                            return true;
                        }
                    }
                }
            }
            return false;
        }
    }
?>