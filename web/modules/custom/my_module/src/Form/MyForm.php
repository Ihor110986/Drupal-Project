<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * HelloForm controller.
 */
class MyForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'my_module_my_form';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('Please enter the title and accept the terms of use of the site.'),
    ];

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Enter the title of the news. Note that the title must be at least 10 characters in length.'),
      '#required' => TRUE,
    ];

    $form['text'] = [
      '#type' => 'text_format',
      '#format' => 'Full_html',
      '#title' => $this->t('Text'),
      '#description' => $this->t('Enter the text of the news. Note that the text must be at least 10 characters in length.'),
      '#required' => TRUE,
    ];

    $form['Category'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'taxonomy_term',
      '#title' => $this->t('Category reference field'),
      '#description' => $this->t('The description of the field.'),
      '#default_value' => '',
      '#tags' => TRUE,
      '#selection_settings' => [
        'target_bundles' => ['Category'],
      ],
      '#weight' => '0',
    ];

    $form['accept'] = [
      '#type' => 'checkbox',
      '#title' => $this
        ->t('I accept the terms of use of the site'),
      '#description' => $this->t('Please read and accept the terms of use'),
    ];

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;

  }

  /**
   * Validate the title and the checkbox of the form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $title = $form_state->getValue('title');
    $text = $form_state->getValue('text');
    $accept = $form_state->getValue('accept');

    if (strlen($title) < 10) {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('title', $this->t('The title must be at least 10 characters long.'));
    }

    // if (strlen($text) < 10) {
    //   // Set an error for the form element with a key of "text".
    //   $form_state->setErrorByName('text', $this->t('The text must be at least 10 characters long.'));
    // }

    if (empty($accept)) {
      // Set an error for the form element with a key of "accept".
      $form_state->setErrorByName('accept', $this->t('You must accept the terms of use to continue'));
    }

  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $news = \Drupal::entityTypeManager()->getStorage('node')->create(['type' => 'news',
        'title' => $form_state->getValue('title'),
        'field_news_text' => $form_state->getValue('text'),
        'uid' => \Drupal::currentUser()->id(),
        'status' => 0,
        ]);
        $news->save();

        $message = \Drupal::messenger();
        $message->addMessage('News with id ' . $news->id() . ' was created and now waiting for publishing');

        $form_state->setRedirect('<front>');
    }
  }

