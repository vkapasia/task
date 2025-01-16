<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadController extends Controller
{

    public function index(Request $request)
    {

        $status = $request->get('status');

        $leads = Lead::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->orderBy('created_at', 'desc')->paginate(5);

        return view('leads.leads', compact('leads', 'status'));
    }

    public function add(): View
    {

        $data['id'] = '';
        $data['name'] = '';
        $data['email'] = '';
        $data['phone'] = '';
        $data['status'] = '';

        return view('leads.form', compact('data'));
    }

    public function addForm(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:leads',
            'phone' => 'required|digits:10',
            'status' => 'required',
        ]);

        $model = new Lead;
        $model->name = $request->input('name');
        $model->email = $request->input('email');
        $model->phone = $request->input('phone');
        $model->status = $request->input('status');

        if ($model->save()) {

            logActivity('Lead Created', "Lead ID: {$model->id}, Name: {$model->name}");

            return redirect()->route('leads')->with('success', 'Lead Added successfully.');
        } else {

            return redirect()->route('addLead')->with('error', 'Something went wrong.');
        }

    }

    public function edit($id): View
    {

        $model = Lead::find($id);

        $data['id'] = $model->id;
        $data['name'] = $model->name;
        $data['email'] = $model->email;
        $data['phone'] = $model->phone;
        $data['status'] = $model->status;

        return view('leads.form', compact('data'));
    }

    public function editForm(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'status' => 'required',
        ]);

        $model = Lead::find($request->input('id'));
        $model->name = $request->input('name');
        $model->email = $request->input('email');
        $model->phone = $request->input('phone');
        $model->status = $request->input('status');

        if ($model->save()) {

            logActivity('Lead Updated', "Lead ID: {$model->id}, Name: {$model->name}");

            return redirect()->route('leads')->with('success', 'Lead Record Updated successfully.');
        } else {

            return redirect()->route('addLead')->with('error', 'Something went wrong.');
        }

    }

    public function delete(Request $request)
    {

        $id = $request->input('id');

        $model = Lead::find($id);

        logActivity('Lead Deleted', "Lead ID: {$model->id}, Name: {$model->name}");

        return $model->delete();
    }

    public function restoreLeads(Request $request)
    {

        Lead::onlyTrashed()->restore();

        return redirect()->route('leads')->with('success', 'All Deleted Leads Restored successfully.');
    }
}
