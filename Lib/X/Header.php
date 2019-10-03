<?php
    /**
     * XPHP - PHP Framework
     * 
     * This project is licensed
     * under MIT. Please use it
     * under the license and law.
     * 
     * @category Framework
     * @package  XPHP
     * @author   Tianle Xu <xtl@xtlsoft.top>
     * @license  MIT
     * @link     https://github.com/xtlsoft/XPHP
     * 
     */
    
    namespace X;
    
    class Header {
        
        /**
         * The headers
         * 
         * @var $header
         * 
         */
        protected $header = [
                "Content-Type" => "text/html",
                "X-Powered-By" => "Mixcm Avatar"
            ];
        
        /**
         * Constructor
         * 
         * @param array The headers.
         * 
         * @return void
         * 
         */
        public function __construct($arr = []){
            
            $this->header = array_merge($this->header, $arr);
            
            return $this;
            
        }
        
        /**
         * Set a header
         * 
         * @param string name
         * @param string value
         * 
         * @return self
         * 
         */
        public function set($name, $value){
            
            if(is_array($name)){
                $this->__construct($name);

                return $this;
            }

            $this->header[$name] = $value;
            
            return $this;
            
        }
        
        /**
         * Dump the headers
         * 
         * @return array
         * 
         */
        public function dump(){
            
            return $this->header;
            
        }
        
    }