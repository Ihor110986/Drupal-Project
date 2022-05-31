<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class NewsController extends ControllerBase {
  public function view() {
    $nodes = Node::loadMultiple();
    $output = [];
    foreach ($nodes as $node) {
      $output[] = [
        '#theme' => 'my_example_news',
        '#title' => $node->label(),
        '#content' => $node->get('body')->view(['label' => 'hidden']),
        '#category' => $node->get('category')->target_id,
      ];
    }
    return $output;
  }
}
