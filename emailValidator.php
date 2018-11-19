<?php
/**
 * log validation errors into info file or throw exceptions
 */
const ERROR_LOGGING = true;

// validation handling
$error = validateRunningParams($argc, $argv);

$fullFilename = $argv[1];
$fileName = explode(".csv", $fullFilename)[0];

$infoFileName = prepareFileName($fileName, "info", "txt");

if ($error) {
    saveDataToFile((array)$error, $infoFileName);
    exit(1);
}

// main program
$emails = readCSVFileIntoArray($fullFilename);

//assuming emails are in single column and with no header
$validEmails = getValidEmails($emails);
$invalidEmails = array_diff($emails, $validEmails);


// handling output
// save valid emails
$validEmailsFileName = prepareFileName($fileName, "valid");
saveDataToFile($validEmails, $validEmailsFileName);

// save invalid emails
$inValidEmailsFileName = prepareFileName($fileName, "invalid");
saveDataToFile($invalidEmails, $inValidEmailsFileName);

// save execution info
$texts = [];
$texts[] = sprintf("Found %d valid emails and saved into file %s", count($validEmails), $validEmailsFileName);
$texts[] = sprintf("Found %d invalid emails and saved into file %s", count($invalidEmails), $inValidEmailsFileName);
$texts[] = 'No errors found.';
saveDataToFile($texts, $infoFileName);

exit(0);

/**
 * check if all running parameters are met before reading file
 * @param int $paramCount
 * @param array $params
 * @return type string
 * @throws Exception
 */
function validateRunningParams(int $paramCount, array $params) {
    try {
        if ("cli" !== php_sapi_name()) {
            throw new Exception("This program runs only in console.");
        }

        if (2 !== $paramCount) {
            throw new Exception("Program requires only 1 parameter as filename.");    
        }

        $filename = $params[1];
        if (".csv" !== substr($filename, -4)) {
            throw new Exception("Argument has to be a CSV file.");
        }

        if (!file_exists($filename)) {
            throw new Exception(sprintf("File %s does not exist.", $filename));
        }
    } catch (Exception $e) {
        // return error in case of logging 
        if (ERROR_LOGGING) {
            return "ERROR: " . $e->getMessage();
        }
        throw new Exception($e->getMessage());
    }
}

/**
 * read csv file into array
 * @param string $filename
 * @return type array
 */
function readCSVFileIntoArray(string $filename) {
    $emails = [];

    if (false !== ($fileHandle = fopen($filename, "r"))) {
      while (($data = fgetcsv($fileHandle))) {		
          $emails = array_merge($emails, $data);
      }
      fclose($fileHandle);
    }
    return $emails;
}

/**
 * 
 * check if entries are real emails
 * @param array $emails
 * @return type array 
 */
function getValidEmails(array $emails) {
    $validEmails = [];
    foreach ($emails as $email) {
        // taking only first column in case more data is provided
        if (is_array($email)) {
            $email = $email[0];
        }
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $validEmails[] = $email;
        }
    }    
    return $validEmails;
}

/**
 * save to file
 * @param array $data
 * @param string $filename
 * @param string $seperator
 */
function saveDataToFile(array $data, string $filename, string $seperator = "\n") {
    // using current workdir
    file_put_contents($filename, implode($seperator, $data));
}

/**
 * build filename
 * @param string $originalFileName
 * @param string $type
 * @param string $extenstion
 * @return type string
 */
function prepareFileName(string $originalFileName, string $type, string $extention = "csv") {
   $time = (new \DateTime());
   $elements = [$time->format('Y-m-d'), $time->format('H:i:s'), $originalFileName, $type];
   return implode("_", $elements) . "." . $extention;   
}