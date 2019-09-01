<?php

function createMessage($type, $message){
    $_SESSION[$type] = $message;
}

function createMessageSweet($type, $message){
    $type = $type.'Sweet';
    $_SESSION[$type] = $message;
}

//Bootrstrap Alerts
function showMessage(){
    $type = '';

    if(isset($_SESSION['success'])){
        $class = $type = 'success';
    }

    if(isset($_SESSION['fail'])){
        $type = 'fail';
        $class = 'danger';
    }

    if(isset($_SESSION[$type])){

        $message = $_SESSION[$type];

        $alert = '
            <div class="alert alert-'.$class.' alert-dismissible fade show custom-alert" role="alert">
                <strong>'.$message.'</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';

        unset($_SESSION[$type]);

        echo $alert;

    }

}

//SweetAlert 2 Alerts
function showMessageSweet(){

    if(isset($_SESSION['successSweet'])){

        $message = $_SESSION['successSweet'];

        $alert = "
            <script>
                Swal.fire({
                type: 'success',
                title: 'Great!',
                text: '$message'
                })
            </script>
        ";

        unset($_SESSION['successSweet']);

        echo $alert;
        
    }

    if(isset($_SESSION['failSweet'])){

        $message = $_SESSION['failSweet'];

        $alert = "
            <script>
                Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '$message'
                })
            </script>
        ";

        unset($_SESSION['failSweet']);

        echo $alert;

    }

}



//JavaScript Alerts
// function showMessage(){

//     if(isset($_SESSION['success'])){
//         $type = 'success';
//     }

//     if(isset($_SESSION['fail'])){
//         $type = 'fail';
//     }

//     if(isset($_SESSION[$type])){

//         $message = $_SESSION[$type];

//         $alert = '
//             <script>
//                 alert("'.$type.' - '.$message.'");
//             </script>
//         ';

//         unset($_SESSION[$type]);

//         echo $alert;

//     }

// }