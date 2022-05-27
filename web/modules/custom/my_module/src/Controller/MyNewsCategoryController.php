<?php
//
//namespace Drupal\my_module\Controller;
//
//class MyNewsCategoryController {
//
//
//    public function get_category($category_id) {
//
//        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');
//
//        $news_id = $nodeStorage->getQuery()
//        ->condition('status', 1)
//        ->condition('type', 'news')
//        ->condition('field_category.entity:taxonomy_term.tid', $category_id)
//        ->execute();
//
//        $entity_type = 'node';
//        $view_mode = 'teaser';
//        $builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
//        $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
//        $node = $storage->loadMultiple($news_id);
//        $build = $builder->viewMultiple($node, $view_mode);
//        return $build;
//
//      }
//    }
