@extends('layouts.template')
@section('content')
<div class="card mw-100">
    <div class="card-header">
        <h2>
            Personal Gmail Plugin Configuration
            @if(personal_gmail_sender_plugin()->get('checked'))
            <span class="badge badge-light-success">success validating credentials</span>
            @else
            <span class="badge badge-light-danger">error validating credentials</span>
            @endif
        </h2>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-md-6 col-12 mx-auto">
                    <div class="mb-1">
                        <label class="form-label">
                            Gmail (Actual: {{ personal_gmail_sender_plugin()->get('email') }})
                            <strong class="text-danger">*</strong>
                        </label>
                        <input name="email" class="form-control" type="text" value="{{ personal_gmail_sender_plugin()->get('email') }}" placeholder="Please type your personal gmail">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12 mx-auto">
                    <div class="mb-1">
                        <label class="form-label">
                            Gmail Application Password (Actual: {{ personal_gmail_sender_plugin()->get('password') }})
                            <strong class="text-danger">*</strong>
                        </label>
                        <input name="password" class="form-control" type="text" value="{{ personal_gmail_sender_plugin()->get('password') }}" placeholder="Please type your application password">
                    </div>
                </div>
            </div>

            <div class="row">
                <div style="direction: rtl;" class="col-6 flex-end">
                    <button class="btn btn-icon btn-outline-success">
                        <i class="bi bi-save" class="me-25"></i>
                        <span>Save Configuration</span>
                    </button>
                </div>
                <div class="col-6">
                    <form method="post">
                        <input type="hidden" name="test" value="yes">
                        <button class="btn btn-icon btn-outline-info">
                            <i class="bi bi-envelope" class="me-25"></i>
                            <span>Send Test Gmail</span>
                        </button>
                    </form>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection