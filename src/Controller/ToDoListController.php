<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index(): Response
    {
        return $this->render("index.html.twig");
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function create(): Response
    {
        exit("to do: create a new task");
    }

    /**
     * @Route("/switch-status/{id}", name="switch_status")
     */
    public function switchStatus($id): Response
    {
        exit("SwitchStatus".$id);
    }

    /**
     * @Route("/delete/{id}", name="task_delete")
     */
    public function delete($id): Response
    {
        exit("delete ".$id);
    }
}
