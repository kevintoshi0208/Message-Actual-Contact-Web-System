<?php


namespace App\Controller;

use App\Entity\Visiting;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaybeInfectedController extends ApiController
{
    /** 輸入後場所代碼和時間，可以找過去七天，到過該場所的人 */
    #[Route("/api/maybeInfected/byCodeAndTime")]
    public function getInfectedByCodeAndTimeAction(Request $request): Response
    {
        $data = $this
            ->getDoctrine()
            ->getRepository(Visiting::class)
            ->findByCodeAndTime(
                ltrim($request->get("code"),"0"),
                $request->get("time"),
            )
        ;
        return $this->json(data:$data,status:200);
    }

    /** 加強版 輸入後場所代碼和時間，可以找過去七天 到過範圍50公尺場所的 */
    #[Route("/api/maybeInfected/byCodeAndTimeEnhance")]
    public function getInfectedByCodeAndTimeEnhanceAction(Request $request): Response
    {
        $data = $this
            ->getDoctrine()
            ->getRepository(Visiting::class)
            ->findByCodeAndTimeEnhance(
                ltrim($request->get("code"),"0"),
                $request->get("time"),
            )
        ;
        return $this->json(data:$data,status:200);
    }

    /** 輸入使用者手機後，可以找過去七天，跟確診者前後四小時到過相同場所的人 */
    #[Route("/api/maybeInfected/byInfectedPhone")]
    public function getInfectedByInfectedPhoneAction(Request $request): Response
    {
        $data = $this
            ->getDoctrine()
            ->getRepository(Visiting::class)
            ->findByInfectedPhone(
                $request->get("phone")
            )
        ;
        return $this->json(data:$data,status:200);
    }
}