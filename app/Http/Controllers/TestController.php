<?php
//名前空間　同じ名前の関数・メソッド等を使う仕組み
namespace App\Http\Controllers;
// use文。継承用のControllerクラスとrequestクラスを使うためにインポート
use App\Models\Test;
use App\Http\controllers\Controller;
use Illuminate\Http\Request;


//コントローラーの本体
class TestController extends Controller
{
    //
    public function index()
    {
        //DB処理　エロクアント⇒モデル名::メソッドで様々な処理が可能
        $values = Test::all();
        //allメソッドでDBの内容全件取得
        // dd = die+vardump その時点で処理を止めて、中身を表示する
        // dd($values);
        //コントローラーのindexメソッドが呼び出された時の処理
        return view('tests.test', compact('values'));
    }
}
