<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticlesRepository;

use ApiPlatform\Core\Annotation\ApiResource;


class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }

    public function read(Request $request, ArticlesRepository $articlesRepository): Response
    {
        $input = json_decode($request->getContent(),true);
        $articles = $articlesRepository->SearchArticlesByinput($input);
        $response = [
            'success' => true,
            'data'    => $articles,
            'message' => 'Articles List'
        ];
        return $this->json($response);
    }

    function GetFFDataArray($search_id, $array) {
		// $information = [];
        // foreach ($array as $key1 => $val1) {
        //     if(is_array($val1) and count($val1)) {
        //         foreach ($val1 as $key2 => $val2) {
        //             if($val2 == $search_id) {
        //                 $information[] = $val1;
        //             }
        //         }
        //     }
        // }
        // return $information;
        $information = [];
        foreach ($array as $key1 => $val1) {
            if(is_array($val1) and count($val1)) {
                foreach ($val1 as $key2 => $val2) {
                    if($val2 == $search_id) {
                        $information[] = $val1;
                    }
                }
            }
        }
        return $information;
    }

    public function search(Request $request, ArticlesRepository $articlesRepository): Response
    {
        $input = json_decode($request->getContent(),true);
        $start_position = 0; $end_position = 0;
        $per_page = (isset($input['per_page']) && is_numeric($input['per_page'])) ? $input['per_page'] : 5 ;
        $page_number = (isset($input['page_number']) && is_numeric($input['page_number'])) ? $input['page_number'] : 1 ;
        
        $start_position = (($page_number*$per_page) - $per_page) + 1;
        $end_position = ($start_position + $per_page)-1;

        $data = $articlesRepository->SearchDynamicDataByinput($input);
       
        $tableData = [];
        $columns_headings = ['partCode','description','preferredMaterial'];
        $fixed_headings = count($columns_headings);
        $temp_bml_master_ids = [];$bml_master_ids = [];
        foreach($data as $row){
            $columns_headings[] = $row['paramName'];
            $temp_bml_master_ids[] = $row['bmlPkid'];
        }
        $columns_headings = array_unique($columns_headings);
        $temp_bml_master_ids = array_unique($temp_bml_master_ids);
        foreach($temp_bml_master_ids as $id){
            $bml_master_ids[] = $id;
        }
        $paginated_bml_master_ids = [];
      
        for($i = ($start_position-1) ; $i <= ($end_position-1) ; $i++){
            if(!isset($bml_master_ids[$i]))
                break;
            $paginated_bml_master_ids[] = $bml_master_ids[$i];
        }
        // $data1['start_position'] = $start_position;
        // $data1['end_position'] = $end_position;
        // $data1['paginated_bml_master_ids'] = $paginated_bml_master_ids;
        // echo '<pre>',print_r($data1,1),'</pre>';die;
        $tableData['total_number_of_rows'] = count($bml_master_ids);

        $temp_col_heading = [];
        
        /*First Row heading Completed */
        $index = 0 ;
        foreach($columns_headings as $heading){
          //  $tableData[$index][$heading] = $heading;
            $temp_col_heading[] = $heading;
        }
        $columns_headings = $temp_col_heading;
        // $index++;

        /*First Row heading Completed */

        foreach( $paginated_bml_master_ids as $id) {
            $ffdata = $this->GetFFDataArray($id,$data);
         
            for($i = 0; $i < $fixed_headings; $i++){
                $tableData[$index]['static_columns'][$columns_headings[$i]] = $ffdata[0][$columns_headings[$i]];
            }
            for($i = $fixed_headings; $i < (count($columns_headings)); $i++){
                $tableData[$index]['dynamic_columns'][$columns_headings[$i]] = "";
                foreach($ffdata as $column){
                    if($columns_headings[$i] == $column['paramName']){
                        $tableData[$index]['dynamic_columns'][$columns_headings[$i]] = $column['paramValue'];
                        break;
                    }
                }
            }
            $index++;    
        }
        
        $response = [
            'success' => true,
            'data'    => $tableData,
            'message' => 'Articles List'
        ];
        return $this->json($response);
    }
}
