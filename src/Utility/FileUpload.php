<?php
namespace App\Utility;


/**
  * File upload handler class for PHP
  *
  * @author Samuel Elh <samelh.com/contact>
  * @license GPL-2.0
  * @link https://github.com/elhardoum/FileUpload-PHP
  */

class FileUpload
{
    public $max_size;
    public $extensions;
    protected $file;
    public $path;
    public $name;
    protected $path_info;
    public $new_file_name;
    public $upload_dir;
    public $err_no_file, $err_size, $err_extension, $err_upload;
    public $last_message;
    public $upload_success;

    public function __construct($file=null)
    {
        if ( $file ) {
            $this->setFile($file);
        }

        return $this;
    }

    public static function instance() {
        // return fresh instance to avoid conflicts with previous uses
        return new FileUpload;
    }

    /**
      * Sets the main file to upload
      * This could also be done through constructor
      *
      * @param $file array file to upload (see $_FILES)
      */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
      * Set max upload size to allow in bytes
      *
      * @param $maxSize int size to allow in bytes
      */
    public function setMaxSize($maxSize)
    {
        $this->max_size = (int) $maxSize;

        return $this;
    }

    public function getMaxSize()
    {
        return $this->max_size;
    }

    /**
      * Just like setMaxSizeSet method, but allows you to pass-in size in MegaBytes
      *
      * @param $maxSize int size to allow in MB
      */
    public function setMaxSizeMB($maxSize)
    {
        $this->max_size = (int) $maxSize * 1048576;

        return $this;
    }

    /**
      * Allow file types to be uploaded by setting extensions
      *
      * @param $ext str|array extension(s) to allow
      */
    public function setExtensions($ext)
    {
        switch ( true ) {
            case is_array($ext):
            case is_object($ext):
                $this->extensions = (array) $ext;
                break;

            default:
                $this->extensions = array($ext);
                break;
        }

        return $this;
    }

    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
      * Checks all the stuff then processes the upload
      * @see FileUpload::process
      */
    public function upload()
    {
        $this->checkFile();

        if ( $this->err_no_file ) {
            return $this->error('No file to upload.');
        }

        $this->checkSize();

        if ( $this->err_size ) {
            return $this->error('Maximum upload size exceeded.');
        }

        $this->checkType();

        if ( $this->err_extension ) {
            return $this->error('File type not allowed.');
        }

        if ( $this->process() ) {
            return $this->success('File uploaded successfully!');
        } else {
            return $this->error('Could not process file.');
        }
    }

    /**
      * Return an error response array
      */
    public function error($message, $data=null)
    {
        $resp = array('success' => false, 'message' => $message);

        if ( $data && (array) $data ) {
            $resp = array_merge($resp, (array) $data);
        }

        $this->last_message = $resp;

        return $resp;
    }

    /**
      * Return a success message array
      */
    public function success($message, $data=null)
    {
        $resp = $this->error($message, $data);

        $resp['success'] = true;

        return $resp;
    }

    /**
      * Checks the main file (this->file) if valid file
      */
    private function checkFile()
    {
        $this->err_no_file = false;

        if ( !(isset($this->file['size']) && (int) $this->file['size']) )
            $this->err_no_file = true;

        return $this->err_no_file;
    }

    /**
      * Verifies the file size
      */
    private function checkSize()
    {
        $this->err_size = false;

        if ( empty($this->file['size']) )
            $this->err_size = true;

        else if ( $this->max_size && intval($this->file['size']) > $this->max_size )
            $this->err_size = true;

        return $this->err_size;
    }

    /**
      * Verifies the file extension
      */
    private function checkType()
    {
        $this->err_extension = false;

        if ( !isset($this->file['name']) ) {
            $this->err_extension = true;

            return $this->err_extension;
        }

        $this->path_info = pathinfo($this->file['name']);

        if ( empty($this->path_info['extension']) ) {
            $this->err_extension = true;

            return $this->err_extension;
        }

        if ( !$this->extensions )
            $this->err_extension = false;

        elseif ( !in_array(strtolower($this->path_info['extension']), array_map('strtolower', $this->extensions)) )
            $this->err_extension = true;

        return $this->err_extension;
    }

    /**
      * Set the new name to be set for the new upload (only file (base) name)
      *
      * @param $name str new file name
      */
    public function setNewFileName($name)
    {
        $this->new_file_name = $name;

        return $this;
    }

    public function getNewFileName()
    {
        return $this->new_file_name;
    }

    /**
      * This is required in order to upload the file to a certain directory
      * otherwise it will be upload to the directory where this file lives
      *
      * @param $dir str dir path
      */
    public function setUploadDir($dir)
    {
        $this->upload_dir = $dir;

        return $this;
    }

    public function getUploadDir()
    {
        return $this->upload_dir;
    }

    /**
      * Processes the new upload
      */
    private function process()
    {
        // one has to be sure
        if ( empty($this->file['tmp_name']) ) {
            $this->err_upload = true;

            return;
        }

        if ( $this->new_file_name ) {
            // save desired new file name
            $this->name = $this->new_file_name;
        } else {
            // save as regular file name
            $this->name = !empty($this->path_info['filename']) ? $this->path_info['filename'] : 'new-file';
        }

        // add extension
        $this->name .= '.' . $this->path_info['extension'];

        $this->path = $this->upload_dir ? $this->upload_dir : __DIR__;
        $this->path .= !in_array(substr($this->path, -1), array('/', '\\')) ? DIRECTORY_SEPARATOR : null;
        $this->path .= $this->name;

        if ( move_uploaded_file($this->file['tmp_name'], $this->path) ) {
            $this->err_upload = false;
            $this->upload_success = true;

            return true;
        } else {
            $this->err_upload = true;
            $this->upload_success = false;

            return false;
        }
    }

    /**
      * Check if upload was handled successfully
      */
    public function successful()
    {
        return (bool) $this->upload_success;
    }
}
