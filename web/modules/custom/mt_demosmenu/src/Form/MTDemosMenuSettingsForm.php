<?php

namespace Drupal\mt_demosmenu\Form;

use Drupal;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MTDemosMenuSettingsForm.
 *
 * @package Drupal\mt_demosmenu\Form
 *
 * @ingroup mt_demosmenu
 */
class MTDemosMenuSettingsForm extends ConfigFormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'MTDemosMenu_settings';
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

    $config = $this->config('mt_demosmenu.settings');
    $date = $config->get('expiration_date');
    $date_time = date("Y-m-d H:i:s", strtotime($date));

    $form['links'] = [
      '#title' => $this->t('Menu items'),
      '#type' => 'textarea',
      '#required' => FALSE,
      '#default_value' => $config->get('links'),
      '#placeholder' => $this->t('One per line in the form Label | Target'),
    ];


    $form['inject_in_the_body'] = [
      '#prefix' => $this->t('Inject in the body'),
      '#type' => 'checkbox',
      '#required' => FALSE,
      '#default_value' => $config->get('inject_in_the_body'),
      '#suffix' => $this->t('Inject the menu component in the body element (page_top) of the front page'),
    ];

    return parent::buildForm($form, $form_state);
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
    $this->config('mt_demosmenu.settings')
      ->set('links', $form_state->getValue('links'))
      ->set('inject_in_the_body', $form_state->getValue('inject_in_the_body'))
      ->save();

    // Clear routing and links cache.
    Drupal::service("router.builder")->rebuild();

    parent::submitForm($form, $form_state);

  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return [
      'mt_demosmenu.settings',
    ];
  }
}
