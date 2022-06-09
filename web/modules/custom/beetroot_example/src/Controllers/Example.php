<?php

namespace Drupal\beetroot_example\Controllers;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;


class Example extends ControllerBase {

  public function view(NodeInterface $node) {
    return $this->entityTypeManager()
      ->getViewBuilder($node->getEntityTypeId())
      ->viewField($node->get('body'),'teaser');
  }
}

