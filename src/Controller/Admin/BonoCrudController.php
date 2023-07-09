<?php

namespace App\Controller\Admin;

use App\Entity\Bono;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Component\HttpFoundation\RequestStack;

class BonoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bono::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_NEW == $pageName || Crud::PAGE_EDIT == $pageName) {
            return [
                AssociationField::new('Usuario'),
                ChoiceField::new('tipo')->setChoices([
                    'Bono simple' => 'simple',
                    'Bono doble' => 'doble'
                ]),
                MoneyField::new('precio')->setCurrency('EUR'),
                NumberField::new('diasTotales'),
            ];
        }
        return [
            IdField::new('id'),
            AssociationField::new('Usuario'),
            TextField::new('tipo'),
            MoneyField::new('precio')->setCurrency('EUR'),
            NumberField::new('diasTotales'),
            DateTimeField::new('fechaCreacion'),
        ];
    }

}
