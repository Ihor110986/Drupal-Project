<?php

namespace Drupal\my_module\Controller;

class MyNewsConfigController {

    public function order_news() {
        $config = \Drupal::config('my_module_news_order.settings');
        $order = $config->get('news_order');

        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');

        $news_id = $nodeStorage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'news')
        ->sort($order, 'DESC')
        ->execute();

        $entity_type = 'node';
        $view_mode = 'full';
        $builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
        $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
        $node = $storage->loadMultiple($news_id);
        $build = $builder->viewMultiple($node, $view_mode);
        return $build;
      }

}
