<?php

namespace Drupal\comment_news\Controller;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class CommentNewsController extends FormBase {

  /** * {@inheritdoc} */
  public function getFormId() {
    return 'block_form_example_form';
  }

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

  /** * {@inheritdoc} */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => t('First name:'),
      '#required' => TRUE,
    ];

    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => t('Last name:'),
      '#required' => TRUE,
    ];

    $form['user_mail'] = [
      '#type' => 'email',
      '#title' => t('Email:'),
      '#required' => TRUE,
    ];

    $form['message'] = [
      '#type' => 'textfield',
      '#title' => t('Message to printing:'),
      //'#format' => 'Full_html',
      '#required' => TRUE,
    ];

    $form['count'] = [
      '#type' => 'number',
      '#main' => 1,
      '#title' => t('How many times display a message:'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send message'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $first_name = $form_state->getValue('first_name');
    $last_name = $form_state->getValue('last_name');
    $count = $form_state->getValue('count');
    $message = $form_state->getValue('message');

    if (strlen($first_name) < 4) {
      // Set an error for the form element with a key of "first_name".
      $form_state->setErrorByName('first_name', $this->t('The  first name must be at least 4 characters long.'));
    }

    if (strlen($last_name) < 4) {
      // Set an error for the form element with a key of "last_name".
      $form_state->setErrorByName('last_name', $this->t('The  last name must be at least 4 characters long.'));
    }

    if (strlen($message) < 5) {
      // Set an error for the form element with a key of "message".
      $form_state->setErrorByName('message', t('Message must contain more than 5 letters'));

      if (!is_numeric($count) || $count < 1) {
        // Set an error for the form element with a key of "count".
        $form_state->setErrorByName('count', t('Needs to be an integer and more or equal 1.'));
      }

    }
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //
    $message = $form_state->getValue('message');
    $count = $form_state->getValue('count');
    $text = '';
    for ($i = 1; $i <= $count; $i++) {
      $text .= $i . "." . $message . "\n";
    }

    $node = Node::create([
      'type' => 'article',
      'title' => $form_state->getValue('message'),
      'body' => $text,
    ]);
    $node->save();
    $form_state->setRedirect('entity.node.canonical', ['node' => $node->id()]);
    \Drupal::messenger()->addStatus('Node added');
    \Drupal::messenger()
      ->addMessage($this->t('@first_name @last_name,your message displayed @count times!',
        [
          '@first_name' => $form_state->getValue('first_name'),
          '@last_name' => $form_state->getValue('last_name'),
          '@count' => $form_state->getValue('count')
        ]));
  }

}