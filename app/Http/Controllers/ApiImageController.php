<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\ImageModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class ApiImageController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/uploadimage",
     *     summary="Image Upload",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="id_user",
     *                     type="integer",
     *                     example=1,
     *                 ),
     *                 @OA\Property(
     *                     property="id_tps",
     *                     type="integer",
     *                     example=1,
     *                 ),
     *                 @OA\Property(
     *                     property="photos",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(
     *                             property="photo",
     *                             type="string",
     *                             format="base64-encoded-string",
     *                         ),
     *                         @OA\Property(
     *                             property="filename",
     *                             type="string",
     *                         ),
     *                     ),   
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Image successfully uploaded"),
     *     @OA\Response(response="400", description="Bad Request"),
     * )
     */

    public function uploadImage(Request $request)
    {   
        try {
            $validator = Validator::make($request->all(), [
                'id_user' => 'required|integer',
                'id_tps' => 'required|integer',
                'photos' => 'required|array',
                'photos.*.photo' => 'required|string',
                'photos.*.filename' => 'required|string',
            ]);
    
            // Validasi input
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
    
            DB::beginTransaction();
    
            $uploadedImages = [];
    
            foreach ($request->photos as $photo) {
                $imageData = base64_decode($photo['photo']);
                $imageName = $photo['filename'];
    
                // Save the image to a desired directory (you may need to adjust the path)
                $path = public_path("assets\images\ $imageName");
                //file_put_contents($path, $imageData);
                //$path = public_path("assets/images/");
                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                        file_put_contents($path, $imageData);
                    }
                
                $image = ImageModel::create([
                    'image' => $path,
                    'id_user' => $request->id_user,
                    'id_tps' => $request->id_tps,
                    //  'created_by' => Auth::user()->name,
                    //  'modified_by' => Auth::user()->name,
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'deletestatus' => 0,
                ]);
    
                // Add uploaded image details to the response data
                $uploadedImages[] = [
                    'filename' => $image->image
                ];
            }
    
            DB::commit();
    
            // Include uploaded image details in the response
            return response()->json(['message' => 'Image(s) successfully uploaded', 'uploaded_images' => $uploadedImages], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


}
