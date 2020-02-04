<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 * @package AppBundle\Controller
 *
 * @Route("/")
 */
class ContactController extends Controller
{
    /**
     * List all Contacts
     *
     * @Route("/contacts", name="contact_index")
     * @Template("@App/Contact/index.html.twig")
     *
     * @return array
     */
    public function indexAction(): array
    {
        $contactRepository = $this->getDoctrine()->getRepository(Contact::class);

        return [
            'contacts' => $contactRepository->findAll(),
        ];
    }

    /**
     * Create a new Contact
     *
     * @Route("/contact/create/", name="contact_create")
     * @Template("@App/Contact/create.html.twig")
     *
     * @param Request $request
     * @return RedirectResponse|array
     */
    public function createAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_index', ['id' => $contact->getId()]);
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Edit Contact
     *
     * @Route("/contact/edit/{id}", name="contact_edit")
     * @Template("@App/Contact/edit.html.twig")
     *
     * @param Request $request
     * @param Contact $contact
     * @return RedirectResponse|array
     */
    public function editAction(
        Request $request,
        Contact $contact
    )
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('contact_index', ['id' => $contact->getId()]);
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Delete Contact
     *
     * @Route("/contact/delete/{id}", name="contact_delete")
     *
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function deleteAction(Contact $contact): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('contact_index');
    }
}