<?php declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Font;
//use App\ViewModels\TaskVm;
use App\ViewModels\FontVm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;


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
            $fontVms[] = new FontVm($font->getName(), $font->getAuthor(), $font->getSize());
        }

        return $this->render(
            'show.html.twig',
            [
                'fonts' => $fontVms
            ]
        );
    }

    /**
     * @Route("/caris/edit", name="edit_item")
     */
    public function editItem(Request $request, int $id)
    {
        return $this->render(
            'form.html.twig',
            [
                'id' => $id
            ]
        );
    }

    /**
     * @Route("/caris/new", name="new_item")
     */
    public function newItem(Request $request)
    {
        // creates a font and gives it some dummy data for this example
        $viewModel = new FontVm('','', 0);

        $form = $this->createFormBuilder($viewModel)
            ->add('name', TextType::class)
            ->add('author', TextType::class)
            ->add('size', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Create font'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $fontVm = $form->getData();

            // ... perform some action, such as saving the font to the database
            // for example, if Font is a Doctrine entity, save it!
//            $task = new Task($taskVm, $this->getUser()->getUserName());
            $task = new Font($fontVm);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
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