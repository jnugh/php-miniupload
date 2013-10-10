<?php
  class Tpl {
    private $_path = TPL;
    
    public function __construct($file){
      if(!file_exists($this->_generatePath($file)))
        throw new Exception('Template not found!');
      $this->_file = $file;
    }
    
    private function _generatePath($file){
      return '../tpl/' . $this->_path . '/' . $file . '.php';
    }
    
    public function render(){
      include(_generatePath($this->_file));
    }
  }
