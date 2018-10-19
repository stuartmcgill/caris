<?php declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Font;
use App\ViewModels\FontVm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; //keep this
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class Caris extends AbstractController
{
    /**
     * @Route("/caris/show", name="show")
     */
    public function show()
    {
        $fonts = $this->getDoctrine()->getManager()->getRepository(Font::class)->findAll();

        $fontVms = [];
        foreach ($fonts as $font) {
            $fontVms[] = new FontVm($font->getName(), $font->getAuthor(), $font->getSize(), $font->getId());
        }

        return $this->render(
            'show.html.twig',
            [
                'fonts' => $fontVms
            ]
        );
    }

    /**
     * @Route("/caris/edit/{id}", name="edit_item")
     */
    public function editItem(Request $request, int $id)
    {
        $font = $this->getDoctrine()->getManager()->getRepository(Font::class)->find($id);
        return $this->saveItem($request, $font);
    }

    /**
     * @Route("/caris/new", name="new_item")
     */
    public function newItem(Request $request)
    {
        return $this->saveItem($request, new Font());
        // creates a font and gives it some dummy data for this example
        $viewModel = new FontVm('','', null);
    }

    private function saveItem(Request $request, Font $font)
    {
        $new = empty($font->getId());

        $viewModel = new FontVm($font->getName(), $font->getAuthor(), $font->getSize(), $font->getId());

        $form = $this->createFormBuilder($viewModel)
            ->add('name', TextType::class)
            ->add('author', TextType::class)
            ->add('size', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Save font'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$font` variable has also been updated
            $fontVm = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            if ($new) {
                $font = new Font($fontVm);
                $entityManager->persist($font);
            } else {
                $font->update($fontVm);
            }

            $entityManager->flush();

            return $this->redirectToRoute('display_success');
        }

        return $this->render(
            'form.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/caris/success", name="display_success")
     */
    public function displaySuccess(Request $request)
    {
        return $this->render(
            'display_success.html.twig',
            [
            ]
        );
    }
}