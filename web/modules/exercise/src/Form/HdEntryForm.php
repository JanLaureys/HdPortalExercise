<?php

namespace Drupal\exercise\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the entry entity edit forms.
 */
class HdEntryForm extends ContentEntityForm {

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
        $this->messenger()->addStatus($this->t('New entry %label has been created.', $message_arguments));
        $this->logger('exercise')->notice('Created new entry %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The entry %label has been updated.', $message_arguments));
        $this->logger('exercise')->notice('Updated entry %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.hd_entry.canonical', ['hd_entry' => $entity->id()]);

    return $result;
  }

}
