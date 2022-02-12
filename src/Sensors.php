<?php

namespace Takuya\SystemUtil\PhpLmsensorsWrapper;

use Symfony\Component\Process\Process;

class Sensors {
  
  protected $sensor_cmd = 'sensor';
  protected $result='';
  public function __construct() {
  
  }
  public function toJson($opts=null){
    if(!$opts){
      $opts=JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT;
    }
    return json_encode($this->parse(),$opts);
  }
  public function setResult(string $result){
    $this->result=$result;
  }
  public function parse() {
    
    $str = $this->result;
    $list = preg_split('/^$/m', $str);
    $list = array_map('trim', $list);
    $result = [];
    foreach ($list as $idx => $item) {
      
      $name = null;
      $adapter = null;
      $temperature = null;
      $item = preg_replace_callback('|^(.+)\n|', function ( $matches ) use ( &$name ) {
        $name = $matches[1];
        
        return "";
      },                            $item);
      $item = preg_replace_callback('|^Adapter:(.+)$|m', function ( $matches ) use ( &$adapter ) {
        $adapter = $matches[1];
        
        return "";
      },                            $item);
      preg_match_all('|^(.+):(.+)|m', $item, $matches);
      $temperature = array_combine($matches[1], $matches[2]);
      $temperature = array_map('trim', $temperature);
      $result[] = [
        'Name'=>$name,
        'Adapter' => $adapter,
        'Temperature'=>$temperature
      ];
    }
    
    return $result;
  }
  
  public function execute( string $sensor_cmd = null ) {
    if( $sensor_cmd != null ) {
      $this->setSensorCmd($sensor_cmd);
    }
    //
    $proc = new Process(preg_split('/\s/', $this->sensor_cmd));
    $proc->run();
    $out = $proc->getOutput();
    
    return $this->result=$out;
  }
  
  /**
   * @param string $sensor_cmd
   */
  public function setSensorCmd( string $sensor_cmd ):void {
    $sensor_cmd = trim($sensor_cmd);
    $this->sensor_cmd = $sensor_cmd;
  }
}