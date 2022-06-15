<?php

namespace Drupal\custom_content_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the custom content entity entity edit forms.
 */
class CustomContentEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New custom content entity %label has been created.', $message_arguments));
        $this->logger('custom_content_entity')->notice('Created new custom content entity %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The custom content entity %label has been updated.', $message_arguments));
        $this->logger('custom_content_entity')->notice('Updated custom content entity %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.custom_content_entity.canonical', ['custom_content_entity' => $entity->id()]);

    return $result;
  }

}
