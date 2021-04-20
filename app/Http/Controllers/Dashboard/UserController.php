<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');

    }

    public function store(UserRequest $request)
    {
        // return $request->all();
        try{
            $data = $request->all();
            $data['password'] = bcrypt( $request['password']);
            User::create($data);
            session()->flash('success', 'User Has Been Added Succefully');
            return redirect()->route('dashboard.users.index');
        } catch (\Exception $ex) {
            dd($ex);
            return redirect()->route('dashboard.users.index');

        }

    }


    public function edit($id)
    {
        $user = User::select()->find($id);
        if (!$user) {
            session()->flash('success', 'Not Found This User');
            return redirect()->route('dashboard.users');
        }

        return view('dashboard.users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        try{
            $data = $this->validate(request(),[
                'name'              => 'required|string',
                'email'             => 'required|unique:users,email,'.$id,
                'password'          => 'sometimes|nullable|min:6',
            ],[],[

                'required' => 'This field Is Required',
                'name.string' => 'Name Must Be String',
                 'password.min' => 'Password Must Be At Least 6 Number',
            ]);

            if(request()->has('password')){

                $data['password'] = bcrypt(request('password'));
            }

            User::where('id',$id)->update($data);
            session()->flash('success', 'User Has Been Updated Succefully');
            return redirect()->route('dashboard.users.index');


        }catch (\Exception $ex){
            dd($ex);
            return redirect()->route('dashboard.users.index');
        }

    }


    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                session()->flash('success', 'This User Not Found');
                return redirect()->route('dashboard.users.index', $id);
                        }
            $user->delete();

            session()->flash('success', 'User Has Been Deleted Succefully');
            return redirect()->route('dashboard.users.index');

        } catch (\Exception $ex) {
            return redirect()->route('dashboard.users.index');
        }
    }

    public function viewUsersCharts(){
        $current_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        return view('dashboard.users.view_users_charts')->with(compact('current_month_users','last_month_users','last_to_last_month_users'));
    }

    public function viewUsersCountriesCharts(){
        //    $users = DB::table('users')
        // ->select(DB::raw('count(*) as user_count, status'))
        // ->where('status', '=', 1)
        // ->groupBy('status')
        // ->get();

        // $user_info = DB::table('users')
        //          ->select('country', DB::raw('count(*) as count'))
        //          ->groupBy('country')
        //          ->get();

        $getUserCountries = User::select('country',DB::raw('count(country) as count'))->groupBy('country')->get();
        // return $getUserCountries->count();
          $getUserCountries = json_decode(json_encode($getUserCountries),true);
        return view('dashboard.users.view_users_countries_charts')->with(compact('getUserCountries'));

    }
}
