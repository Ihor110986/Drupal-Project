<?php
namespace Drupal\my_module\Controller;

class MyNewsController {
    public function latest_news() {
        $myEntytyStorage = \Drupal::entityTypeManager()->getStorage('node');
        $data = $myEntytyStorage->getQuery()
            ->condition('status', 1)
            ->condition('type', 'News')
            ->sort('created', 'DESC')
            ->range(0,1)
            ->execute();
        $entity_type = 'News';
        $view_mode = 'Full content';
        $creator = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
        $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
        $news = $storage->load(reset($data));
        $create = $creator->view($news, $view_mode);
        return $create;
    }
}
?>