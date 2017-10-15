<?php 

    require_once '../models/PhoneModel.php';
    require_once '../bl/Phone_BLL.php';
    
    class PhoneController {


        function get_all_phones() {
            $phone_bll = new Phone_BLL();
            $resultSet = $phone_bll->get_phones();

            $allPhones = array();
            //$errorInInput will contain any problems found in data retrieved from db () creating MovieModel
            //object automatically validates the data - at this stage no further processing occurs with any faulty
            //db data
            $errorInInput = ""; 
            
            while ($row = $resultSet->fetch())
            {                           
                array_push($allPhones, new PhoneModel([ "phone_id" => $row['phone_id'], 
                                                        "phone_name" => $row['phone_name'],
                                                        "manufacturer_id" => $row['manufacturer_id'],
                                                        "manufacturer_name" => $row['manufacturer_name']],
                                                         $errorInInput));
            }
            return $allPhones;
        }

        // function create_update_Movie($params, $method, &$applicationError) {
        //     $Movie = new MovieModel($params, $applicationError);
        //     if ($applicationError != "") { //error found in data members of movie object - faulty user input
        //         return;
        //     }
        //     $movie_bll = new movie_BLL();
        //     //insert => if movie already exists  $applicationError will contain corresponding message and movies-api.php will send apropriate message back to client 
        //     $movie_bll->insert_update_movie($params, $method, $applicationError);
        // }

        // function delete_Movie($params) {
        //             $movie_bll = new movie_BLL();
        //             $movie_bll->delete_movie($params);
        // }
        
        // function getMovieByNameDirector($params) { //used for js remote validation
        //     $movie_bll = new movie_BLL();
        //     $movie_id = $movie_bll->check_movie_exists($params);
        //     if ($movie_id == false){ //no movie found with given movie name and director ID
        //         $movie_id = ["id" => -1];
        //     }
        //     return $movie_id;
        // }
    }

?>
