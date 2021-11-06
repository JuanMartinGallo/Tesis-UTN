<?php
    namespace Models;

    class Alert
    {
        private $type;
        private $message;

        public function __construct($type = NULL, $message = NULL)
        {
            $this->type = $type;
            $this->message = $message;
        }

        public function getType(){ return $this->type; }
        public function setType($type): self { $this->type = $type; return $this; }

        public function getMessage(){ return $this->message; }
        public function setMessage($message): self { $this->message = $message; return $this; }
    }
?>