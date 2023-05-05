<?php
//include file model vao day
include "models/DepartmentModel.php";
class DepartmentController extends Controller
{
    //ke thua class DepartmentModel
    use DepartmentModel;
    public function index()
    {
        //quy dinh so ban ghi tren mot trang
        $recordPerPage = 6;
        //tinh so trang
        //ham ceil(so) se lay gia tri lam tron tren cua so do. VD: ceil(3.1) = 4
        $numPage = ceil($this->modelTotalRecord() / $recordPerPage);
        //lay du lieu tu model
        $data = $this->modelRead($recordPerPage);
        //goi view, truyen du lieu ra view
        $this->loadView("DepartmentProductsView.php", ["data" => $data, "numPage" => $numPage]);
    }
    //using
    public function using()
    {
        //$mapb = isset($_GET["mapb"]) ? $_GET["mapb"] : 0;
        $masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
        $request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
        //goi ham modelDelete
        $this->modelUsing();
        //quay tro lai trang products
        header("location:index.php?controller=department");
    }
    //broken
    public function broken()
    {
        // $mapb = isset($_GET["mapb"]) ? $_GET["mapb"] : 0;
        $masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
        $request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
        //goi ham modelDelete
        $this->modelBroken();
        //quay tro lai trang products
        header("location:index.php?controller=department");
    }
    //finished using
    public function finished_using()
    {
        //$mapb = isset($_GET["mapb"]) ? $_GET["mapb"] : 0;
        $masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
        $request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
        //$soluongyeucau = isset($_GET["soluong"]) ? $_GET["soluong"] : 0;
        //goi ham modelDelete
        $this->modelFinishedUsing();
        //quay tro lai trang products
        header("location:index.php?controller=department");
    }
}
