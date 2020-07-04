<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    public function getAllForAdmin()
    {
        return view('admin.app', [
        ]);
    }

    public function AddApp(Request $request)
    {
        if($request->file('app') != null)
        {
            $app = $request->file('app');
            $app_name = '/files/farazist.apk';
            Storage::disk('public')->putFileAs('/', $app, $app_name);
        }

        return redirect('/admin/app')->with([
            'message' => 'نرم افزار قرار داده شد',
        ]);
    }
}
