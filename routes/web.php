<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('blog', function () {
    $pages = Http::withHeaders([
        'Notion-Version' => '2022-02-22',
        'Authorization'  => 'Bearer ' . config('notion.api_key'),
    ])
        ->post(
            'https://api.notion.com/v1/databases/' . config('notion.database_id') . '/query',
            ['page_size' => 10],
        )->json();

    $pages = collect($pages['results'])->map(function ($page) {
        return [
            'id'          => $page['id'],
            'name'        => data_get($page, 'properties.Name.title.0.plain_text'),
            'description' => data_get($page, 'properties.Description.rich_text.0.plain_text'),
            'tags'        => $page['properties']['Tags']['multi_select'],
        ];
    });

    return view('blog', compact('pages'));
});

Route::get('articles/{id}', function ($id) {
    $paragraphs = Http::withHeaders([
        'Notion-Version' => '2022-02-22',
        'Authorization'  => 'Bearer ' . config('notion.api_key'),
    ])
        ->get("https://api.notion.com/v1/blocks/$id/children", ['page_size' => 100])
        ->collect('results')
//        ->dump()
            // todo add more type supports
        ->where('type', 'paragraph')
        ->map(function ($paragraph) {
            $paragraphModel = new \App\NotionModels\Paragraph();

            $paragraphModel->richTexts = collect(data_get($paragraph, 'paragraph.rich_text', []))->map(function (
                $richText
            ) {
                $richTextModel = new \App\NotionModels\RichText();
                $richTextModel->plainText = $richText['plain_text'];

                return $richTextModel;
            });

            return $paragraphModel;
        });

    return view('article', compact('paragraphs'));
});
