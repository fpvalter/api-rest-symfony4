<?php

namespace App\Controller;

use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/omie", name="omie")
 */
class OmieController extends AbstractController
{

    /**
     * @Route("/nf-autorizada", name="nota-autorizada", methods={"POST", "GET"})
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        return $this->json([
            'msg' => 'OK'
        ]);
    }


}
