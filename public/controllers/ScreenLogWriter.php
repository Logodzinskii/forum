<?
class ScreenLogWriter implements LogWriter{
    public function writeLog($string)
    {
        echo $string . PHP_EOL;
    }
}
