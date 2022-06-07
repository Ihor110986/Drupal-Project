<?php

namespace Drupal\beetroot_example\Controllers;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class Example extends ControllerBase {

  public function view() {
    $en = $this->entityTypeManager();
    $storage = $en->getStorage('node');
    $query = $storage->getQuery()
      ->condition('status', 1)
      ->condition('type', 'article')
      ->condition('field_tags.entity.field_show_on_home', True)
      ->range(0,1)
      ->sort('created', 'DESC');
    $ids = $query->execute();
    /**@var \Drupal\node\NodeInterface $node */
    $node = $storage->load(reset($ids));

    if ($node->hasField('field_flag')) {
      $body = $node->get('body')->value;

    }
    return new JsonResponse(['hello' => 'world']);
  }

}

