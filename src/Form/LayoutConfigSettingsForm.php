<?php

namespace Drupal\layout_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\block\Controller\BlockLibraryController;

/**
* Configure example settings for this site.
*/
class LayoutConfigSettingsForm extends ConfigFormBase {

  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    return 'example_admin_settings';
  }

  /**
  * {@inheritdoc}
  */
  protected function getEditableConfigNames() {
    return [
      'block.block.searchform_2',
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('block.block.searchform_2');

    $form['region'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Region'),
      '#default_value' => $config->get('region'),
    );

    $form['visibility'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Visibility'),
      //'#default_value' => $config->get('visibility'),
    );

    $form['visibility']['pages'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Path'),
      '#default_value' => array_column($config->get('visibility'), 'pages'),
    );
    var_dump(array_column($config->get('visibility'), 'pages'));

    return parent::buildForm($form, $form_state);
  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration
    $this->config('block.block.searchform_2')
    // Set the submitted configuration setting
    ->set('region', $form_state->getValue('region'))
    ->set('request_path', $form_state->getValue('request_path'))
    ->save();

    parent::submitForm($form, $form_state);
  }

}

/*

a:12:{
  s:4:"uuid";s:36:"6f5441e3-93b5-47d1-9792-c1f9816b8a53";
  s:8:"langcode";s:2:"en";
  s:6:"status";b:1;
  s:12:"dependencies";a:2:{s:6:"module";a:2:{i:0;s:6:"search";i:1;s:6:"system";}
  s:5:"theme";a:1:{i:0;s:14:"fiddlers_green";}}
  s:2:"id";
  s:12:"searchform_2";
  s:5:"theme";s:14:"fiddlers_green";
  s:6:"region";s:13:"sidebar_first";
  s:6:"weight";i:0;
  s:8:"provider";N;
  s:6:"plugin";s:17:"search_form_block";
  s:8:"settings";a:4:{s:2:"id";s:17:"search_form_block";s:5:"label";s:11:"Search form";s:8:"provider";s:6:"search";s:13:"label_display";s:7:"visible";}
  s:10:"visibility";
    a:1:{s:12:"request_path";
      a:4:{s:2:"id";s:12:"request_path";s:5:"pages";s:7:"/owen/*";s:6:"negate";b:0;s:15:"context_mapping";
        a:0:{}
      }
    }
}

*/