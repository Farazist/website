<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Menu;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class MenuController extends Controller
{
	public function getAll()
	{
		$menus = Menu::where('parent_id', '=', '0')->orderBy('order','asc')->get();

		return view('admin.menus', [
			'menus' => $menus,
		]);
	}

    public function AddGet()
    {
        $parent_menus = Menu::where('parent_id', '=', '0')->orderBy('order','asc')->get();

        return view('admin.menu_form', [
            'parent_menus' => $parent_menus,
        ]);
    }

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:120|unique:menus'
		]);

		$menu = new Menu();
		$menu->title = $request['title'];
		$menu->link = $request['link'];
		$menu->icon = $request['icon'];
		$menu->parent_id = $request['parent_id'];
		$menu->order = $request['order'];
		$menu->save();

		return redirect('/admin/menu')->with([
			'message' => 'منو افزوده شد',
		]);
	}

    public function EditGet($id)
    {
        $menu = Menu::find($id);
        $parent_menus = Menu::where('parent_id', '=', '0')->orderBy('order','asc')->get();

        if (!$menu) {
            return redirect('/admin/i3class')->with([
                'message' => 'منو پیدا نشد',
            ]);
        }
        return view('admin.menu_form', [
            'menu' => $menu,
            'parent_menus' => $parent_menus,
        ]);
    }

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:120',
		]);

		$menu = Menu::find($request['id']);
        $menu->title = $request['title'];
        $menu->link = $request['link'];
        $menu->icon = $request['icon'];
        $menu->parent_id = $request['parent_id'];
        $menu->order = $request['order'];
		$menu->update();

        return redirect('/admin/menu')->with([
			'message' => 'منو ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$menu = Menu::find($id);

		if (!$menu) {
            return redirect('/admin/menu')->with([
				'message' => 'منو پیدا نشد',
			]);
		}

		$menu->delete();

		return redirect()->back()->with([
			'message' => 'منو حذف شد',
		]);
	}
}
