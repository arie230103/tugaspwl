<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $monthlyRevenue = Transaction::selectRaw("SUM(total_price) AS total_revenue")
            ->whereRaw('YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE())')
            ->get();

        $yearlyRevenue = Transaction::selectRaw('SUM(total_price) AS total_revenue')
            ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
            ->get();

        $totalUser = User::count();

        $totalProduct = Product::count();

        $revenues = DB::table('transactions')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total_price) as total_revenue'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->get();

        return view('home', compact(['monthlyRevenue', 'yearlyRevenue', 'totalUser', 'totalProduct', 'revenues']));
    }

    public function profile() {
        return view('auth.editprofile');
    }

    public function updateProfilePicture(Request $request) {
        $user = User::find(Auth::user()->id);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());

            if($user->picture_path != null) unlink($user->picture_path);
            $image_path = $file->move('storage/users', $filename);
        } else {
            $image_path = $user->picture_path;
        }

        $user->update([
            'picture_path'      => $image_path
        ]);

        return redirect()->route('profile')->with('success', 'Foto profile berhasil diubah!');
    }

    public function updateProfile(Request $request) {
        $user = User::find(Auth::user()->id);

        $atrrs = $request->validate([
            'name'              => 'string',
            'email'             => 'email',
            'password'          => 'nullable|string',
            'confirm_password'  => 'nullable|string|same:password'
        ]);

        if($request->password == null) $attrs['password'] = $user->password;

        $user->update([
            'name'              => $atrrs['name'],
            'email'             => $atrrs['email'],
            'password'          => Hash::make($atrrs['password'])
        ]);

        return redirect()->route('profile')->with('success', 'Profile berhasil diubah!');
    }
}
