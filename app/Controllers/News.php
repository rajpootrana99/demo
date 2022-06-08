<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/overview')
            . view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }

    public function create()
    {
        $model = model(NewsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required',
        ])) {
            $title = $this->request->getPost('title');
            $slug  = url_title($this->request->getPost('title'), '-', true);
            $body  = $this->request->getPost('body');
            $data = array(
                'title' => $title,
                'slug'  => $slug,
                'body'  => $body,
            );

            $model->news_insert($data);

            return redirect()->to(base_url('/'));
        }

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/create')
            . view('templates/footer');
    }

    public function delete($id = null){
        $model = model(NewsModel::class);
        if (!empty($id) && $this->request->getMethod() == 'get') {
			if($model->news_delete($id)) {
				return redirect()->to(base_url('/'));	
			}
		} else {
			return redirect()->to(base_url('/'));	
		}
    }

    public function edit($slug = null){
        $model = model(NewsModel::class);
        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/edit')
            . view('templates/footer');
    }

    public function update($id = null){
        $model = model(NewsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required',
            'slug' => 'required',
        ])) {
            $title = $this->request->getPost('title');
            $slug  = url_title($this->request->getPost('title'), '-', true);
            $body  = $this->request->getPost('body');
            $data = array(
                'title' => $title,
                'slug'  => $slug,
                'body'  => $body,
            );

            $model->news_update($id, $data);

            return redirect()->to(base_url('/'));
        }

        return view('templates/header', ['title' => 'Update a news item'])
            . view('news/edit')
            . view('templates/footer');
    }
}