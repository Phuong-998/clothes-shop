<?php

namespace app\controller\backend;

use app\controller\backend\BaseController;
use app\model\backend\DashBoardModel;
use app\model\frontend\ipAdressModel;

class DashboardController extends BaseController
{
    private $dashBoard;
    private $ipAdress;
    public function __construct()
    {
        if (!$this->checkUser($_SESSION['user_name'])) {
            header('Location:admin.php?c=login');
            exit();
        }
        if ($_SESSION['role'] != 1) {
            echo 'Bạn không đủ quyền vào trang này';
            die();
        }
        $this->dashBoard = new DashBoardModel;
        $this->ipAdress = new ipAdressModel;
    }
    public function index()
    {
        $data = [];
        $data['sumExpenseToday'] = $this->dashBoard->sumExpenseToday();
        $data['order'] = $this->dashBoard->getNotOrder();
        $time = date('Y-m-d');
        $data['revenueToday'] = $this->dashBoard->revenueToday($time);
        $data['totalAccesToday'] = $this->ipAdress->totalAccesToday();
        if (isset($_POST['yearRevenue'])) {
            $year = $_POST['yearRevenue'];
            $data['yearRevenue'] = $year;
        } else {
            $now = getdate();
            $year = $now['year'];
        }
        $statis = $this->dashBoard->getida($year);
        //lay doanh thu theo thang bar-char
        $arrmotnh = [];
        for ($i = 1; $i <= 12; $i++) {
            $total = 0;
            foreach ($statis as $value) {
                if ($i == $value['times']) {
                    $total = $value['money'];
                    break;
                }
            }
            $arrmotnh[] = (float)$total;
        }
        $data['abc'] = $arrmotnh;

        // pie-char
        $data['orderScuces'] = $this->dashBoard->getQtySuccesOrder();
        $data['orderfail'] = $this->dashBoard->getQtyFailOrder();
        if (isset($_POST['dayOrder'])) {
            $dayOrder = $_POST['dayOrder'];
            $data['dayOrder'] = $_POST['dayOrder'];
            $data['orderScuces'] = $this->dashBoard->getQtySuccesOrderDay($dayOrder);
            $data['orderfail'] = $this->dashBoard->getQtyFailOrderDay($dayOrder);
        }
        if (isset($_POST['tkOrderMonth']) && isset($_POST['tkOrderYear'])) {
            $tkOrderMonth  = $_POST['tkOrderMonth'];
            $tkOrderYear = $_POST['tkOrderYear'];
            $data['orderScuces'] = $this->dashBoard->getQtySuccesOrderMY($tkOrderMonth, $tkOrderYear);
            $data['orderfail'] = $this->dashBoard->getQtyFailOrderMY($tkOrderMonth, $tkOrderYear);
            $data['tkOrderMonth'] = $tkOrderMonth;
            $data['tkOrderYear'] = $tkOrderYear;
        }

        $data['sellProduct'] = $this->dashBoard->getSellProduct();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('dashboard/index', $data);
        $this->loadFooter();
    }

    public function inventory()
    {
        $data = [];
        $data['totalAccesLastMonth'] = $this->ipAdress->totalAccesLastMonth();
        $data['totalAccesMonth'] = $this->ipAdress->totalAccesMonth();
        $data['totalAccesYear'] = $this->ipAdress->totalAccesYear();
        $data['totalAcees'] = $this->ipAdress->totalAccess();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('dashboard/inventory', $data);
        $this->loadFooter();
    }

    

    public function expense()
    {
        $data = [];
        $data['expenseToday'] = $this->dashBoard->expenseToday();
        if (isset($_POST['year'])) {
            $year = $_POST['year'];
            $data['year'] = $year;
        } else {
            $year = date('Y');
        }
        $expenseChart = $this->dashBoard->expenseChart($year);
        $arrExpense = [];
        for ($i = 1; $i <= 12; $i++) {
            $moeny = 0;
            foreach ($expenseChart as $value) {
                if ($value['times'] == $i) {
                    $moeny = (float)$value['totalMoney'];
                    break;
                }
            }
            $arrExpense[] = $moeny;
        }
        $data['expenseChart'] = $arrExpense;
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('dashboard/expenseToday', $data);
        $this->loadFooter();
    }
}