<?php

namespace unipro\PageBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class PageAdminController extends Controller
{
    /**
     * @Route("/edit")
     */
    public function listAction()
    {
        $subPagesContent = $this->getDoctrine()->getRepository('PageBundle:PagesContent')->findAll();

        return $this->render('admin/edit.html.twig', [
            'subPages' => $subPagesContent
        ]);
    }

    /**
     * @Route("/edit/{entity}/{id}", name="unipro-admin-edit")
     */
    public function editAction()
    {
        //todo form here
    }
}
