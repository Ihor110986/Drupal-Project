<?php
namespace Drupal\my_module\Controller;
class MyController {
    public function my() {
        return array(
            '#markup' => 'Welcome to our Website.'
        );
    }

    public function latest_news() {
        $myEntytyStorage = \Drupal::entityTypeManager()->getStorage('News');
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
