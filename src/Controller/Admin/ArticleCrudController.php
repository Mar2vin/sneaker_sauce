<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            TextField::new('designation'),
            TextEditorField::new('content'),
            ImageField::new('image')->setUploadDir("/public/assets/img")
                ->setBasePath("/assets/img")
                ->setRequired(false),
            AssociationField::new('author'),
            AssociationField::new('category'),
            DateField::new('createdAt')->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdAt' => 'DESC']);
    }
}
