<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Component;
use Management\AdminBundle\Entity\ComponentTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Component controller.
 *
 * @Route("admin/component")
 */
class ComponentController extends Controller
{
    /**
     * Redirects to required route.
     *
     * @Route("/{action}/", requirements={"action" = "(index|new)"},
     *     name="admin_component_redirect")
     * @Method("GET")
     */
    public function redirectAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        if ($action == 'index') {
            return $this->redirectToRoute('admin_component_translation_index', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
        else {
            return $this->redirectToRoute('admin_component_translation_new', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
    }

    /**
     * Lists translation entries of all component entities.
     *
     * @Route("/{locale}/", name="admin_component_translation_index")
     * @Method("GET")
     */
    public function indexAction(string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $components = $em->getRepository('ManagementAdminBundle:Component')
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/component/index.html.twig', array(
            'components' => $components,
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new translation for component entity.
     *
     * @Route("/{locale}/new", requirements={"locale" = ".[a-zA-Z]"}, name="admin_component_translation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = new ComponentTranslation($locale);

        $form = $this->createForm('Management\AdminBundle\Form\ComponentTranslationType', $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $component = new Component();
            $component->setWikiUrl($form->get('wikiUrl')->getData());
            $em->persist($component);

            $translation->setSource($component);
            $em->persist($translation);
            $em->flush();

            return $this->redirectToRoute('admin_component_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/component/new.html.twig', array(
            'translation' => $translation,
            'form' => $form->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Finds and displays a component entity.
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="admin_component_show")
     * @Method("GET")
     */
    public function showAction(Component $component)
    {
        $deleteForm = $this->createDeleteForm($component);

        return $this->render('@ManagementAdmin/component/show.html.twig', array(
            'component' => $component,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit a translation of existing component entity.
     *
     * @Route("/{id}/{locale}/edit", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_component_translation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Component $component, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = $em->getRepository('ManagementAdminBundle:ComponentTranslation')
            ->findOneBy(['source' => $component, 'locale' => $locale]);
        if (!$translation) {
            $translation = new ComponentTranslation($locale);
            $translation->setSource($component);
            $em->persist($translation);
        }

        $editForm = $this->createForm('Management\AdminBundle\Form\ComponentTranslationType', $translation);
        $editForm->get('wikiUrl')->setData($component->getWikiUrl());
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();

            return $this->redirectToRoute('admin_component_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/component/edit.html.twig', array(
            'component' => $component,
            'edit_form' => $editForm->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Deletes a component entity.
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="admin_component_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Component $component)
    {
        $form = $this->createDeleteForm($component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($component);
            $em->flush();
        }

        return $this->redirectToRoute('admin_component_index');
    }

    /**
     * Creates a form to delete a component entity.
     *
     * @param Component $component The component entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Component $component)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_component_delete', array('id' => $component->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
