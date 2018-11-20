<?php


namespace Service;

/**
 * Description of ScriptValidator
 *
 * @author tomasz
 */
class ScriptValidator {
    
    const LOG_ERRORS = 0;
    const THROW_ERRORS = 1;
    protected $errorLogging;
    
    public function __construct(int $errorLoggin) {
        $this->errorLogging = $errorLoggin;
    }
    /**
     * check if all running parameters are met before reading file
     * @param int $paramCount
     * @param array $params
     * @return type string
     * @throws Exception
     */
    public function validate(int $paramCount, array $params) {
        try {
            if ("cli" !== php_sapi_name()) {
                throw new \Exception("This program runs only in console.");
            }

            if (2 !== $paramCount) {
                throw new \Exception("Program requires only 1 parameter as filename.");    
            }

            $filename = $params[1];
            if (".csv" !== substr($filename, -4)) {
                throw new \Exception("Argument has to be a CSV file.");
            }

            if (!file_exists($filename)) {
                throw new \Exception(sprintf("File %s does not exist.", $filename));
            }
        } catch (\Exception $e) {
            // return error in case of logging 
            if (self::LOG_ERRORS === $this->errorLogging) {
                return "ERROR: " . $e->getMessage();
            }
            throw new \Exception($e->getMessage());
        }
    }
}
