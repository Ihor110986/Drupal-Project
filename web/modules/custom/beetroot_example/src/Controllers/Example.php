<?php

namespace Drupal\beetroot_example\Controllers;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class Example extends ControllerBase {

  public function view() {
    $em = $this->entityTypeManager();


    $storage = $em->getStorage('node');

    $node = $storage->create([
      'type' => 'article',
      'title' => 'Test node',
      'body' => [
        'value' => 'some text',
        'format' => 'basic_html',
      ],
      'status' => 1,
    ]);
    $result = $node->save();

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
    return new JsonResponse(['hello' => 'world!']);
  }

}

