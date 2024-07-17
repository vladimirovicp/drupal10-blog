<?php

namespace Drupal\blog_core\Plugin\Paragraphs\Behavior;

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\paragraphs\Annotation\ParagraphsBehavior;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphsBehaviorBase;


use Drupal\Core\Form\FormStateInterface;

/**
 * Class ParagraphGalleryBehavior.
 *
 * @ParagraphsBehavior(
 *   id = "paragraph_gallery",
 *   label = @Translation("Gallery Settings"),
 *   description = @Translation("Gallery Description"),
 *   weight = 10,
 * )
 */
class ParagraphGalleryBehavior extends ParagraphsBehaviorBase
{

    /**
     * {@inheritdoc}
     */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state)
    {
        $form['custom_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Custom Text'),
            '#description' => $this->t('Enter some custom text to display.'),
            '#default_value' => $this->configuration['custom_text'] ?? '',
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state)
    {
        $this->configuration['custom_text'] = $form_state->getValue('custom_text');
    }

    /**
     * {@inheritdoc}
     */
    public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
    {
        if (!empty($this->configuration['custom_text'])) {
            $build['custom_text'] = [
                '#markup' => $this->configuration['custom_text'],
            ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isApplicable(ParagraphsType $paragraphs_type)
    {
        //return $paragraphs_type->id() == 'gallery';
        return TRUE; // Allow any paragraph type to be used.
    }

}