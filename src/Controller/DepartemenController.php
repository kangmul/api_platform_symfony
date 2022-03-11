<?php

namespace App\Controller;

use App\Entity\Departemen;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityNotFoundException;

use App\Controller\Request;

class DepartemenController extends AbstractController
{
    /**
     * @Route("/api/getdepartemen/{id}", name="get_departemen_name_by_id")
     */
    public function showAll(ManagerRegistry $doctrine, int $id): Response
    {
        // return $this->render('departemen/index.html.twig', [
        //     'controller_name' => 'DepartemenController',
        // ]);

        
        $departemen = $doctrine->getRepository(Departemen::class)->find($id);
        if(empty($departemen)){
            throw $this->createNotFoundException('Tidak ada departemen dengan id ' .$id);
        } 
        $data = [
            'status' => 200,
            'message' => 'success',
            'data' => $departemen->getDepartemenName()
        ];
        
        return $this->json($data);
    }

    /**
     * @Route("/api/deptemployees/{id}", name="cari_departemen_dan_employee_nya")
     */
    public function getDepEmployee(ManagerRegistry $doctrine, int $id): Response
    {
        var_dump($id);exit;
        $departemen = $doctrine->getRepository(Departemen::class)->find($id);
        $data = [
            'status' => 'false',
            'code' => 404,
            'data' => ''
        ];
        if(empty($departemen)){
            // $data = json_encode($data);
            // throw $this->createNotFoundException("Tidak ditemukan");
            return $this->json($data);
        }

        $data = [
            'status' => "success",
            'code' => '200',
            'data' => $departemen->getEmployees()
        ];
        return $this->json($data);
    }

    /**
     * @Route("/api/updatedepartemen/{id}", name="update_nama_departemen_by_request")
     */
    public function setUpdateDepartemen(ManagerRegistry $doctrine, int $id, Request $request): Response
    {
        var_dump($request);
        var_dump($id);
        exit;
    }
}
