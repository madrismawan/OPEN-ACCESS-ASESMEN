<?php

namespace Modules\Produk\Http\Controllers;

use Modules\Produk\Http\Interfaces\ProdukRepositoryInterface;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Validator;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private ProdukRepositoryInterface $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->produkRepository->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'nama'=> 'required|regex:/^[a-z,. 0-9]+$/i|min:2|max:50',
            'keterangan'=> 'required|regex:/^[a-z,. 0-9]+$/i|min:5|max:50',
            'harga'=> 'required|numeric',
            'persediaan'=> 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try{
            $data = $this->produkRepository->createProduk($request->all());
        }catch (\Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data',
            'data' => $data
        ], 200);
        // END
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // SECURITY
        $validator = Validator::make(['id'=>$id], [
            'id'=> 'exists:produk,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        try{
            $data = $this->produkRepository->getProdukById($id);
        }catch (\Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menampilkan data',
            'data' => $data
        ], 200);
        // END

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'nama'=> 'required|regex:/^[a-z,. 0-9]+$/i|min:2|max:50',
            'keterangan'=> 'required|regex:/^[a-z,. 0-9]+$/i|min:5|max:50',
            'harga'=> 'required|numeric',
            'persediaan'=> 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        try{
            $data = $this->produkRepository->updateProduk($request->id, $request->all());
        }catch (\Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menampilkan data',
            'data' => $data
        ], 200);
        // END
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // SECURITY
         $validator = Validator::make(['id'=>$id], [
            'id'=> 'exists:produk,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        try{
            $data = $this->produkRepository->deleteProduk($id);
        }catch (\Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menghapus data',
        ], 200);
        // END

    }

    public function updateOrCreate(Request $request)
    {
        // MAIN
        try{
            $data = $this->produkRepository->updateOrCreate($request->id,$request->all());
        }catch (\Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => $err
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menghapus data',
            'payload' => $this->produkRepository->getAll()
        ], 200);
        // END

    }



}
