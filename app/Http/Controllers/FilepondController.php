<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person\PersonFile;
use App\Models\Product\ProductFile;
use App\Models\Contacts\ContactFile;
use Sopamo\LaravelFilepond\Filepond;
use App\Models\Companies\CompanyFile;
use App\Models\Material\MaterialFile;
use Illuminate\Support\Facades\Storage;

class FilepondController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $file = MaterialFile::where('name', $request->restore)->first();

        if (!$file) {
            $file = PersonFile::where('name', $request->restore)->first();
        }

        if (!$file) {
            $file = ContactFile::where('name', $request->restore)->first();
        }

        if (!$file) {
            $file = ProductFile::where('name', $request->restore)->first();
        }

        if (!$file) {
            $file = CompanyFile::where('name', $request->restore)->first();
        }

        $name = str_replace(' ', '-', $file->name);

        $filepond = app(Filepond::class);
        $pathFrom = $filepond->getPathFromServerId($file->uuid);

        $path = 'https://s3.eu-west-1.amazonaws.com/app-euroservices/' . $pathFrom;
        
        $tmp = explode('.', $path);
        $file_extension = end($tmp);

        $headers = [
            'Access-Control-Expose-Headers' => 'Content-Disposition, Content-Length, X-Content-Transfer-Id',
            'Content-Disposition' => 'inline; filename="' . $name . '"',
            'Content-Type' => $this->mime2ext($file_extension),
            'Connection' => 'Keep-Alive',
        ];

        $contents = Storage::disk('s3')->get($file->path);

        return response($contents, 200, $headers);
    }

    
    public function mime2ext($mime)
    {
        $mime_map = [
            'jpg'                                                                 => 'image/jpeg',
            'jpeg'                                                                => 'image/jpeg',
            'png'                                                                 => 'image/png',
            'pdf'                                                                 => 'application/pdf',
        ];

        return isset($mime_map[$mime]) === true ? $mime_map[$mime] : false;
    }
}
