<?php

namespace ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Adicionamos o método '->add('author') no Form
        $builder->add('title')->add('content')/*->add('createdAt')->add('updateAt')*/->add('author')
                                                //removemos também estes métodos, pois será feito automaticamente
                                                //de acordo com o contrutor definido em Timestampable
        ->add('file');
        //Nossa entidade e controller de posts, estão configurados para receberem o upload, porém temos que
        //configurar nossos formulários. Para isso, devemos adicionar o 'file' no código { ->add('file') }
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModelBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_post';
    }


}
