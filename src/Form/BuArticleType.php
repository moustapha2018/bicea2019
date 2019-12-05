<?php

namespace App\Form;

use App\Entity\BuArticle;
use App\Entity\BuCategory;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idAdmin = $options['idAdmin'];
        $builder
            ->add('articleName')
            ->add('unitPrice')
            //->add('createdAt')
            ->add('description')
            ->add('comment')
            ->add('articleQuantity', TextType::class)
            ->add('unit', ChoiceType::class,[
                'choices'=>[
                    'KG' => 'KG',
                    'L' => 'L',
                    'U' => 'U'
                ]
            ])
            //->add('BiceaAdmin')
            ->add('BuCategory', EntityType::class,[
                'class' => BuCategory::class,
                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.categoryName', 'ASC');
                },
                'choice_label' => 'categoryName',
            ])
            ->add('image', FileType::class, array(
                'data_class' => null,
                'label' => 'Image'))
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BuArticle::class,
            'idAdmin' => 1
        ]);
    }
}
