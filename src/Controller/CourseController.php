<?php

namespace App\Controller;

use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/courses", name="course_")
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index()
    {

        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();

        return $this->json([
            'data' => $courses
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show($id)
    {

        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
        
        return $this->json([
            'data' => $course
        ]);
        
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $course = new Course();
        $course->setName($data['name']);
        $course->setDescription($data['description']);
        $course->setSlug($data['slug']);
        $course->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
        $course->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $entity_manager = $this->getDoctrine()->getManager();

        $entity_manager->persist($course);
        $entity_manager->flush();

        return $this->json([
            'data' => 'Criado com sucesso'
        ]);
    }

    /**
     * @Route("/{id}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($id, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $doctrine = $this->getDoctrine();

        $course = $doctrine->getRepository(Course::class)->find($id);

        if($data["name"])
            $course->setName($data['name']);
        
        if($data["description"])
            $course->setDescription($data['description']);

        if($data["slug"])
            $course->setSlug($data['slug']);
        
        $course->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        $entity_manager = $doctrine->getManager();

        $entity_manager->flush();

        return $this->json([
            'data' => 'Atualizado com sucesso'
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete($id)
    {
        $doctrine = $this->getDoctrine();

        $course = $doctrine->getRepository(Course::class)->find($id);

        $entity_manager = $doctrine->getManager();

        $entity_manager->remove($course);
        $entity_manager->flush();

        return $this->json([
            'data' => 'Excluido com sucesso'
        ]);
    }
}
