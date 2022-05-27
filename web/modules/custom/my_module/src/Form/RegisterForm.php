<?php
//
///**
// * @file
// * Contains \Drupal\my_module\Form\RegisterForm.
// */
//
//namespace Drupal\my_module\Form;
//
//use Drupal\Core\Form\FormBase;
//use Drupal\Core\Form\FormStateInterface;
//
//class RegisterForm extends FormBase {
//  /**
//   * {@inheritdoc}
//   */
//  public function getFormId() {
//    return 'register_form';
//  }
//
//  /**
//   * {@inheritdoc}
//   */
//  public function buildForm(array $form, FormStateInterface $form_state) {
//
//    $form['your_name'] = array(
//      '#type' => 'textfield',
//      '#title' => t('Your name:'),
//      '#required' => TRUE,
//    );
//
//    $form['your_email'] = array(
//      '#type' => 'email',
//      '#title' => t('Your email:'),
//      '#required' => TRUE,
//    );
//
//    $form['actions']['#type'] = 'actions';
//    $form['actions']['submit'] = array(
//      '#type' => 'submit',
//      '#value' => $this->t('Register'),
//      '#button_type' => 'primary',
//    );
//    return $form;
//  }
//
//  /**
//   * {@inheritdoc}
//   */
//  public function submitForm(array &$form, FormStateInterface $form_state) {
//
//    \Drupal::messenger()->addMessage($this->t('Thank you @you_name, you are registered!', array('@you_name' => $form_state->getValue('your_name'))));
//
//  }
//}
