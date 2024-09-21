<?php

namespace App\Http\Controllers;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
abstract class Controller
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $this->productRepo->create($request->all());

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = $this->productRepo->findById($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $this->productRepo->update($id, $request->all());

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->productRepo->delete($id);
        return redirect()->route('products.index');
    }
}
