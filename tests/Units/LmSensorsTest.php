<?php


namespace Tests\Units;
use Tests\TestCase;
use Takuya\SystemUtil\PhpLmsensorsWrapper\Sensors;

class LmSensorsTest extends TestCase {
  
  public function test_parse_lm_sensor_result(){
    $obj = new Sensors();
    //
    foreach (range(1, 5) as $idx) {
      $ret = $this->{"sample_data_0{$idx}"}();
      $obj->setResult($ret);
      $json = $obj->toJson();
      $data = json_decode($json,JSON_OBJECT_AS_ARRAY);
      $this->assertArrayHasKey('Name',$data[0]);
      $this->assertArrayHasKey('Adapter',$data[0]);
      $this->assertArrayHasKey('Temperature',$data[0]);
    }
  }
  public function test_sensor_cmd_via_ssh(){
    ///
    $obj = new Sensors();
    $obj->execute('ssh s0 -- sensors');
    $json = $obj->toJson();
    // check response;
    $data = json_decode($json,JSON_OBJECT_AS_ARRAY);
    $this->assertArrayHasKey('Name',$data[0]);
    $this->assertArrayHasKey('Adapter',$data[0]);
    $this->assertArrayHasKey('Temperature',$data[0]);
  }
  
  
  protected function sample_data_01(){
    // Intel(R) Core(TM) i7-6700 CPU @ 3.40GHz
    $str=<<<"EOS"
        coretemp-isa-0000
        Adapter: ISA adapter
        Package id 0:  +29.0°C  (high = +84.0°C, crit = +100.0°C)
        Core 0:        +25.0°C  (high = +84.0°C, crit = +100.0°C)
        Core 1:        +25.0°C  (high = +84.0°C, crit = +100.0°C)
        Core 2:        +26.0°C  (high = +84.0°C, crit = +100.0°C)
        Core 3:        +25.0°C  (high = +84.0°C, crit = +100.0°C)
        
        acpitz-acpi-0
        Adapter: ACPI interface
        temp1:        +27.8°C  (crit = +119.0°C)
        temp2:        +29.8°C  (crit = +119.0°C)
        
        nvme-pci-0600
        Adapter: PCI adapter
        Composite:    +46.9°C  (low  =  -0.1°C, high = +117.8°C)
                               (crit = +149.8°C)
        EOS;

    return $str;
  }
  protected function sample_data_02(){
    // Intel(R) Pentium(R) CPU N4200 @ 1.10GHz  | LivaZ2
    $str=<<<"EOS"
        acpitz-acpi-0
        Adapter: ACPI interface
        temp1:        +53.0 C  (crit = +100.0 C)
        
        coretemp-isa-0000
        Adapter: ISA adapter
        Package id 0:  +54.0 C  (high = +105.0 C, crit = +105.0 C)
        Core 0:        +52.0 C  (high = +105.0 C, crit = +105.0 C)
        Core 1:        +52.0 C  (high = +105.0 C, crit = +105.0 C)
        Core 2:        +54.0 C  (high = +105.0 C, crit = +105.0 C)
        Core 3:        +53.0 C  (high = +105.0 C, crit = +105.0 C)
        EOS;
    
    return $str;
  }
  protected function sample_data_03(){
    // armv6l |  raspberry pi zero
    $str=<<<"EOS"
      cpu_thermal-virtual-0
      Adapter: Virtual device
      temp1:        +32.6°C
      
      rpi_volt-isa-0000
      Adapter: ISA adapter
      in0:              N/A
      EOS;
    
    return $str;
  }
  protected function sample_data_04(){
    // AMD Ryzen 7 PRO 4750GE with Radeon Graphics | think centre tiny
    $str=<<<"EOS"
      k10temp-pci-00c3
      Adapter: PCI adapter
      Tdie:         +25.0°C  (high = +70.0°C)
      Tctl:         +25.0°C
      EOS;
    
    return $str;
  }
  protected function sample_data_05(){
    // Intel(R) Celeron(R) CPU N3350 @ 1.10GHz | LivaZ2
    $str=<<<"EOS"
      acpitz-acpi-0
      Adapter: ACPI interface
      temp1:        +33.0°C  (crit = +100.0°C)
      
      coretemp-isa-0000
      Adapter: ISA adapter
      Package id 0:  +34.0°C  (high = +105.0°C, crit = +105.0°C)
      Core 0:        +33.0°C  (high = +105.0°C, crit = +105.0°C)
      Core 2:        +34.0°C  (high = +105.0°C, crit = +105.0°C)
      EOS;
    return $str;
  }

}