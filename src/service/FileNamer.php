<?php


namespace Service;

/**
 * Description of FileNamer
 *
 * @author tomasz
 */
class FileNamer {
    
    const TEXT_INFO = 'info';
    const TEXT_VALID = 'valid';
    const TEXT_INVALID = 'invalid';
    
    const EXTENSION_CSV = 'csv';
    const EXTENSION_TXT = 'txt';
    
    /**
     *
     * @var type string
     */
    protected $originalFileName;
    protected $text;
    protected $extension;
    
    /**
     *
     * @var type \DateTime
     */
    protected $time;
    
    /**
     * 
     * @param string $originalFileName
     * @param \DateTime $time
     */
    public function setDefaults(string $originalFileName, \DateTime $time = null) {
        $this->originalFileName = $originalFileName;
                
        if (is_null($time)) {
            $time = new \DateTime();
        }
        $this->time = $time;
    }
    
    public function getInfoName() {
        $this->text = self::TEXT_INFO;
        $this->extension = self::EXTENSION_TXT;
        return $this->makeFileName();
    }
    
    public function getValidName() {
        $this->text = self::TEXT_VALID;
        $this->extension = self::EXTENSION_CSV;
        return $this->makeFileName();
    }
        
    public function getInvalidName() {
        $this->text = self::TEXT_INVALID;
        $this->extension = self::EXTENSION_CSV;
        return $this->makeFileName();
    }
    
    /**
     * 
     * @return type string
     */
    protected function makeFileName() {
        $elements = [
            $this->time->format('Y-m-d'), 
            $this->time->format('H:i:s'), 
            $this->originalFileName, 
            $this->text
                ];
        return implode("_", $elements) . "." . $this->extension; 
    }
}
