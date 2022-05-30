<?php

namespace Drupal\my_module\Controller;

class MyNewsConfigController {

    public function filter_news() {
        $config = \Drupal::config('my_module_news_filter.settings');
        $filter = $config->get('news_filter');

        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');

        $news_id = $nodeStorage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'news')
        ->sort($filter, 'DESC')
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
