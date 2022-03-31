<?php
session_start();

require_once('../inc/User.class.php');
// create a user object
$user = new User();

// check to see if a user_id is stored in the session array, 
// if so assign it to user id var and assign user level var
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userLevel = $_SESSION['user_level'];
}

if($user->checkLogin($userId)) {
    $userArray = array();
    $errorsArray = array();
}
if($user->isAdminLevel($userLevel)){
    $userList = array();

    if (isset($_GET['download']) && $_GET['download'] == "1") {

        // echo the data
        $userList = $user->getListFiltered(
            (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
            (isset($_GET['filterText']) ? $_GET['filterText'] : null),
            (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
            (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null)
        );

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="user_report_' . date("YmdHis") . '.csv"');
        
        foreach ($userList as $rowData) {
            echo '"' . implode('","', $rowData) . '"';
            echo "\r\n";
        }
        
        exit;
    }

    // check to see if button was click
    if (isset($_GET['btnViewReport'])) {
        
        // run report
        $userList = $user->getListFiltered(
            (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
            (isset($_GET['filterText']) ? $_GET['filterText'] : null),
            (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
            (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
            (isset($_GET['page']) ? $_GET['page'] : 1)
        );
    }

    //var_dump($_SERVER["QUERY_STRING"], $_GET);die;

    $_GET['page'] = (isset($_GET['page']) ? $_GET['page'] + 1 : 2);
    $nextPageLink = http_build_query($_GET);

    include('../tpl/user-report.tpl.php');
}
?>