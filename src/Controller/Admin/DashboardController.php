<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Note;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'user')]
    public function index(): Response
    {
        // return parent::index();

        

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('NoteXpress');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::section('Mon carnet');
        yield MenuItem::linkToCrud('Mes notes', 'fas fa-note-sticky', Note::class);
        yield MenuItem::linkToCrud('Mes notes', 'fas fa-clipboard-list', Category::class);
        yield MenuItem::section('Profil');
        yield MenuItem::linkToCrud('Mon profil', 'fas fa-user', User::class);
    }
}
