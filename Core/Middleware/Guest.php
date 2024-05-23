<?php

class Guest {
    public function handler() {
        if ($_SESSION['user'] ?? false){
            header("Location: /");
            exit();
        }
    }
}