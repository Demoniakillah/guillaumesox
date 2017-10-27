<?php

namespace SoxleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use SoxleBundle\Entity\Uri;
use SoxleBundle\Entity\Image;

class ApiController extends Controller
{
    /**
     * @Route("/getImagesByUri", name="get_page_img_api")
     */
    public function getImagesByUriAction()
    {
        $output = array();
        $uri = $this->get('request')->request->get('uri');
        $uriEntity = $this->getDoctrine()->getManager()->getRepository('SoxleBundle:Uri')->findOneByValue($uri);
        if($uriEntity instanceof Uri){
            /* @var $imageList Image[] */
            $imageList = $this->getDoctrine()->getManager()->getRepository('SoxleBundle:Image')->findByUri($uriEntity, array('position' => 'ASC'));
            foreach ($imageList as $image){
                $output[] = $image->getUrl();
            }
        }
        return new JsonResponse($output, 200);
    }

}
