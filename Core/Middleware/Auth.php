<?php

class Auth {
    public function handler() {
        if (! $_SESSION['user'] ?? false){
            header("Location: /login");
            exit();
        }
    }
}