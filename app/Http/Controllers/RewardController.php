<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $status = $request->get('status');
        $keyword = $request->get('keyword') ?: '';
        if (Gate::allows('isPengajardanAdmin')) {
            if ($status) {
                $reward = \App\Models\Reward::where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
            } else {
                $reward = \App\Models\Reward::where("title", "LIKE", "%$keyword%")->paginate(10);
            }
            return view('backend.reward.index', ['reward' => $reward]);
        } else {
            return view("errors.403");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isPengajardanAdmin')) {
            return view('backend.reward.create');
        } else {
            return view("errors.403");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            "title" => "required|min:1|max:300",
            "deskripsi" => "required|min:1|max:300",
            "syarat_skor" => "required",
            "image" => "mimes:jpeg,jpg,png|max:1500",
        ])->validate();

        $new_reward = new \App\Models\Reward();
        $new_reward->title = $request->get('title');
        $new_reward->deskripsi = $request->get('deskripsi');
        $new_reward->syarat_skor = $request->get('syarat_skor');
        $new_reward->created_by = \Auth::user()->id;
        $new_reward->pembuat = \Auth::user()->name;
        $new_reward->status = $request->get('save_action');
        $new_reward->slug = \Str::slug($request->get('title'));

        //cover / image
        $image = $request->file('image');

        if ($image) {
            $image_path = $image->store('reward-image', 'public');

            $new_reward->image = $image_path;
        }

        $new_reward->save();

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('reward.index')->with('status', 'Reward successfully saved and published');
        } else {
            return redirect()->route('reward.create')->with('status', 'Reward saved as draft');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reward_to_edit = \App\Models\Reward::findOrFail($id);
        if (Gate::allows('isPengajardanAdmin')) {
            return view('backend.reward.edit', ['reward' => $reward_to_edit]);
        } else {
            return view("errors.403");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reward = \App\Models\Reward::findOrFail($id);
        $getTitle = $request->get('title');
        $reward->title = $getTitle;
        $slug = Str::slug($getTitle, '-');
        $reward->slug = $slug;
        $reward->deskripsi = $request->get('deskripsi');
        $reward->syarat_skor = $request->get('syarat_skor');

        $reward->pembuat = \Auth::user()->name;

        // file image
        $new_image = $request->file('image');

        if ($new_image) {
            if ($reward->image && file_exists(storage_path('app/public/' . $reward->image))) {
                \Storage::delete('public/' . $reward->image);
            }

            $new_image_path = $new_image->store('reward-image', 'public');

            $reward->image = $new_image_path;
        }

        $reward->updated_by = \Auth::user()->id;

        $reward->status = $request->get('status');
        if (Gate::allows('isPengajardanAdmin')) {
            $reward->save();
            return redirect()->route('reward.edit', [$reward->id])->with('status', 'Reward successfully updated');
        } else {
            return view("errors.403");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reward = \App\Models\Reward::findOrFail($id);

        if (Gate::allows('isPengajardanAdmin')) {
            $reward->delete();

            return redirect()->route('reward.index')->with('status', 'Reward moved to trash');
        } else {
            return view("errors.403");
        }
    }

    public function trash()
    {
        $reward = \App\Models\Reward::onlyTrashed()->paginate(10);
        if (Gate::allows('isPengajardanAdmin')) {
            return view('backend.reward.trash', ['reward' => $reward]);
        } else {
            return view("errors.403");
        }
    }

    public function deletePermanent($id)
    {
        $reward = \App\Models\Reward::withTrashed()->findOrFail($id);

        if (Gate::allows('isPengajardanAdmin')) {
            if (!$reward->trashed()) {
                return redirect()->route('reward.trash')->with('status', 'Reward is not in trash!')->with('status_type', 'alert');
            } else {
                $reward->forceDelete();

                return redirect()->route('reward.trash')->with('status', 'Reward permanently deleted!');
            }
        } else {
            return view("errors.403");
        }
    }

    public function restore($id)
    {
        $reward = \App\Models\Reward::withTrashed()->findOrFail($id);
        if (Gate::allows('isPengajardanAdmin')) {
            if ($reward->trashed()) {
                $reward->restore();
                return redirect()->route('reward.trash')->with('status', 'Reward successfully restored');
            } else {
                return redirect()->route('reward.trash')->with('status', 'Reward is not in trash');
            }
        } else {
            return view("errors.403");
        }
    }


    public function published(Request $request)
    {

        $reward = \App\Models\Reward::orderBy('title', 'asc')->where('status', 'PUBLISH')->paginate(6);

        $id_user = \Auth::user()->id;
        $orderr = \App\Models\OrderR::paginate(6);
        $user = \App\Models\User::select('id', 'name')->get();

        return view('backend.reward.published', compact('reward', 'user', 'orderr'));
    }
}
