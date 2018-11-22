<?php

namespace Service;

/**
 * Description of ArrayFileWriter
 *
 * @author tomasz
 */
class ArrayFileWriter {

    /**
     * 
     * @param array $data
     * @param string $filename
     * @param string $seperator
     */
    public function save(array $data, string $filename, string $seperator = "\n") {
        file_put_contents($this->getLogFolder() . $filename, implode($seperator, $data));
    }    
    
    /**
     * log folder 
     * @return string
     */
    protected function getLogFolder() {
        return __DIR__ . "/../../logs/";
    }
    
}
