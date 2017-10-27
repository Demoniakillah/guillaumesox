<?php

namespace SoxleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use SoxleBundle\Entity\Uri;

class ApiController extends Controller {

    /**
     * @Route("/admin/getUnavailableNavbarmenuPosition", name="get_unavailable_navbarmenu_position")
     */
    public function getUnavailableNavbarmenuPositionAction() {
        return $this->getUnavailable('\SoxleBundle\Entity\NavBarMenu');
    }

    /**
     * @Route("/admin/getUnabailableImagePosition", name="get_unavailable_image_position")
     */
    public function getUnabailableImagePositionAction() {
        return $this->getUnavailable('\SoxleBundle\Entity\Image');
    }

    protected function getUnavailable($class) {
        $position = $this->get('request')->request->get('position');
        $image = $this->getDoctrine()->getManager()->getRepository($class)->findOneByPosition($position);
        if ($image instanceof $class) {
            $output = 1;
        } else {
            $output = 0;
        }
        return new Response($output);
    }

    /**
     * @Route("/getImagesByUri", name="get_page_img_api")
     */
    public function getImagesByUriAction() {
        $output = array();
        $uri = $this->get('request')->request->get('uri');
        $uriEntity = $this->getDoctrine()->getManager()->getRepository('SoxleBundle:Uri')->findOneByValue($uri);
        if ($uriEntity instanceof Uri) {
            $imageList = $this->getDoctrine()->getManager()->getRepository('SoxleBundle:Image')->findByUri($uriEntity, array('position' => 'ASC'));
            foreach ($imageList as $image) {
                $output[] = $image->getUrl();
            }
        }
        return new JsonResponse($output, 200);
    }

}
