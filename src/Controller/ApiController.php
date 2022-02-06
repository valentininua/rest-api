<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use App\Services\CarService;

/**
 * Class PostController
 * @package App\Controller
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    /**
     * @param HttpClientInterface $client
     * @param CarService $carService
     */
    public function __construct(
        public HttpClientInterface $client,
        public CarService          $carService,
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     *
     * @Route("/getNewBaseByNumberCar", name="all", methods={"POST|GET"})
     */
    public function handler(Request $request): JsonResponse
    {
        try {
            return new JsonResponse(
                    $this->carService->sendNewBaseByNumberCar(
                        json_decode($request->getContent(), true)['number_car']
                )
            );
        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => 422,
                'errors' => "Proxy error",
            ], 422);
        }

    }

//    /**
//     * @param Request $request
//     * @param EntityManagerInterface $entityManager
//     * @param CarRepository $postRepository
//     * @return JsonResponse
//     * @throws \Exception
//     * @Route("/posts", name="posts_add", methods={"POST"})
//     */
//    public function addPost(Request $request, EntityManagerInterface $entityManager, CarRepository $postRepository){
//
//        try{
//            $request = $this->transformJsonBody($request);
//
//            if (!$request || !$request->get('name') || !$request->request->get('description')){
//                throw new \Exception();
//            }
//
//            $post = new Car();
//            $post->setName($request->get('name'));
//            $post->setDescription($request->get('description'));
//            $entityManager->persist($post);
//            $entityManager->flush();
//
//            $data = [
//                'status' => 200,
//                'success' => "Post added successfully",
//            ];

//            return $this->response($data);
//
//        }catch (\Exception $e){
//            $data = [
//                'status' => 422,
//                'errors' => "Data no valid",
//            ];
//            return $this->response($data, 422);
//        }
//
//    }

//    /**
//     * @param CarRepository $postRepository
//     * @param $id
//     * @return JsonResponse
//     * @Route("/posts/{id}", name="posts_get", methods={"GET"})
//     */
//    public function getPost(CarRepository $postRepository, $id){
//        $post = $postRepository->find($id);
//
//        if (!$post){
//            $data = [
//                'status' => 404,
//                'errors' => "Post not found",
//            ];
//            return $this->response($data, 404);
//        }
//        return $this->response($post);
//    }

//    /**
//     * @param Request $request
//     * @param EntityManagerInterface $entityManager
//     * @param CarRepository $postRepository
//     * @param $id
//     * @return JsonResponse
//     * @Route("/posts/{id}", name="posts_put", methods={"PUT"})
//     */
//    public function updatePost(Request $request, EntityManagerInterface $entityManager, CarRepository $postRepository, $id){
//
//        try{
//            $post = $postRepository->find($id);
//
//            if (!$post){
//                $data = [
//                    'status' => 404,
//                    'errors' => "Post not found",
//                ];
//                return $this->response($data, 404);
//            }
//
//            $request = $this->transformJsonBody($request);
//
//            if (!$request || !$request->get('name') || !$request->request->get('description')){
//                throw new \Exception();
//            }
//
//            $post->setName($request->get('name'));
//            $post->setDescription($request->get('description'));
//            $entityManager->flush();
//
//            $data = [
//                'status' => 200,
//                'errors' => "Post updated successfully",
//            ];
//            return $this->response($data);
//
//        }catch (\Exception $e){
//            $data = [
//                'status' => 422,
//                'errors' => "Data no valid",
//            ];
//            return $this->response($data, 422);
//        }
//
//    }

//    /**
//     * @param CarRepository $postRepository
//     * @param $id
//     * @return JsonResponse
//     * @Route("/posts/{id}", name="posts_delete", methods={"DELETE"})
//     */
//    public function deletePost(EntityManagerInterface $entityManager, CarRepository $postRepository, $id){
//        $post = $postRepository->find($id);
//
//        if (!$post){
//            $data = [
//                'status' => 404,
//                'errors' => "Post not found",
//            ];
//            return $this->response($data, 404);
//        }
//
//        $entityManager->remove($post);
//        $entityManager->flush();
//        $data = [
//            'status' => 200,
//            'errors' => "Post deleted successfully",
//        ];
//        return $this->response($data);
//    }
//
//    /**
//     * Returns a JSON response
//     *
//     * @param array $data
//     * @param $status
//     * @param array $headers
//     * @return JsonResponse
//     */
//    public function response($data, $status = 200, $headers = [])
//    {
//        return new JsonResponse($data, $status, $headers);
//    }
//
//    protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
//    {
//        $data = json_decode($request->getContent(), true);
//
//        if ($data === null) {
//            return $request;
//        }
//
//        $request->request->replace($data);
//
//        return $request;
//    }

}