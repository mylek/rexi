<?php

namespace Rexi\BlocksValuationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;


class BlockType extends AbstractType{
    
    public function getName() {
        return 'addBlok';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nazwa', 'text', array(
                'label' => 'Nazwa bloku',
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 128
                        )
                    )
                    ),
                ))
                ->add('kolor', 'text', array(
                'label' => 'Wybierz kolor',
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'max' => 8
                        )
                    )
                    )
                ))
                
                ->add('id_rodzica', 'entity', array(
                    'label' => 'Wybierz rodzica',
                    'choice_label' => 'nazwa',
                    'empty_value' => "Element głowny",
                    'class' => 'RexiBlocksValuationBundle:BlockiWycen',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('b')
                            ->orderBy('b.nazwa', 'ASC');
                    },
                ))
                            
                ->add('typ', 'choice', array(
                    'label' => 'Typ bloku',
                    'choices' => array(
                        '0' => 'Przycisk',
                        '1' => 'Koszt',
                    ),
                    'expanded' => true,
                ))
                ->add('submit', 'submit', array(
                    'label' => 'Dodaj blok'
                ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Rexi\BlocksValuationBundle\Entity\BlockiWycen'
        ));
    }
    
}