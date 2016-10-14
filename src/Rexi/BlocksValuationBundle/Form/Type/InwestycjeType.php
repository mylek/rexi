<?php

namespace Rexi\BlocksValuationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;


class InwestycjeType extends AbstractType{
    
    public function getName() {
        return 'inwestycjeWyceny';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->
                add('kod_pocztowy', 'text', array(
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
                    'style' => 'width: 365px; display: inline-block;'
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
            ->add('nr_dzialki', 'text', array(
                'label' => 'Numer działki',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
            ))
            ->add('submit', 'submit', array(
                'attr' => array(
                    'class' => 'dim btn-danger btn'
                ),
                'label' => '<i class="fa fa-save"></i>&nbsp;&nbsp; Zapisz dane inwestycji'
            ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Rexi\BlocksValuationBundle\Entity\Inwestycje'
        ));
    }
    
}