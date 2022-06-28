<?PHP
session_start();
$upd = $_GET['upd'];
    
if($upd == 'add') {
    $item_id = $_GET['id'];
    
    if(empty($_SESSION['cart'])) {
        $order = array();
        $order_item = array(
            'id' => $item_id,
            'num' => 1
        );
        array_push($order,$order_item);
        $_SESSION['cart'] = $order;
    } else {
        $order = $_SESSION['cart'];
        if(in_array($item_id,array_column($order,'id'))) {
            $key = array_search($item_id,array_column($order,'id'));
            $order[$key]['num'] +=1;
        } else {
            $order_item = array(
                'id' => $item_id,
                'num' => 1
            );
            array_push($order,$order_item);
        }
        $_SESSION['cart'] = $order;
    }
    header('location:index.php');
}

if($upd == 'cart') {
    header("location:cart.php");
}

if($upd == 'up') {
    $item_id = $_GET['id'];
    $order = $_SESSION['cart'];
    $key = array_search($item_id,array_column($order,'id'));
    $order[$key]['num'] += 1;
    $_SESSION['cart'] = $order;
    header('location:cart.php');
}

if($upd == 'down') {
    $item_id = $_GET['id'];
    $order = $_SESSION['cart'];
    $key = array_search($item_id,array_column($order,'id'));
    if ($order[$key]['num'] > 1) {
        $order[$key]['num'] -= 1;
    } else {
        unset($order[$key]);
    }
    $_SESSION['cart'] = $order;
    header('location:cart.php');
}
