<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\CommonInformation;
use Management\AdminBundle\Entity\CommonInformationTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commoninformation controller.
 *
 * @Route("admin/common_information")
 */
class CommonInformationController extends Controller
{
    /**
     * Redirects to required route.
     *
     * @Route("/{action}/", requirements={"action" = "(index|new)"},
     *     name="admin_common_information_redirect")
     * @Method("GET")
     */
    public function redirectAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        if ($action == 'index') {
            return $this->redirectToRoute('admin_common_information_translation_index', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
        else {
            return $this->redirectToRoute('admin_common_information_translation_new', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
    }

    /**
     * Lists all commonInformation entities.
     *
     * @Route("/{locale}/", name="admin_common_information_translation_index")
     * @Method("GET")
     */
    public function indexAction(string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $commonInformation = $em->getRepository('ManagementAdminBundle:CommonInformation')
            ->createQueryBuilder('cI')
            ->orderBy('cI.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/commoninformation/index.html.twig', array(
            'commonInformation' => $commonInformation,
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new commonInformation entity.
     *
     * @Route("/{locale}/new", requirements={"locale" = ".[a-zA-Z]"}, name="admin_common_information_translation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = new CommonInformationTranslation($locale);

        $form = $this->createForm('Management\AdminBundle\Form\CommonInformationTranslationType', $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commonInformation = new Commoninformation();
            $em->persist($commonInformation);

            $translation->setSource($commonInformation);
            $em->persist($translation);
            $em->flush();

            return $this->redirectToRoute('admin_common_information_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/commoninformation/new.html.twig', array(
            'translation' => $translation,
            'form' => $form->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Finds and displays a commonInformation entity.
     *
     * @Route("/{id}", name="admin_common_information_show")
     * @Method("GET")
     */
    public function showAction(CommonInformation $commonInformation)
    {
        $deleteForm = $this->createDeleteForm($commonInformation);

        return $this->render('@ManagementAdmin/commoninformation/show.html.twig', array(
            'commonInformation' => $commonInformation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commonInformation entity.
     *
     * @Route("/{id}/{locale}/edit", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_common_information_translation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CommonInformation $commonInformation, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = $em->getRepository('ManagementAdminBundle:CommonInformationTranslation')
            ->findOneBy(['source' => $commonInformation, 'locale' => $locale]);
        if (!$translation) {
            $translation = new CommonInformationTranslation($locale);
            $translation->setSource($commonInformation);
            $em->persist($translation);
        }

        $editForm = $this->createForm('Management\AdminBundle\Form\CommonInformationTranslationType', $translation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();

            return $this->redirectToRoute('admin_common_information_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/commoninformation/edit.html.twig', array(
            'commonInformation' => $commonInformation,
            'edit_form' => $editForm->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Deletes a commonInformation entity.
     *
     * @Route("/{id}", name="admin_common_information_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CommonInformation $commonInformation)
    {
        $form = $this->createDeleteForm($commonInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commonInformation);
            $em->flush();
        }

        return $this->redirectToRoute('admin_common_information_index');
    }

    /**
     * Creates a form to delete a commonInformation entity.
     *
     * @param CommonInformation $commonInformation The commonInformation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommonInformation $commonInformation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_common_information_delete', array('id' => $commonInformation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
