<?php

namespace Drupal\beetroot_example\Controllers;

class Example {

  public function view() {
    return new JsonResponse(['hello' => 'world']);
  }

}