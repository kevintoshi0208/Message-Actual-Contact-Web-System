<?php
/**
 *
 * This file is part of a repository on GitHub.
 *
 * (c) Riccardo De Martis <riccardo@demartis.it>
 *
 * <https://github.com/demartis>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace App\Controller;

use App\Entity\Bussiness;
use App\Form\BusinessType;
use AppBundle\Controller\ApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BusinessController extends ApiController
{

    /**
     * @Route("/api/business",methods={"post"})
     */
    public function postAction($request): Response
    {
        $data = json_decode($request->getContent(), true);
        $business = new Bussiness();
        $form = $this->createForm(BusinessType::class, $business,[
            'allow_extra_fields' => true,
        ]);
        $form->submit($data);

        if (!$form->isValid()){
            return $this->json($this->getErrorsFromForm($form),400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($business);
        $em->flush();

        return $this->json($business,201,[

        ]);
    }

}