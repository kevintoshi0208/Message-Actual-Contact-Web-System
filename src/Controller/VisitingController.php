<?php


namespace App\Controller;


use App\Entity\Business;
use App\Entity\Visiting;
use App\Form\BusinessType;
use App\Form\VisitingType;
use App\Service\DealVisitTextService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisitingController extends ApiController
{

    #[Route("/api/visiting",methods: "post")]
    public function postAction(Request $request,DealVisitTextService $dealVisitText): Response
    {
        $data = json_decode($request->getContent(), true);

        $visiting = new Visiting();
        $form = $this->createForm(VisitingType::class, $visiting,[]);
        $form->submit($data);

        if (!$form->isValid()){
            return $this->json([
                "errors" => $this->getErrorsFromForm($form)
            ],400);
        }

        $code = $dealVisitText->dealVisitText($form["text"]->getData());

        $em = $this->getDoctrine()->getManager();
        $visiting->setBusiness(
            $em->getRepository(Business::class)->find($code)
        );

        $em->persist($visiting);
        $em->flush();

        return $this->json(data:$visiting,status:201,context:[
            'groups' => 'show_visiting'
        ]);
    }

}