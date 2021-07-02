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

use App\Adapter\GoogleGeocodeAdapter;
use App\Entity\Business;
use App\Form\BusinessType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class BusinessController extends ApiController
{

    #[Route("/api/business",methods: "post")]
    public function postAction(Request $request,GoogleGeocodeAdapter $adapter): Response
    {
        $data = json_decode($request->getContent(), true);
        $business = new Business();
        $form = $this->createForm(BusinessType::class, $business,[]);
        $form->submit($data);

        if (!$form->isValid()){
            return $this->json([
                "errors" => $this->getErrorsFromForm($form)
            ],400);
        }

        if (!$business->getWgs84N()||!$business->getWgs84E()){
            try {
                $location = $adapter
                    ->getLocationByAddress(
                        $business->getAddress()
                    )
                ;
            }catch (\Exception $e){
                return $this->json([
                    "error_message" => $e->getMessage()
                ], 500);
            } catch (TransportExceptionInterface $e) {
                return $this->json([
                    "error_message" => $e->getMessage()
                ], 500);
            }

            $business->setWgs84N($location["wgs84N"]);
            $business->setWgs84E($location["wgs84E"]);

        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($business);
        $em->flush();

        return $this->json(data:$business,status:201,context:[
            'groups' => 'show_business'
        ]);
    }

}