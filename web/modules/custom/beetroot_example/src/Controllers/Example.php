<?php

namespace Drupal\beetroot_example\Controllers;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class Example extends ControllerBase {

  public function view(NodeInterface $node) {
    $em = $this->entityTypeManager();

    $storage = $em->getStorage( 'node');

    $query = $storage->getQuery()
      ->condition('status', 1)
      ->condition('type', 'article')
//      ->condition('field_tags.entity.field_show_on_home', TRUE)
      ->range(0, 1)
      ->sort('changed', 'DESC');
    $ids = $query->execute();
    /** @var \Drupal\node\NodeInterface $node */
    $node = $storage->load(reset($ids));

    return new JsonResponse($node->toArray());
  }
}

