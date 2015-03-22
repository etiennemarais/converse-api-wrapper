<?php namespace ConverseApi\Services\Content;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * @param string $pageName
     *
     * @return \Illuminate\View\View
     */
    public function renderPage($pageName = 'home')
    {
        $viewFile = 'Converse/' . $pageName . '.blade.php';

        if (Storage::exists($viewFile) === false) {
            $this->fetchPage($pageName, $viewFile);
        }

        // TODO change this field when pages transformers has been applied

        if ($this->hasBeenModified($viewFile, $this->getLastModified($pageName))) {
            $this->fetchPage($pageName, $viewFile);
            Cache::flush();
        }

        return view('Converse::' . $pageName);
    }

    /**
     * @param $response
     *
     * @return string
     */
    private function getHtml($response)
    {
        // TODO inherit from themeprovider here
        $prepend = "@extends('layout')\n@section('content')";

        $append = '@endsection';

        $content = "";
        foreach ($response->data->blocks as $block) {
            $content .= $block->content . "\n";
        }

        return $prepend . $content . $append;
    }

    /**
     * @param $viewFile
     * @param $updated_at
     *
     * @return bool
     */
    private function hasBeenModified($viewFile, $updated_at)
    {
        $dt = Carbon::parse($updated_at);

        return ($dt->timestamp > Storage::lastModified($viewFile));
    }

    /**
     * @param $pageName
     * @param $viewFile
     */
    private function fetchPage($pageName, $viewFile)
    {
        $response = $this->get('/pages/render/' . addslashes($pageName));

        Storage::put($viewFile, $this->getHtml($response));
    }

    /**
     * @param $pageName
     *
     * @return string
     */
    private function getLastModified($pageName)
    {
        $response = $this->get('/pages/' . addslashes($pageName) . '/last-modified');

        return $response->data->last_modified->date;
    }
}