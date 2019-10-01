<?php

namespace Modules\Admin\Http\Controllers;

use App\DataTables\AdminDatatable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\AdminStoreFormRequest;
use Modules\Admin\Http\Requests\AdminUpdateFormRequest;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Common\Services\LocalFiles;
use Modules\Admin\Entities\Admin;

class AdminController extends Controller {

	use LocalFiles;

	public function __construct(AdminRepository $adminRepository) {
//	    $this->middleware(['can:create_admins'])->only(['create','store']);
		$this->adminRepository = $adminRepository;
	}
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index(AdminDatatable $adminDatatable) {
		$title = trans('admin::admin.admins');
        if ( auth()->guard('admin')->user()->can('read_admins')){
            return $adminDatatable->render('admin::index', compact('title'));
        }else{
            abort(404);
        }
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
        if ( auth()->guard('admin')->user()->can('add_admins')) {
            $title = trans('adminpanel::adminpanel.add_new');
            return view('admin::create', compact('title'));
        }else{
	        abort(404);
        }
	}

	public function store(AdminStoreFormRequest $request) {

		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'admins');
		$data = array_filter($data);
        $data['password'] = bcrypt($request->password);
        $admin = $this->adminRepository->create($data);
        $admin->assignRole('sub_admin');
        $admin->givePermissionTo($request->permissions);


		return redirect()->route('admins.index')->with('success', trans('adminpanel::adminpanel.created'));

	}

	public function show($id) {
		return view('admin::show');
	}

	public function edit($id) {
        if ( auth()->guard('admin')->user()->can('edit_admins')) {
            $title = trans('adminpanel::adminpanel.edit');
            $admin = $this->adminRepository->find($id);
        }else{
            abort(404);
        }
		return view('admin::edit', compact('admin', 'title'));
	}

	public function update(AdminUpdateFormRequest $request, $id) {

		$data = $request->validated();

		$admin = $this->adminRepository->find($id);

		$data['image'] = $this->deleteAndStoreNewFile($admin->image, 'image', 'admins');
        if ($request->has('password')){
            $data['password'] = bcrypt($request->password);
        }
		$data = array_filter($data);

		$admin = $this->adminRepository->update($id, $data);
        $admin = Admin::find($id)->syncPermissions($request->permissions);

		return redirect()->route('admins.index')->with('success', trans('adminpanel::adminpanel.updated'));

	}

	public function destroy($id) {
        if ( auth()->guard('admin')->user()->can('delete_admins')) {
            $admin = $this->adminRepository->find($id);
            $this->adminRepository->destroy($admin->id);
            $this->deleteFile($admin->image);

        return back()->with('success', trans('adminpanel::adminpanel.deleted'));
        }
    }

    public function delete_all(Request $request)
    {
        if ( auth()->guard('admin')->user()->can('delete_admins')) {
            if (!$request->has('check_this')) {
                return back()->with('warning', trans('adminpanel::adminpanel.choose_first'));
            } else {
                if (is_array($request->check_this)) {
                    foreach ($request->check_this as $id) {
                        $admin = $this->adminRepository->find($id);
                        $this->adminRepository->destroy($admin->id);
                        $this->deleteFile($admin->image);
                    }
                    return back()->with('success', trans('adminpanel::adminpanel.deleted'));
                } else {
                    $admin = $this->adminRepository->find($request->check_this);
                    $this->adminRepository->destroy($admin->id);
                    $this->deleteFile($admin->image);
                    return back()->with('success', trans('adminpanel::adminpanel.deleted'));
                }
            }
        }else{
            abort(404);
        }
	}
}
