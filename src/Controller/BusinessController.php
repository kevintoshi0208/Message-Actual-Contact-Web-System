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

use App\Entity\Book;
use App\Entity\Bussiness;
use App\Exception\FormException;
use App\Form\BookType;
use FOS\RestBundle\Controller\AbstractFOSRestController;

use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;

use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class BookController extends AbstractFOSRestController
{

    /**
     * @param $id
     * @return Response
     */
    public function getBookAction($id){
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Bussiness::class)->find($id);

        if (!$book) {
            throw new ResourceNotFoundException( "Resource $id not found");
        }

        $view = $this->view($book, Response::HTTP_OK , []);
        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @throws FormException
     * @return Response
     */
    public function postBookAction(Request $request){
        // @TODO: restore ParamFetcher
        // @TODO: workaround for https://github.com/FriendsOfSymfony/FOSRestBundle/issues/2258

        $book = new Bussiness();
        $body=json_decode($request->getContent(), true);
        return $this->save($book, $body['data']);
    }

}