<?php

class File
{
    private $filename;
    private $file;
    private $mode;

    public function __construct($filename, $mode = 'r')
    {
        $this->filename = $filename;
        $this->mode = $mode;
    }

    public function canWrite()
    {
        if (!$this->exists()) {
            return false;
        }

        return is_writable($this->filename);
    }

    public function exists()
    {
        return file_exists($this->filename);
    }

    public function canRead()
    {
        if (!$this->exists()) {
            return false;
        }

        return is_readable($this->filename);
    }

    public function getInfos()
    {
        if (!$this->exists()) {
            return [];
        }

        return pathinfo($this->filename);
    }

    public function getContent()
    {
        if (!$this->open()) {
            return false;
        }

        $content = '';
        do {
            $line = fgets($this->file);
            $content .= $line;
        } while ($line);

        rewind($this->file);

        return $content;
    }

    public function open()
    {
        if (isset($this->file) && $this->file !== false) {
            return true;
        }

        if (!in_array($this->mode, ['w', 'w+', 'a', 'a+', 'x', 'x+']) && !file_exists($this->filename)) {
            throw new Exception('File not found : ' . $this->filename);
        }
        $file = fopen($this->filename, $this->mode);

        if (!$file) {
            throw new Exception('File not found : ' . $this->filename);
        }
        $this->file = $file;

        return true;
    }

    public function setContent($content)
    {
        if (!$this->open()) {
            return false;
        }

        fwrite($this->file, $content);
    }

    function __destruct()
    {
        try {
            if ($this->open()) {
                fclose($this->file);
            }
        } catch (Exception $ex) {

        }
    }
}
