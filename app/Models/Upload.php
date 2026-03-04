<?php

namespace App\Models;
use Illuminate\Support\Str;
use Auth;
use App\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class Upload extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','content_id','name','caption','description','video','file','url','status'];
 
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public static function unsetImageFromContent($upload_id){
        $upload = Upload::findOrfail($upload_id);
        $upload->content_id = null;
        $upload->status = 4;
        $upload->save();
        return true;
    }
    

    public static function createSingleUpload($file,$content_id = null){
        // dd($file,$content_id);
        $image_full_name = '';
        $upload = new Upload;
        $upload->user_id = Auth::user()->id;
        if(!empty($content_id)){
            $upload->content_id =  $content_id;
        }
        if(empty($file['name'])){
            $upload->name= 'Media Upload';
        }else{
            $upload->name = $file['name'];
        }
        if(!empty($file['caption'])){
            $upload->caption =  $file['caption'];
        }
        if(!empty($file['description'])){
            $upload->description =  $file['description'];
        }
        if(!empty($file['url'])){
            $upload->url =  $file['url'];
        }
        if(!empty($file['video'])){
            $upload->video =  $file['video'];
        }

        // dd($upload);
        // if uploaded data exists
        if(!empty($file['item'])){
            $image_name= $file['item']->getClientOriginalName();
            // dd($image_name);
            $image_name = explode('.',$image_name);
            $image_extention = end($image_name);
            array_pop($image_name);
            $image_name_string = implode('-',$image_name);
            $image_name_string = Str::slug($image_name_string);
            $upload_path_original = 'images/uploads/large/';
            $upload_path = 'images/uploads/';
            $image_url = $upload_path_original.'.'.$image_extention;
            $image_url_path = $upload_path_original;
            // $image_full_name = uniqid().'.'.$image_extention;
            $image_full_name = $image_name_string.'.'.$image_extention;

            // dd($image_url_path);
            // check already existing image name
            $isImageName = Upload::where('file', 'LIKE', "%{$image_full_name}%")->get()->count();
            // dd($isImageName);
            if($isImageName > 0){
                $image_full_name = $image_name_string.rand(1000, 9999).'.'.$image_extention;
                // $image_url = $upload_path_original.uniqid().'-'.$isImageName.'.'.$image_extention;
                // $image_full_name = uniqid().'-'.$isImageName.'.'.$image_extention;
            }
            // dd($image_full_name);
            $success = $file['item']->move($upload_path_original, $image_full_name);           
            // dd($upload);
            $imageManager = new ImageManager(new Driver());

            if($success){
                $sizes = [200, 480, 800];
                $size_name = ['thumb', 'small','medium'];
                for($i = 0; $i < 3; $i++) {
                    

                    // read image from file system
                    $image = $imageManager->read($upload_path_original. $image_full_name);

                    // $image = Image::make($upload_path_original. $image_full_name);
                    // $image->widen($sizes[$i]);
                    $image->scale(width: $sizes[$i]);

                    $image->save($upload_path .$size_name[$i].'/'. $image_full_name);
                }
            }
            $upload->file = $image_full_name;
        }
        // dd($file);
        // if(!empty($upload->file) || !empty($upload->url) || !empty($upload->video)){
            // $upload->caption = $file->caption ?? '';
            $upload->status = 1;
            $upload->save();
            return $image_full_name;
        // }else{
        //     return false;
        // }       
    }
}
