<?php
namespace Drupal\my_module\Controller;
class MyController {
    public function my() {
        return array(
            '#markup' => 'Welcome to our Website.'
        );
    }
}