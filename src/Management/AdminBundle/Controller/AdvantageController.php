<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Advantage;
use Management\AdminBundle\Entity\AdvantageTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Advantage controller
 *
 * @Route("admin/advantage")
 */
class AdvantageController extends Controller
{
    /**
     * Redirects to required route.
     *
     * @Route("/{action}/", requirements={"action" = "(index|new)"},
     *     name="admin_advantage_redirect")
     * @Method("GET")
     */
    public function redirectAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        if ($action == 'index') {
            return $this->redirectToRoute('admin_advantage_translation_index', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
        else {
            return $this->redirectToRoute('admin_advantage_translation_new', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
    }

    /**
     * Lists all advantage entities.
     *
     * @Route("/{locale}/", name="admin_advantage_translation_index")
     * @Method("GET")
     */
    public function indexAction(string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $advantages = $em->getRepository('ManagementAdminBundle:Advantage')
            ->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/advantage/index.html.twig', array(
            'advantages' => $advantages,
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new advantage entity.
     *
     * @Route("/{locale}/new", requirements={"locale" = ".[a-zA-Z]"}, name="admin_advantage_translation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = new AdvantageTranslation($locale);

        $form = $this->createForm('Management\AdminBundle\Form\AdvantageTranslationType', $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advantage = new Advantage();
            $em->persist($advantage);

            $translation->setSource($advantage);
            $em->persist($translation);
            $em->flush();

            return $this->redirectToRoute('admin_advantage_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/advantage/new.html.twig', array(
            'translation' => $translation,
            'form' => $form->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Finds and displays a advantage entity.
     *
     * @Route("/{id}", name="admin_advantage_show")
     * @Method("GET")
     */
    public function showAction(Advantage $advantage)
    {
        $deleteForm = $this->createDeleteForm($advantage);

        return $this->render('@ManagementAdmin/advantage/show.html.twig', array(
            'advantage' => $advantage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing advantage entity.
     *
     * @Route("/{id}/{locale}/edit", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_advantage_translation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Advantage $advantage, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = $em->getRepository('ManagementAdminBundle:AdvantageTranslation')
            ->findOneBy(['source' => $advantage, 'locale' => $locale]);
        if (!$translation) {
            $translation = new AdvantageTranslation($locale);
            $translation->setSource($advantage);
            $em->persist($translation);
        }

        $editForm = $this->createForm('Management\AdminBundle\Form\AdvantageTranslationType', $translation);
//        $editForm->get('imageFile')->setData($advantage->getImageFile());
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $advantage->setImageFile($editForm->get('imageFile')->getData());
            $em->flush();

            return $this->redirectToRoute('admin_advantage_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/advantage/edit.html.twig', array(
            'advantage' => $advantage,
            'translation' => $translation,
            'edit_form' => $editForm->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Deletes a advantage entity.
     *
     * @Route("/{id}", name="admin_advantage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Advantage $advantage)
    {
        $form = $this->createDeleteForm($advantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advantage);
            $em->flush();
        }

        return $this->redirectToRoute('admin_advantage_index');
    }

    /**
     * Creates a form to delete a advantage entity.
     *
     * @param Advantage $advantage The advantage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Advantage $advantage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_advantage_delete', array('id' => $advantage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
