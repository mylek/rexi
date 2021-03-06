<?php

namespace Rexi\BlocksValuationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;


class UserInfoType extends AbstractType{
    
    public function getName() {
        return 'userInfoWyceny';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('imie', 'text', array(
                'label' => 'Imię',
                'required'    => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
              ->add('imie_drugie', 'text', array(
                'label' => 'Drugie imie',
                'required'    => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('nazwisko', 'text', array(
                'label' => 'Nazwisko',
                'required'    => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            // z dowodu 
            ->add('imie_ojca', 'text', array(
                'label' => 'Imie ojca',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('imie_matki', 'text', array(
                'label' => 'Imie matki',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('data_urodzenia', 'date', array(
                'label' => 'Data urodzenia',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array(
                    'class' => 'datepicker'
                ),
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Date()
                ),
              ))
            ->add('plec', 'choice', array(
                    'label' => 'Płeć',
                    'choices' => array(
                        '0' => 'mężczyzna',
                        '1' => 'kobieta',
                    ),
                    'constraints' => array(
                        new Assert\NotBlank()
                    ),
                    'expanded' => true
                    )
                )
            ->add('kod_pocztowy', 'text', array(
                'attr' => array(
                    'style' => 'width: 90px; display: inline-block; text-align: center;',
                    'data-mask' => '99-999',
                    'data-mask-placeholder' => '_'
                ),
                'label' => 'Kod pocztowy',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 6,
                        )
                    )
                ),
              ))
            ->add('miasto', 'text', array(
                'attr' => array(
                    'style' => 'width: 370px; display: inline-block;'
                ),
                'label' => 'Miasto',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('miejscowosc', 'text', array(
                'label' => 'Miejscowość',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('ulica', 'text', array(
                'attr' => array(
                    'style' => 'width: 350px; display: inline-block;'
                ),
                'label' => 'Ulica',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 128,
                        )
                    )
                ),
              ))
                ->add('nr_domu', 'text', array(
                'attr' => array(
                    'style' => 'width: 50px; display: inline-block;'
                ),
                'label' => 'Numer domu',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
              ))
            ->add('nr_lokalu', 'text', array(
                'attr' => array(
                    'style' => 'width: 50px; display: inline-block;'
                ),
                'label' => 'Numer lokalu',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
            ))
                
            // START zameldowanie 
            ->add('kod_pocztowy_zamieszkania', 'text', array(
                'attr' => array(
                    'style' => 'width: 90px; display: inline-block; text-align: center;',
                    'data-mask' => '99-999',
                    'data-mask-placeholder' => '_',
                    'class' => 'jq_kod_pocztowy'
                ),
                'label' => 'Kod pocztowy',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 6,
                        )
                    )
                ),
              ))
            ->add('miasto_zamieszkania', 'text', array(
                'attr' => array(
                    'style' => 'width: 370px; display: inline-block;',
                    'class' => 'jq_miasto'
                ),
                'label' => 'Miasto',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('miejscowosc_zamieszkania', 'text', array(
                'attr' => array(
                    'class' => 'jq_miejscowosc'
                ),
                'label' => 'Miejscowość',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('ulica_zamieszkania', 'text', array(
                'attr' => array(
                    'style' => 'width: 350px; display: inline-block;',
                    'class' => 'jq_ulica'
                ),
                'label' => 'Ulica',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 128,
                        )
                    )
                ),
              ))
                ->add('nr_domu_zamieszkania', 'text', array(
                'attr' => array(
                    'style' => 'width: 50px; display: inline-block;',
                    'class' => 'jq_nr_domu'
                ),
                'label' => 'Numer domu',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
              ))
            ->add('nr_lokalu_zamieszkania', 'text', array(
                'attr' => array(
                    'style' => 'width: 50px; display: inline-block;',
                    'class' => 'jq_nr_lokalu'
                ),
                'label' => 'Numer lokalu',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
            ))
                
            // START korespondencji 
            ->add('kod_pocztowy_korespondencji', 'text', array(
                'attr' => array(
                    'style' => 'width: 90px; display: inline-block; text-align: center;',
                    'data-mask' => '99-999',
                    'data-mask-placeholder' => '_',
                    'class' => 'jq_kod_pocztowy'
                ),
                'label' => 'Kod pocztowy',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 6,
                        )
                    )
                ),
              ))
            ->add('miasto_korespondencji', 'text', array(
                'attr' => array(
                    'style' => 'width: 370px; display: inline-block;',
                    'class' => 'jq_miasto'
                ),
                'label' => 'Miasto',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
             ->add('miejscowosc_korespondencji', 'text', array(
                'attr' => array(
                    'class' => 'jq_miejscowosc'
                ),
                'label' => 'Miejscowość',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('ulica_korespondencji', 'text', array(
                'attr' => array(
                    'style' => 'width: 350px; display: inline-block;',
                    'class' => 'jq_ulica'
                ),
                'label' => 'Ulica',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 128,
                        )
                    )
                ),
              ))
                ->add('nr_domu_korespondencji', 'text', array(
                'attr' => array(
                    'style' => 'width: 50px; display: inline-block;',
                    'class' => 'jq_nr_domu'
                ),
                'label' => 'Numer domu',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
              ))
            ->add('nr_lokalu_korespondencji', 'text', array(
                'attr' => array(
                    'style' => 'width: 50px; display: inline-block;',
                    'class' => 'jq_nr_lokalu'
                ),
                'label' => 'Numer lokalu',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
            ))
            // STOP zameldowanie 
                
            ->add('miejsce_urodzenia', 'text', array(
                'label' => 'Miejsce urodzenia',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
                
            ->add('data_wydania_dowodu', 'date', array(
                'label' => 'Data wydania dowodu osobistego',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array(
                    'class' => 'datepicker'
                ),
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Date()
                ),
              ))
            ->add('data_waznosci_dowodu', 'date', array(
                'label' => 'Data ważnosci dowodu osobistego',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array(
                    'class' => 'datepicker'
                ),
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Date()
                ),
              ))
            ->add('organizacja_wydajaca_dowodu', 'text', array(
                'label' => 'Organizacja wydająca dowód osobity',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('pesel', 'text', array(
                'label' => 'PESEL',
                'attr' => array(
                    'data-mask' => '99999999999',
                    'data-mask-placeholder' => '_'
                ),
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 16,
                        )
                    )
                ),
              ))
            ->add('nr_dowodu', 'text', array(
                'attr' => array(
                    'data-mask' => 'aaa999999',
                    'data-mask-placeholder' => '_'
                ),
                'label' => 'Numer dowodu',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 16,
                        )
                    )
                ),
              ))
            ->add('submit', 'submit', array(
                'attr' => array(
                    'class' => 'dim btn-danger btn'
                ),
                'label' => '<i class="fa fa-save"></i>&nbsp;&nbsp; Zapisz dane'
            ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Rexi\UserBundle\Entity\UserInfo'
        ));
    }
    
}