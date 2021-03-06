<?php
namespace Drupal\my_module\Controller;

class MyNewsLatestController {
    public function latest_news() {
        $myEntytyStorage = \Drupal::entityTypeManager()->getStorage('node');
        $data = $myEntytyStorage->getQuery()
            ->condition('status', 1)
            ->condition('type', 'news')
            ->sort('created', 'DESC')
            ->range(0,1)
            ->execute();
        $entity_type = 'node';
        $view_mode = 'teaser';
        $builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
        $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
        $node = $storage->load(reset($data));
        $build = $builder->view($node, $view_mode);
        return $build;
    }
}
?>
