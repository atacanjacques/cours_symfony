<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/post")
*/
class PostController extends Controller
{
  /**
  * @Route("/", name="post_index")
  * @Method({"GET"})
  * @return Response
  */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();
    $posts = $em->getRepository('AppBundle:Post')->findBy(['removed' => false]);
    return $this->render('post/index.html.twig', [
      'posts' => $posts
    ]);
  }

  /**
  * @Route("/show/{id}", name="post_show")
  * @Method({"GET"})
  * @param Post $post
  * @return Response
  */
  public function showAction(Post $post)
  {
    return $this->render('post/show.html.twig', [
      'post' => $post
    ]);
  }

  /**
  * @Route("/new", name="post_new")
  * @Method({"GET", "POST"})
  * @param Request $request
  * @return RedirectResponse|Response
  */
  public function newAction(Request $request)
  {
    $post = new Post();
    $form = $this->createForm(PostType::class, $post);

    $form->handleRequest($request);
    if($form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($post);
      $em->flush();

      $this->addFlash('succes', "L'article {$post->getTitle()} à été crée");

      return $this->redirectToRoute('post_index');
    }

    return $this->render('post/new.html.twig',[
      'post' => $post,
      'form' => $form->createView()
    ]);
  }

  /**
  * @Route("/update/{id}", name="post_update")
  * @Method({"GET", "POST"})
  * @param Request $request
  * @return RedirectResponse|Response
  */
  public function updateAction(Request $request, Post $post)
  {
    $form = $this->createForm(PostType::class, $post);

    $form->handleRequest($request);
    if($form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($post);
      $em->flush();

      $this->addFlash('succes', "L'article {$post->getTitle()} à été modifié");

      return $this->redirectToRoute('post_index', ['slug' => $post]);
    }

    return $this->render('post/new.html.twig',[
      'post' => $post,
      'form' => $form->createView()
    ]);
  }

  /**
  * @Route("/delete/{id}/{token}", name="post_delete")
  * @Method({"GET"})
  * @param Request $request
  * @param Article $article
  * @return RedirectResponse|Response
  */
  public function deleteAction(Request $request, Post $post)
  {
    $token = $request->attributes->get('token');

    if(!$this->isCsrfTokenValid('delete_article', $token));

    $article->setRemoved(true);

    $em = $this->getDoctrine()->getManager();
    $em->persist($post);
    $em->flush();

    return $this->redirectToRoute('post_index');
  }
}
