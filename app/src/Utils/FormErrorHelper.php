<?php

namespace App\Utils;

use Symfony\Component\Form\FormInterface;

class FormErrorHelper
{
    /**
     * Extracts error messages from a form.
     *
     * @param FormInterface $form
     * @return array
     */
    public static function getFormErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[] = $error->getMessage();
        }
        return $errors;
    }
}
