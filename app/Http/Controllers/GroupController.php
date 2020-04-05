<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Group;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class GroupController extends Controller
{
	public function getAll()
	{
		$groups = Group::where('parent_id', '=', '0')->orderBy('order','asc')->get();

		return view('admin.groups', [
			'groups' => $groups,
		]);
	}

    public function AddGet()
    {
        $parent_groups = Group::where('parent_id', '=', '0')->orderBy('order','asc')->get();

        return view('admin.group_form', [
            'parent_groups' => $parent_groups,
        ]);
    }

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:120|unique:groups'
		]);

		$group = new Group();
		$group->title = $request['title'];
		$group->link = $request['link'];
		$group->icon = $request['icon'];
		$group->parent_id = $request['parent_id'];
		$group->order = $request['order'];
		$group->save();

		return redirect('/admin/group')->with([
			'message' => 'منو افزوده شد',
		]);
	}

    public function EditGet($id)
    {
        $group = Group::find($id);
        $parent_groups = Group::where('parent_id', '=', '0')->orderBy('order','asc')->get();

        if (!$group) {
            return redirect('/admin/i3class')->with([
                'message' => 'منو پیدا نشد',
            ]);
        }
        return view('admin.group_form', [
            'group' => $group,
            'parent_groups' => $parent_groups,
        ]);
    }

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:120',
		]);

		$group = Group::find($request['id']);
        $group->title = $request['title'];
        $group->link = $request['link'];
        $group->icon = $request['icon'];
        $group->parent_id = $request['parent_id'];
        $group->order = $request['order'];
		$group->update();

        return redirect('/admin/group')->with([
			'message' => 'منو ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$group = Group::find($id);

		if (!$group) {
            return redirect('/admin/group')->with([
				'message' => 'منو پیدا نشد',
			]);
		}

		$group->delete();

		return redirect()->back()->with([
			'message' => 'منو حذف شد',
		]);
	}
}
