<?php

namespace unipro\PageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    /**
     * @Route("/", name="unipro-homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/{subPage}", name="unipro-subpage")
     * @param $subPage string
     * @return twig
     */
    public function aboutAction($subPage = null)
    {
        $content = null;
        if ($subPage) {
            $content = $this->getDoctrine()->getRepository('PageBundle:PagesContent')->findOneBy(['route' => '/'.$subPage]);
        }

        if (!$content) {
            throw $this->createNotFoundException('Nie znaleziono takiej podstrony!');
        }

        return $this->render('default/subpage.html.twig', [
            'content' => $content
        ]);
    }
}
