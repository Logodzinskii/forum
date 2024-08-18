<?
interface LogWriter
{
    public function writeLog($string);
}
class FileLogWriter implements LogWriter{
    
    public function writeLog($string)
    {
        $fileName = dirname(__DIR__, 1).'/log/log.txt';
        $data = new \DateTime('now');
        $str = $data->format('Y-m-d h:i:s') . '-'. $string;
        file_put_contents($fileName, PHP_EOL . $str, FILE_APPEND);
    }
}