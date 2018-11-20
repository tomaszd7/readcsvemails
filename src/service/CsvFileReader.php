<?php

namespace Service;

/**
 * Description of CsvFileReader
 *
 * @author tomasz
 */
class CsvFileReader {
       
    /**
     * 
     * @param string $filename
     * @return type array
     */
    public function read(string $filename) {
        $emails = [];

        if (false !== ($fileHandle = fopen($filename, "r"))) {
          while (($data = fgetcsv($fileHandle))) {		
              $emails = array_merge($emails, $data);
          }
          fclose($fileHandle);
        }
        return $emails;        
    }
}
