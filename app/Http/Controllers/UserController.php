<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Delivery;
use App\Video;
use App\Exam;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Socialite;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
 

    public function getAllOwners()
	{
		$owners = User::where('role', '2')->get();

		return view('admin.owners', [
			'owners' => $owners,
		]);
    }
    
    function signUpGet()
    {
        return view('client.signup');
    }

    function signUpPost(Request $data)
    {
        $this->validate($data, [
            'email' => 'required|unique:users',
            'name' => 'required|max:120',
            'password' => 'required|min:8',
            'password_confirmation' => 'same:password'
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role = 3;
        $user->save();

        if (isset($data->image)) {
            $user->avatar = $user->id . ".jpg";
            $file = $data->file('image');
            $filename = $user->id . ".jpg";
            Storage::disk('post')->put($filename, File::get($file));
            $user->update();
        }

        Auth::login($user);
        return redirect('/user/profile');
    }

    function SignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role' => 3], $request["remember_me"])) {
            return back()->with(['message' => 'آدرس ایمیل یا گذرواژه اشتباه است.']);
        }
        else{
            return redirect('/user/profile')->with(['message' => 'شما وارد حساب کاربری شدید.']);
        }
    }

    function account_edited(Request $data)
    {
        $this->validate($data, [
            'email' => 'required',
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'gender' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password'
        ]);

        $user = Auth::guard('user')->user();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->password = bcrypt($data['password']);
        $user->update();

        if (isset($data->image)) {
            $user->avatar = $user->id . ".jpg";
            $file = $data->file('image');
            $filename = $user->id . ".jpg";
            Storage::disk('post')->put($filename, File::get($file));
            $user->update();
        }

        $user = Auth::guard('user')->user();
        Auth::guard('user')->login($user);
        return redirect('/user/panel')->with(['user' => $user]);
    }

    function Profile()
    {
        return view('user.profile');
    }

    function Courses()
    {
        return view('user.courses');
    }

    function AddToBasket($course_id)
    {
        $course = Course::find($course_id);
        Auth::user()->courses()->attach($course);
        return back()->with(['message' => 'دوره آموزشی به سبد شما افزوده شد']);
    }


    function Exams()
    {
        return view('user.exams');
    }

    function category_posts($category_name)
    {
        $category_name = str_replace('-', ' ', $category_name);
        $category = Category::query()
            ->where('name', $category_name)
            ->first();
        $user = Auth::guard('user')->user();

        $courses = Course::query()
            ->where('category_id', $category->id)
            ->get();
        return view('user.category-posts', ['user' => $user, 'courses' => $courses, 'category' => $category]);
    }


    function search(Request $data)
    {
        $search_item = $data['search_item'];
        return view('user.panel');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);
                return redirect('/');

            }else{

                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->save();

                Auth::login($newUser);
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    public function SingleGet($user_id, $access = 'client')
	{
		$user = User::find($user_id);

		if(!$user)
		{
			return redirect()->route($access . 'users.get')->with([
				'message' => 'دوره آموزشی پیدا نشد',
			]);
		}

		return view($access . '.user', [
			'user' => $user,
		]);
	}

	public function getAll()
	{
		$users = User::orderBy('created_at','desc')->paginate(5);

		return view('admin.users', [
			'users' => $users,
		]);
	}

	public function AddGet()
	{
		return view('admin.user_form');
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120',
			'family' => 'required|max:120',
			'father_name' => 'required|max:120',
			'national_code' => 'required|max:120',
			'birth_date' => 'required|max:120',
			'email' => 'required|email|max:120',
			'phone_number' => 'required|max:120',
			'home_number' => 'max:120',
			'address' => 'required|max:120',
			'password' => 'required|max:80',
		]);

		$user = new User();
		$user->name = $request['name'];
		$user->family = $request['family'];
		$user->father_name = $request['father_name'];
		$user->national_code = $request['national_code'];
		$user->birth_date = $request['birth_date'];
		$user->email = $request['email'];
		$user->phone_number = $request['phone_number'];
		$user->home_number = $request['home_number'];
		$user->address = $request['address'];
		$user->password = $request['password'];
		$user->image = $request['image'];
		$user->save();

		return redirect('admin/user')->with([
			'message' => 'دانشجو افزوده شد',
		]);
	}

	public function EditGet($id)
	{
		$user = User::find($id);

		if (!$user) {
            return redirect('admin/user')->with([
				'message' => 'دانشجو پیدا نشد',
			]);
		}

		return view('admin.user_form', [
			'user' => $user,
		]);
	}

	public function EditPost(Request $request)
	{
        $this->validate($request,[
            'name' => 'required|max:120',
            'family' => 'required|max:120',
            'father_name' => 'required|max:120',
            'national_code' => 'required|max:120',
            'birth_date' => 'required|max:120',
            'email' => 'required|email|max:120',
            'phone_number' => 'required|max:120',
            'home_number' => 'max:120',
            'address' => 'required|max:120',
            'password' => 'required|max:80',
        ]);

        $user = User::find($request['id']);
        $user->name = $request['name'];
        $user->family = $request['family'];
        $user->father_name = $request['father_name'];
        $user->national_code = $request['national_code'];
        $user->birth_date = $request['birth_date'];
        $user->email = $request['email'];
        $user->phone_number = $request['phone_number'];
        $user->home_number = $request['home_number'];
        $user->address = $request['address'];
        $user->password = $request['password'];
        $user->image = $request['image'];
        $user->update();

        return redirect('admin/user')->with([
			'message' => 'دانشجو ویرایش شد',
		]);
	}

	public function DeleteGet($topic_id)
	{
		$topic = Topic::find($topic_id);

		if (!$topic) {
            return redirect('admin/user')->with([
				'message' => 'دانشجو پیدا نشد',
			]);
		}

		$topic->delete();

		return redirect()->back()->with([
			'message' => 'دانشجو با موفقیت حذف گردید',
		]);
	}
}