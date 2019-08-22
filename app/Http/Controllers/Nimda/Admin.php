<?php

namespace App\Http\Controllers\Nimda;

use App\Modules\Tree\Facades\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

abstract class Admin extends Controller
{
    public $perPage = 10;

    protected $title = '';

    protected $viewPrefix  = '';

    protected $routePrefix = '';

    protected $config_path = '';

    protected $messages    = [
        'store' => 'admin.messages.store',
        'update' => 'admin.messages.update',
        'destroy' => 'admin.messages.destroy',
        'destroy_image' => 'admin.messages.destroy_image',
        'destroy_file' => 'admin.messages.destroy_file',
        'unable_delete' => 'admin.messages.unable_delete'
    ];

    public function __construct()
    {
        $this->setRoutePrefix();
        $this->setViewPrefix();
        $this->share();
    }

    protected function share()
    {
        View::share('routePrefix', $this->routePrefix);
        View::share('title', $this->title);
    }

    protected function setViewPrefix()
    {
        if (!$this->viewPrefix) {
            $this->viewPrefix = 'admin.';
        }
    }

    abstract public function getModel();

    public function getRules($request, $id = false)
    {
        return [];
    }

    public function getAttributes()
    {
        return Lang::get('admin_fields');
    }

    public function index()
    {
        $entities = $this->getModel()->order()->paginate($this->perPage);

        return view($this->getIndexViewName(), ['entities' => $entities]);
    }

    public function create()
    {
        $entity = $this->getModel();

        return view($this->getFormViewName(), [
            'entity' => $entity,
            'route'  => $this->routePrefix . "store"
        ]);
    }

    public function store(Request $request)
    {
        $request->flash();

        $this->validate($request, $this->getRules($request), [], $this->getAttributes());
        $entity = $this->getModel()->create($request->all());

        if($request->hasFile('image')) {
            $this->upload($request, $entity, $this->config_path);
        }

        $this->after($entity, $request->parent_id);

        return redirect()
            ->route($this->routePrefix . 'edit', ['id' => $entity->id])
            ->with('message', trans($this->messages['store']));
    }

    public function edit($id)
    {
        $entity = $this->getModel()->findOrFail($id);

        return view($this->getFormViewName(), [
            'entity' => $entity,
            'route' => $this->routePrefix . "update"
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->flash();

        $this->validate($request, $this->getRules($request, $id), [], $this->getAttributes());
        $entity = $this->getModel()->findOrFail($id);
        $entity->update($request->all());

        if($request->hasFile('image')) {
            $this->upload($request, $entity, $this->config_path);
        }

        $this->after($entity, $request->parent_id);

        return redirect()->back()->with('message', trans($this->messages['update']));
    }

    public function destroy($id)
    {
        $entity = $this->getModel()->find($id);
        $entity->delete();

        if($this->config_path) {
            $this->deleteUploads($entity, $this->config_path);
        }

        return redirect()->back()->with('message', trans($this->messages['destroy']));
    }

    protected function after($entity, $parentId)
    {
        //
    }

    protected function upload($request, $entity, $config_path)
    {
        //
    }

    protected function deleteUploads($entity, $config_path)
    {
        //
    }
}
