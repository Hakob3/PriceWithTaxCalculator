<?php

namespace App\Controller;

use App\Entity\Buyer;
use App\Entity\Country;
use App\Entity\Product;
use App\Form\PriceCalculatorType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_price')]
class PriceCalculatorController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws NonUniqueResultException
     */
    #[Route('/', name: '_form')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(PriceCalculatorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $taxNumber = $formData['taxNumber'];

            /** @var Product $product */
            $product = $formData['product'];

            $country = $entityManager->getRepository(Country::class)->findCountryByTaxNumber($taxNumber);

            $priceWithoutTaxes = $product->getPrice();
            $priceWithTaxes = $priceWithoutTaxes + (($priceWithoutTaxes * $country->getTax()) / 100);

            return $this->render('price_calculator/price.html.twig', [
                'priceWithTaxes' => $priceWithTaxes,
                'product' => $product,
                'buyer' => $entityManager->getRepository(Buyer::class)->findOneBy(['taxNumber' => $taxNumber]),
            ]);
        }

        return $this->render(
            'price_calculator/form.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }
}
