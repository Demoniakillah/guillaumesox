<?php

namespace SoxleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller {

    const HOME = 'home';

    /**
     *
     * @var array 
     */
    protected $viewParameters = array();

    /**
     *
     * @Route("/{uri}", name="home")
     */
    public function homeAction($uri = SELF::HOME) {
        $this->hydrateViewNavbar();
        $this->hydrateContent($uri);
        $this->addViewParameter('uri', $uri);
        return $this->render('SoxleBundle:Home:home.html.twig', $this->getViewParameters());
    }

    protected function hydrateContent($uri) {
        $html = '';
        $uriEntity = $this->getDoctrine()->getManager()->getRepository('SoxleBundle:Uri')->findOneByValue($uri);
        $content = $this->getDoctrine()->getManager()->getRepository('SoxleBundle:ContenuPage')->findOneBy(array('uri' => $uriEntity));
        if ($content instanceof \SoxleBundle\Entity\ContenuPage) {
            $html = $content->getHtml();
        }
        $this->addViewParameter('content', $html);
    }

    protected function hydrateViewNavbar() {
        $menu = '';
        /* @var $navBarParent \SoxleBundle\Entity\NavBarMenu[] */
        $navBarParent = $this->getDoctrine()->getManager()->getRepository('SoxleBundle:NavBarMenu')->findBy(array('menuPrincipal' => true), array('position' => 'ASC'));
        foreach ($navBarParent as $navBar) {
            $menu .= $this->generateNavbarHtml($navBar);
        }

        $this->addViewParameter('navbar', $menu);
    }

    protected function generateNavbarHtml(\SoxleBundle\Entity\NavBarMenu $navbar) {
        $url = $this->generateUrl('home', array(), 0);
        if ($navbar->hasEnfants()) {
            $attributes = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >' . $navbar . '<span class="caret"></span></a>';
        } else {
            $attributes = 'class="dropdown" >' . $navbar . '</a>';
        }
        $html = '<li class="dropdown">
                            <a href="' . $url . $navbar->getLien() . '" ' . $attributes . '
                            <ul class="dropdown-menu dropdowncostume">';
        if ($navbar->hasEnfants()) {
            foreach ($navbar->getEnfants() as $sousMenu) {
                $html .= '<li><a href="' . $url . $sousMenu->getLien() . '">' . $sousMenu . '</a></li>';
            }
        }
        $html .= '</ul></li>';
        return $html;
    }

    protected function addViewParameter($name, $value) {
        $this->viewParameters[$name] = $value;
    }

    protected function getViewParameters() {
        return $this->viewParameters;
    }

}
