<?php

namespace App\Controller;

use App\Entity\ApiConnection;
use App\Form\CardDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="app_payment")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PaymentController.php',
        ]);
    }

    /**
     * @Route("/payment/requestCode", name="app_payment_requestcode")
     */
    public function requestQRCode(Request $request): Response
    {
        $form = $this->createForm(CardDataType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->render('QRCode.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $this->render('card.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/token", name="app_token")
     */
    public function requestToken(Request $request): Response
    {
        $api = new ApiConnection();
        $token = $api->getToken();

        return $this->render('token.html.twig', [
            'token' => $token,
        ]);
    }
}
