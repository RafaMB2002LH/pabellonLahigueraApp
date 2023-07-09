<?php

namespace App\Controller\Admin;

use App\Entity\DiaTachado;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class DiaTachadoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DiaTachado::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_NEW == $pageName || Crud::PAGE_EDIT == $pageName) {
            return [
                AssociationField::new('Bono'),
            ];
        }
        return [
            IdField::new('id'),
            AssociationField::new('Bono'),
            DateTimeField::new('Fecha'),
        ];
    }
}
