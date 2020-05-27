<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('slug')
            ->add('Titre')
            ->add('Description')
            ->add('PriceTTC')
            ->add('Poids')
            //->add('Couleur')
            ->add('Couleur', ChoiceType::class, [
                    'choices' => ['Blanc' => 1,'Noir' => 2,'Jaune' => 3,'Rouge' => 4]
            ])
            ->add('DateCreated')
            ->add('StockQte')
            ->add('Actif')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
