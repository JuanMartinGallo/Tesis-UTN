<?php

namespace Models;

class Admin extends User{
    private $firstName;
    private $lastName;
    private $dni;
    private $email;

    public function __construct($firstName = NULL, $lastName = NULL, $dni = NULL, $email = NULL)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dni = $dni;
        $this->email = $email;
    }

    public function getFirstName(){ return $this->firstName; }
    public function setFirstName($firstName): self { $this->firstName = $firstName; return $this; }

    public function getLastName(){ return $this->lastName; }
    public function setLastName($lastName): self { $this->lastName = $lastName; return $this; }

    public function getDni(){ return $this->dni; }
    public function setDni($dni): self { $this->dni = $dni; return $this; }

    public function getEmail(){ return $this->email; }
    public function setEmail($email): self { $this->email = $email; return $this; }
}
?>
