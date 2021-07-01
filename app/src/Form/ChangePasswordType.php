<?php

/**
 * Change password form type.
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordType extends AbstractType
{
    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => ['label' => 'label_new_password'],
            'second_options' => ['label' => 'label_repeat_password'],
            'constraints' => [
                new NotBlank(),
                new Length([
                    'min' => 6,
                    'max' => 15,
                ]),
            ],
        ]);
    }
}
