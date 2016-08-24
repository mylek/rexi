<?php
namespace Rexi\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Rexi\UserBundle\Form\Type\UserInfoType;
use Doctrine\ORM\EntityRepository;

class RegisterUserType extends AbstractType{
    
    public function getName() {
        return 'userRegister';
    }    
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('email', 'email', array(
                'label' => 'E-mail'
            ))
            ->add('username', 'text', array(
                'label' => 'Login',
                'required'    => false,
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array(
                    'label' => 'Hasło'
                ),
                'second_options' => array(
                    'label' => 'Powtórz hasło'
                )
            ))
            ->add('typ', 'choice', array(
                    'label' => 'Typ użytkownika',
                    'choices' => array(
                        '0' => 'Pracownik',
                        '1' => 'Klient',
                    ),
                    'data' => 0,
                    'expanded' => true,
                ))
            ->add('imie', 'text', array(
                'label' => 'Imię',
                'required'    => false,
              ))
            ->add('nazwisko', 'text', array(
                'label' => 'Nazwisko',
                'required'    => false,
              ))
            ->add('pesel', 'text', array(
                'label' => 'PESEL',
                'required'    => false,
              ))
            ->add('submit', 'submit', array(
                'label' => 'Zapisz'
            ));
    }
    
   /* public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Common\UserBundle\Entity\User',
            'validation_groups' => array('Default', 'Registration')
        ));
    }*/
}
