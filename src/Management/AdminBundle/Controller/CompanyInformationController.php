<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\CompanyInformation;
use Management\AdminBundle\Entity\CompanyInformationTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Companyinformation controller.
 *
 * @Route("admin/company_information")
 */
class CompanyInformationController extends Controller
{
    /**
     * Redirects to required route.
     *
     * @Route("/{action}/", requirements={"action" = "(index|new)"},
     *     name="admin_company_information_redirect")
     * @Method("GET")
     */
    public function redirectAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        if ($action == 'index') {
            return $this->redirectToRoute('admin_company_information_translation_index', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
        else {
            return $this->redirectToRoute('admin_company_information_translation_new', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
    }

    /**
     * Lists all companyInformation entities.
     *
     * @Route("/{locale}/", name="admin_company_information_translation_index")
     * @Method("GET")
     */
    public function indexAction(string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $companyInformation = $em->getRepository('ManagementAdminBundle:CompanyInformation')
            ->createQueryBuilder('cI')
            ->orderBy('cI.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/companyinformation/index.html.twig', array(
            'companyInformation' => $companyInformation,
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new companyInformation entity.
     *
     * @Route("/{locale}/new", requirements={"locale" = ".[a-zA-Z]"}, name="admin_company_information_translation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = new CompanyInformationTranslation($locale);

        $form = $this->createForm('Management\AdminBundle\Form\CompanyInformationTranslationType',
            $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyInformation = new CompanyInformation();
            $companyInformation->setEmail($form->get('email')->getData());
            $companyInformation->setPhoneNumber($form->get('phoneNumber')->getData());
            $em->persist($companyInformation);

            $translation->setSource($companyInformation);
            $em->persist($translation);
            $em->flush();

            return $this->redirectToRoute('admin_company_information_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/companyinformation/new.html.twig', array(
            'translation' => $translation,
            'form' => $form->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Finds and displays a companyInformation entity.
     *
     * @Route("/{id}", name="admin_company_information_show")
     * @Method("GET")
     */
    public function showAction(CompanyInformation $companyInformation)
    {
        $deleteForm = $this->createDeleteForm($companyInformation);

        return $this->render('@ManagementAdmin/companyinformation/show.html.twig', array(
            'companyInformation' => $companyInformation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing companyInformation entity.
     *
     * @Route("/{id}/{locale}/edit", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_company_information_translation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CompanyInformation $companyInformation, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = $em->getRepository('ManagementAdminBundle:CompanyInformationTranslation')
            ->findOneBy(['source' => $companyInformation, 'locale' => $locale]);
        if (!$translation) {
            $translation = new CompanyInformationTranslation($locale);
            $translation->setSource($companyInformation);
            $em->persist($translation);
        }

        $editForm = $this->createForm('Management\AdminBundle\Form\CompanyInformationTranslationType',
            $translation);
        $editForm->get('email')->setData($companyInformation->getEmail());
        $editForm->get('phoneNumber')->setData($companyInformation->getPhoneNumber());
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_company_information_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/companyinformation/edit.html.twig', array(
            'companyInformation' => $companyInformation,
            'edit_form' => $editForm->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Deletes a companyInformation entity.
     *
     * @Route("/{id}", name="admin_company_information_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CompanyInformation $companyInformation)
    {
        $form = $this->createDeleteForm($companyInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($companyInformation);
            $em->flush();
        }

        return $this->redirectToRoute('admin_company_information_index');
    }

    /**
     * Creates a form to delete a companyInformation entity.
     *
     * @param CompanyInformation $companyInformation The companyInformation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CompanyInformation $companyInformation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_company_information_delete', array('id' => $companyInformation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
