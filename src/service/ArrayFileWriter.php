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
        // using current workdir
        file_put_contents($filename, implode($seperator, $data));
    }    
    
}
