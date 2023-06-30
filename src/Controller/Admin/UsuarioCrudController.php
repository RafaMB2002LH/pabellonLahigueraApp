<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_NEW == $pageName || Crud::PAGE_EDIT == $pageName) {
            return [
                TextField::new('nombre'),
                TextField::new('apellidos'),
                TextField::new('dni'),
                NumberField::new('edad'),
                ChoiceField::new('sexo')
                    ->setChoices([
                        'Hombre' => 'Masc',
                        'Mujer' => 'Fem'
                    ]),
                ChoiceField::new('roles')
                    ->setChoices([
                        'Admin' => 'ROLE_ADMIN',
                        'Cliente' => 'ROLE_CLIENTE'
                    ])->allowMultipleChoices()->autocomplete(),
                EmailField::new('email'),
                TextField::new('password'),
            ];
        }
        return [
            IdField::new('id'),
            TextField::new('nombre'),
            TextField::new('apellidos'),
            TextField::new('dni'),
            NumberField::new('edad'),
            TextField::new('sexo'),
            CollectionField::new('roles')
                ->setEntryType(TextField::class),
            EmailField::new('email'),
            TextField::new('password'),
        ];
    }
}
