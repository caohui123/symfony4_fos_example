<?php

namespace App\Controller;

use App\Entity\Product;
use FOS\RestBundle\Controller\Annotations as FOS;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class ProductController
 * @package App\Controller
 * @author Dmytro Nekrasov <dmytro.nekrasov@internetstores.com>
 */
class ProductController extends FOSRestController
{
    /**
     * @FOS\Get("/product")
     * @FOS\View()
     */
    public function getAllAction(Request $request)
    {
        $data = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @FOS\Get("/product/{id}")
     * @FOS\View()
     */
    public function getAction(Request $request, $id)
    {
        $data = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if ($data === null) {
            throw new NotFoundHttpException('Not found');
        }

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }
}