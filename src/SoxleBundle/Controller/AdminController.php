<?php

namespace SoxleBundle\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminController
 *
 * @author demoniakillah
 */
class AdminController extends EasyAdminController {

    /**
     * @Route("/admin/", name="easyadmin")
     */
    public function indexAction(Request $request) {
        $response = parent::indexAction($request);
        return $response;
    }

    protected function initialize(Request $request) {
        parent::initialize($request);
        if (!empty($this->entity['class'])) {
            switch ($this->entity['class']) {
                case 'SoxleBundle\Entity\Image':
                    $this->entity['templates']['edit'] = '@Soxle\editImage.html.twig';
                    $this->entity['templates']['new'] = '@Soxle\newImage.html.twig';
                    break;
                case 'SoxleBundle\Entity\NavBarMenu':
                    $this->entity['templates']['edit'] = '@Soxle\editNavBarMenu.html.twig';
                    $this->entity['templates']['new'] = '@Soxle\newNavBarMenu.html.twig';
                    break;
                default:
                    break;
            }
        }
    }

}
