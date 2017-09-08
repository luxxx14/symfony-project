<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Client;
use Management\AdminBundle\Entity\ClientTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 * @Route("admin/client")
 */
class ClientController extends Controller
{
    /**
     * Redirects to required route.
     *
     * @Route("/{action}/", requirements={"action" = "(index|new)"},
     *     name="admin_client_redirect")
     * @Method("GET")
     */
    public function redirectAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        if ($action == 'index') {
            return $this->redirectToRoute('admin_client_translation_index', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
        else {
            return $this->redirectToRoute('admin_client_translation_new', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
    }

    /**
     * Lists all client entities.
     *
     * @Route("/{locale}/", name="admin_client_translation_index")
     * @Method("GET")
     */
    public function indexAction(string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $clients = $em->getRepository('ManagementAdminBundle:Client')
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/client/index.html.twig', array(
            'clients' => $clients,
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new client entity.
     *
     * @Route("/{locale}/new", requirements={"locale" = ".[a-zA-Z]"}, name="admin_client_translation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = new ClientTranslation($locale);

        $form = $this->createForm('Management\AdminBundle\Form\ClientTranslationType', $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = new Client();
            $em->persist($client);

            $translation->setSource($client);
            $em->persist($translation);
            $em->flush();

            return $this->redirectToRoute('admin_client_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/client/new.html.twig', array(
            'translation' => $translation,
            'form' => $form->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{id}", name="admin_client_show")
     * @Method("GET")
     */
    public function showAction(Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('@ManagementAdmin/client/show.html.twig', array(
            'client' => $client,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     * @Route("/{id}/{locale}/edit", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_client_translation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Client $client, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = $em->getRepository('ManagementAdminBundle:ClientTranslation')
            ->findOneBy(['source' => $client, 'locale' => $locale]);
        if (!$translation) {
            $translation = new ClientTranslation($locale);
            $translation->setSource($client);
            $em->persist($translation);
        }

//        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('Management\AdminBundle\Form\ClientTranslationType', $translation);
//        $editForm->get('colorImageFile')->setData($client->getColorImageFile());
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $client->setColorImageFile($editForm->get('colorImageFile')->getData());
            $em->flush();

            return $this->redirectToRoute('admin_client_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/client/edit.html.twig', array(
            'client' => $client,
            'translation' => $translation,
            'edit_form' => $editForm->createView(),
            'locale' => $locale,
            'locales' => $locales,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

//    /**
//     * Redirect to route for deleting client entity.
//     *
//     * @Route("/{id}/edit", name="admin_client_redirect_to_delete")
//     * @Method("GET")
//     */
//    public function redirectToDeleteAction(Request $request, Client $client)
//    {
//        $deleteForm = $this->createDeleteForm($client);
//        $editForm = $this->createForm('Management\AdminBundle\Form\ClientType', $client);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('admin_client_index');
//        }
//
//        return $this->render('@ManagementAdmin/client/edit.html.twig', array(
//            'client' => $client,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Deletes a client entity.
     *
     * @Route("/{id}/{locale}/delete", name="admin_client_delete")
     * Method({"GET", "DELETE"})
     * @Method("GET")
     */
    public function deleteAction(Request $request, Client $client, string $locale)
    {
        $em = $this->getDoctrine()->getManager();
        foreach ($client->getTranslations() as $translation) {
            $em->remove($translation);
        }
        $em->remove($client);
        $em->flush();
//        $form = $this->createDeleteForm($client);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($client);
//            $em->flush();
//        }

        return $this->redirectToRoute('admin_client_translation_index', ['locale' => $locale]);
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Client $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
