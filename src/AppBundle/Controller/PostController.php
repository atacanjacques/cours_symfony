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
  */
  public function indexAction()
  {
    return $this->render('post/index.html.twig');
  }

  /**
  * @Route("/create", name="post_create")
  * @Method({"GET", "POST"})
  */
  public function createAction(Request $request)
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

    return $this->render('post/create.html.twig',[
      'post' => $post,
      'form' => $form->createView()
    ]);
  }
}
