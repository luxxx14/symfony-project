<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Text;
use Management\AdminBundle\Entity\TextTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Text controller.
 *
 * @Route("admin/text")
 */
class TextController extends Controller
{
    /**
     * Redirects to required route.
     *
     * @Route("/{action}/", requirements={"action" = "(index|new)"},
     *     name="admin_text_redirect")
     * @Method("GET")
     */
    public function redirectAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        if ($action == 'index') {
            return $this->redirectToRoute('admin_text_translation_index', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
        else {
            return $this->redirectToRoute('admin_text_translation_new', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
    }

    /**
     * Lists all text entities.
     *
     * @Route("/{locale}/", name="admin_text_translation_index")
     * @Method("GET")
     */
    public function indexAction(string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $texts = $em->getRepository('ManagementAdminBundle:Text')
            ->createQueryBuilder('t')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/text/index.html.twig', array(
            'texts' => $texts,
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new text entity.
     *
     * @Route("/{locale}/new", requirements={"locale" = ".[a-zA-Z]"}, name="admin_text_translation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = new TextTranslation($locale);

        $form = $this->createForm('Management\AdminBundle\Form\TextTranslationType', $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $text = new Text();
            $em->persist($text);

            $translation->setSource($text);
            $em->persist($translation);
            $em->flush();

            return $this->redirectToRoute('admin_text_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/text/new.html.twig', array(
            'translation' => $translation,
            'form' => $form->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Finds and displays a text entity.
     *
     * @Route("/{id}", name="admin_text_translation_show")
     * @Method("GET")
     */
    public function showAction(Text $text)
    {
        $deleteForm = $this->createDeleteForm($text);

        return $this->render('@ManagementAdmin/text/show.html.twig', array(
            'text' => $text,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing text entity.
     *
     * @Route("/{id}/{locale}/edit", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_text_translation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Text $text, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = $em->getRepository('ManagementAdminBundle:TextTranslation')
            ->findOneBy(['source' => $text, 'locale' => $locale]);
        if (!$translation) {
            $translation = new TextTranslation($locale);
            $translation->setSource($text);
            $em->persist($translation);
        }

        $editForm = $this->createForm('Management\AdminBundle\Form\TextTranslationType', $translation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();

            return $this->redirectToRoute('admin_text_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/text/edit.html.twig', array(
            'text' => $text,
            'edit_form' => $editForm->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Deletes a text entity.
     *
     * @Route("/{id}", name="admin_text_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Text $text)
    {
        $form = $this->createDeleteForm($text);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($text);
            $em->flush();
        }

        return $this->redirectToRoute('admin_text_translation_index');
    }

    /**
     * Creates a form to delete a text entity.
     *
     * @param Text $text The text entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Text $text)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_text_delete', array('id' => $text->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
