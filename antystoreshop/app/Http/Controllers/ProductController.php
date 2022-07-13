<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Categories;
use App\Models\ProductImage;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Components\Recusive;

use App\Traits\StorageImageTrait;

class ProductController extends Controller
{
    use StorageImageTrait;

    private $category;
    private $product;
    private $productImage;



    public function __construct(Categories $category, Product $product, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $this->authorize('view_product');
        $products = $this->product->latest()->paginate(5);
      //dd($products);
        return view('admin.products.index', compact('products'));
    }

    public function active($id)
    {
        $this->product->findOrFail($id)->update(['status' => 0]);
        return redirect()->route('products.index');
    }

    public function unactive($id)
    {
        $this->product->findOrFail($id)->update(['status' => 1]);
        return redirect()->route('products.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  $this->authorize('create_product');
        $categories = $this->getCategory($parentId = '');
        $data = $this->product->get();

        return view('admin.products.create', compact('data', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
       //  dd($request->all());

        $dataProductCreate = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'status' => $request->status,
        ];
        $dataUploadImage = $this->storageUpload($request, 'image_path', 'product');
          //dd($dataUploadImage);

//        $fileName = $request->image_path->getClientOriginalName();
//        $path = $request->file('image_path')->storeAs('public/product',$fileName);
        if (!empty($dataUploadImage)) {
            $dataProductCreate['image_name'] = $dataUploadImage['file_name'];
            $dataProductCreate['image_path'] = $dataUploadImage['file_path'];

        }
        $product = $this->product->create($dataProductCreate);

        // Insert data to product_images
        if ($request->hasFile('image_path_detail')) {
            foreach ($request->image_path_detail as $fileItem) {
                $dataProductImageDetail = $this->storageUploadDetail($fileItem, 'product');
                $dataProductImageDetailCreate = [
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name']
                ];
                //imageDetail trung gian
                $product->imageDetail()->create($dataProductImageDetailCreate);
            }
        }



        return redirect()->route('products.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // $this->authorize('edit_product',$id);
        $products = $this->product->find($id);
        $categories = $this->getCategory($products->category_id);
        return view('admin.products.edit', compact('categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'status' => $request->status,
            ];
            $dataUploadImage = $this->storageUpload($request, 'image_path', 'product');

//        $fileName = $request->image_path->getClientOriginalName();
//        $path = $request->file('image_path')->storeAs('public/product',$fileName);
            if (!empty($dataUploadImage)) {
                $dataProductCreate['image_name'] = $dataUploadImage['file_name'];
                $dataProductCreate['image_path'] = $dataUploadImage['file_path'];
            }

            $this->product->find($id)->update($dataProductCreate);
            $product = $this->product->find($id);
            // Insert data to product_images
            if ($request->hasFile('image_path_detail')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path_detail as $fileItem) {
                    $dataProductImageDetail = $this->storageUploadDetail($fileItem, 'product');
                    $dataProductImageDetailCreate = [
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ];
                    //imageDetail trung gian
                    $product->imageDetail()->create($dataProductImageDetailCreate);
                }
            }




            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize('delete_product');
        $this->product->findOrFail($id)->delete();
        return redirect()->route('products.index');
    }
    public function getCategory($parentId)
    {
        $data = $this->category->get();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->showCategories($parentId);
        return $htmlOption;
    }
    public function trash(){

        $products = Product::onlyTrashed()->get();
//        dd($products);
        return view('admin.products.trash',compact('products'));
    }

    public function restore($id){
        $products = Product::withTrashed()->find($id);
        try {
            $products->restore();
            return redirect()->route('products.trash')->with('success', 'Khôi phục' . ' ' . $products->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.trash')->with('error', 'Khôi phục' . ' ' . $products->name . ' ' .  'không thành công');
        }
        return view('admin.products.trash',compact('products'));
    }
    public function forceDelete($id){
        $products = Product::onlyTrashed()->findOrFail($id);
        try {
            $products->forceDelete();
            return redirect()->route('products.trash')->with('success', 'Xóa' . ' ' . $products->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.trash')->with('error', 'Xóa ' . ' ' . $products->name . ' ' .  'không thành công');
        }
        return view('admin.products.trash',compact('products'));
    }
}
