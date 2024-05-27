<?php

namespace App\Traits;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

trait CrudModel
{
    use handleInput;
    use addBookDetails;

    abstract protected function model(): string;

    abstract protected function indexView(): string;

    public function store(Request $request)
    {
        $data = $this->storeImage($request);

        if ($request->has('password')) {
            $request['password'] = $this->hashPassword($request->password);
        }

        $this->model()::create($data);

        if ($request->has('author_id')) {
            $this->addAuthor($request);
        }

        if ($request->has('genre_id')) {
            $this->addGenre($request);
        }

        if ($request->has('book_price')) {
            $this->addBookPrice($request);
        }

        return view($this->indexView())->with('toast', ['status' => 'success', 'message' => 'Created Successfully!']);
    }

    public function update(Request $request, $id)
    {
        $data = $this->model()::findOrFail($id);

        $updateData = $this->updateImage($request, $data);

        if ($request->has('book_price')) {
            $this->handleBookPriceUpdate($request, $id);
        }

        $data->update($updateData);

        return view($this->indexView())->with('toast', ['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    public function destroy($id)
    {
        $data = $this->model()::findOrFail($id);

        try {
            $image_path = $data->image;

            $data->delete();

            if ($image_path && File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }

            return view($this->indexView())->with('toast', ['status' => 'success', 'message' => 'Deleted Successfully!']);

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return redirect()->back()->with('error', 'Deleted failed! Because this data is used in another table.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Deleted failed! Server is unavailable! Please try again later.');
        }
    }
}
