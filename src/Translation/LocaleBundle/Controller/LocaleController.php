<?php

namespace Translation\LocaleBundle\Controller;

use Translation\LocaleBundle\Entity\Locale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Locale controller.
 *
 * @Route("admin/locale")
 */
class LocaleController extends Controller
{
    /**
     * Lists all locale entities.
     *
     * @Route("/", name="admin_locale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        return $this->render('@TranslationLocale/locale/index.html.twig', array(
            'locales' => $locales,
        ));
    }

    /**
     * Creates a new locale entity.
     *
     * @Route("/new", name="admin_locale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $locale = new Locale();
        $form = $this->createForm('Translation\LocaleBundle\Form\LocaleType', $locale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locale);
            $em->flush();

            return $this->redirectToRoute('admin_locale_index');
        }

        return $this->render('@TranslationLocale/locale/new.html.twig', array(
            'locale' => $locale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a locale entity.
     *
     * @Route("/{id}", name="admin_locale_show")
     * @Method("GET")
     */
    public function showAction(Locale $locale)
    {
        $deleteForm = $this->createDeleteForm($locale);

        return $this->render('@TranslationLocale/locale/show.html.twig', array(
            'locale' => $locale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing locale entity.
     *
     * @Route("/{id}/edit", name="admin_locale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Locale $locale)
    {
        $deleteForm = $this->createDeleteForm($locale);
        $editForm = $this->createForm('Translation\LocaleBundle\Form\LocaleType', $locale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_locale_index');
        }

        return $this->render('@TranslationLocale/locale/edit.html.twig', array(
            'locale' => $locale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a locale entity.
     *
     * @Route("/{id}/delete", name="admin_locale_delete")
     * Method("DELETE")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Locale $locale)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($locale);
        $em->flush();
//        $form = $this->createDeleteForm($locale);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($locale);
//            $em->flush();
//        }

        return $this->redirectToRoute('admin_locale_index');
    }

    /**
     * Creates a form to delete a locale entity.
     *
     * @param Locale $locale The locale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Locale $locale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_locale_delete', array('id' => $locale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
