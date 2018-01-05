<?php
require_once 'Slim/Slim.php';
require_once 'SlimWpOptions.php';


\Slim\Slim::registerAutoloader();
new \Slim\SlimWpOptions();

add_filter('rewrite_rules_array', function ($rules) {
    $new_rules = array(
        '('.get_option('slim_base_path','slim/api/').')' => 'index.php',
    );
    $rules = $new_rules + $rules;
    return $rules;
});

add_action('init', function () {
    if (strstr($_SERVER['REQUEST_URI'], get_option('slim_base_path','slim/api/'))) {
        $slim = new \Slim\Slim();
        do_action('slim_mapping',$slim);
        $slim->get('/slim/api/user/:u',function($user){
            printf("User is %s",$user);            
        });
        $slim->get('/slim/api/test', function(){
            global $wpdb, $table_prefix;
            echo json_encode(
                $wpdb->get_results( 
                    $wpdb->prepare("SELECT * FROM " . 
                    $table_prefix . "test", null) ));
        });

        $slim->post("/slim/api/hello", function(){
            echo "hello world";
        });
        //to get data from outside  - api calling from js.
        $slim->post("/slim/api/appointment",function(){
            $postdata = file_get_contents("php://input");
            echo $postdata;
            $data = json_decode($postdata,true);
            print_r ($data);
            foreach($data as $d){
                echo $data[$d];
            }
            });
    
        $slim->post("/slim/api/bookstore_placeInquiry",function(){
            $postdata = file_get_contents("php://input");
            $data = json_decode($postdata,true);
            global $wpdb;
            $stmt = $wpdb->prepare("INSERT INTO inquiry (mobile,bookname,authername,requesteddate,message) VALUES(%s, %s ,%s ,%s,%s)",
            $data['MobileNumber'],$data['BookName'],$data['AutherName'],$data['Date'],$data[message]);
            $wpdb->query($stmt);
            $res= array();
            $res[0] = "success";
            echo (json_encode($res));
            });
        $slim->post("/slim/api/bookstore_getInquiry",function(){
                $postdata = file_get_contents("php://input");
                $data = json_decode($postdata,true);
                global $wpdb;
                if($postdata == "0" || $postdata == 0){
                    $obje = $wpdb->get_results("SELECT id,mobile,bookname,authername,requesteddate,message from inquiry",OBJECT);    
                }else{
                    $obje = $wpdb->get_results("SELECT id,mobile,bookname,authername,requesteddate,message from inquiry where mobile =".$postdata,OBJECT);
                }
                print_r(json_encode($obje));
        });
        
        $slim->run();
        exit;
    }
});
