<?php

namespace unipro\PageBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use unipro\PageBundle\Entity\PagesContent;
use unipro\PageBundle\Form\SubPagesForm;

/**
 * @Route("/admin")
 */
class PageAdminController extends Controller
{
    /**
     * @Route("/", name="unipro-admin-index")
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/edit/{repository}", name="unipro-admin-list")
     * @param $repository string
     * @return twig
     */
    public function listAction($repository)
    {
        $repository = 'PageBundle:'.$repository;
        $subPagesContent = $this->getDoctrine()->getRepository($repository)->findAll();

        return $this->render('admin/edit.html.twig', [
            'subPages' => $subPagesContent
        ]);
    }

    /**
     * @Route("/edit/subpage/{id}", name="unipro-admin-edit")
     * @param $request Request
     * @param $content PagesContent
     * @return twig
     */
    public function subPageEditAction(Request $request, PagesContent $content)
    {
        $form = $this->createForm(SubPagesForm::class, $content);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $content->setPostedAt(new \DateTime('NOW'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();
            $this->addFlash('success', 'Zaktualizowano rekord w bazie danych!');

            return $this->redirectToRoute('unipro-admin-list', [
                'repository' => 'PagesContent'
            ]);
        }

        return $this->render('admin/edit_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/subpage/new", name="unipro-admin-new")
     * @param $request Request
     * @return twig
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(SubPagesForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $content = $form->getData();
            $content->setPostedAt(new \DateTime('NOW'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();
            $this->addFlash('success', 'Dodano podstronę!');

            return $this->redirectToRoute('unipro-admin-list', [
                'repository' => 'PagesContent'
            ]);
        }

        return $this->render('admin/edit_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
