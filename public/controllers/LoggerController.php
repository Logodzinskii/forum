<?

class LoggerController{
    private $writer, $string;

    public function __construct(LogWriter $writer, $str)
    {
        $this->writer = $writer;
        $this->string = $str;
    }

    public function write(){
        $this->writer->writeLog($this->string);
    }

}
