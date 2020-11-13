<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function welcome(Request $request){
        return view('welcome', ['message' => 'Viewing all available techniques to view the DB records (50K +)']);
    }
    public function load(Request $request){
        ini_set('max_execution_time', 1800);
        $user = User::testLoad(10);

        //Redis
        $pdo = DB::connection()->getPdo();
        $pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        #die('<pre>'.print_r($pdo, true));
        $sql = 'SELECT A.name,father_name, mother_name, B.blood_group FROM User A JOIN UserBloodGroup B ON A.id=B.user_id WHERE 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //redis store
        Cache::store('redis')->put('userWithBloodGroup', $result, 600000);
        die('loaded');
    }
    public function show1(Request $request){
        $users = User::all();
        return view('show', ['users' => $users, 'message' => 'Done with Lazy Load']);
    }
    public function show2(Request $request){
        $users = User::getUserWithBloodGroup();
        return view('show', ['users' => $users, 'message' => 'Done with Eager Load']);
    }
    public function show3(Request $request){
        $users = DB::table('User')
            ->join('UserBloodGroup', 'User.id', '=', 'UserBloodGroup.user_id')
            ->select('User.*', 'UserBloodGroup.blood_group')
            ->get();
        return view('show-in-same', ['users' => $users, 'message' => 'Done with DB::table join']);
    }
    public function show4(Request $request){
        $users = DB::select('SELECT A.name,father_name, mother_name, B.blood_group FROM User A JOIN UserBloodGroup B ON A.id=B.user_id WHERE 1');
        return view('show-in-same', ['users' => $users, 'message' => 'Done with DB::select (No Eloquent Model)']);
    }
    public function show5(Request $request){
        $pdo = DB::connection()->getPdo();
        $pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        #die('<pre>'.print_r($pdo, true));
        $sql = 'SELECT A.name,father_name, mother_name, B.blood_group FROM User A JOIN UserBloodGroup B ON A.id=B.user_id WHERE 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        #die('<pre>'.print_r($result, true));
        return view('show-in-pdo', ['users' => $result, 'message' => 'Done with Raw PDO (no ORM no eloquent)']);
    }
    public function show6(Request $request){
        $result = Cache::store('redis')->get('userWithBloodGroup', function () {
            $pdo = DB::connection()->getPdo();
            $pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
            #die('<pre>'.print_r($pdo, true));
            $sql = 'SELECT A.name,father_name, mother_name, B.blood_group FROM User A JOIN UserBloodGroup B ON A.id=B.user_id WHERE 1';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
        return view('show-in-pdo', ['users' => $result, 'message' => 'Done with Radis']);
    }
    public function show7(Request $request){
        $users = Cache::store('redis')->get('userWithBloodGroup', function () {
            $pdo = DB::connection()->getPdo();
            $pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
            #die('<pre>'.print_r($pdo, true));
            $sql = 'SELECT A.name,father_name, mother_name, B.blood_group FROM User A JOIN UserBloodGroup B ON A.id=B.user_id WHERE 1';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
        return view('show-in-file-cache', ['users' => $users, 'message' => 'Done with File caching']);
    }
}
