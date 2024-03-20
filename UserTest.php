<?php

namespace Oop\classes;

use PHPUnit\Framework\TestCase;
use Oop\classes\Database;
use Oop\classes\User;

class UserTest extends TestCase {
    
    private $user; // Declare $user property to hold User object
    private $db;

    protected function setUp(): void {
        parent::setUp();
        // Initialize $user with a new User object before each test
        $this->user = new User();
    }

    public function testRegisterUser(): void {
        // Test succes
        $this->assertTrue($this->user->registerUser('Amin', 'Auro'));
    
        // Test registration with existing username (should fail)
        $this->assertFalse($this->user->registerUser('Amin', 'Aura'));
    }
    

    public function testLoginUser(): void {
        $this->assertTrue($this->user->loginUser('Rauf', 'Cls'));
        $this->assertFalse($this->user->loginUser('Pookie', 'Bear'));
        $this->assertFalse($this->user->loginUser('Raul', 'Garcia'));
    }

    public function testIsLoggedin(): void {
        $this->assertFalse($this->user->isLoggedin());
        $this->user->loginUser('Pokemon', 'Greninja');
        $this->assertTrue($this->user->isLoggedin());
    }

    public function testLogoutUser(): void { // Corrected method name to match signature
        $this->user->logoutUser(); // Corrected method call
        $isDeleted = (session_status() == PHP_SESSION_NONE && empty(session_id()));
        $this->assertTrue($isDeleted);
    }
}