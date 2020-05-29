<?php

namespace App\Form;

use App\Entity\Marques;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('Marque', EntityType::class,[
                'choice_label' => 'Nom',
                'class' => Marques::class
            ])
            ->add('imagePath', FileType::class, [
                'label' => 'Image du produit',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '100000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Veuillez entrer un format d\'image en .jpg/.jpeg ou .png'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
